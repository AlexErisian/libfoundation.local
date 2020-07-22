<?php

namespace App\Http\Controllers\Auth\OAuth;

use App\Http\Controllers\Controller;
use App\Models\OauthService;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class GoogleOAuthController extends Controller
{
    private $authUrl;
    private $redirectUrl;
    private $tokenUrl;
    private $userInfoUrl;
    private $clientId;
    private $clientSecret;

    /**
     * Exchange given code to an API access token.
     *
     * @param string $code
     * @return array|mixed
     * @throws \Illuminate\Http\Client\RequestException
     */
    private function getTokens($code)
    {
        $postParams = [
            'code' => $code,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => $this->redirectUrl,
            'grant_type' => 'authorization_code',
        ];
        $data = Http::asForm()
            ->post($this->tokenUrl, $postParams)->throw()->json();

        return $data ?? [];
    }

    /**
     * Return user's primary email using API with token.
     *
     * @param string $accessToken
     * @return array|mixed
     * @throws \Illuminate\Http\Client\RequestException
     */
    private function getUserInfo($accessToken)
    {
        $userInfo = Http::withToken($accessToken)
            ->get($this->userInfoUrl)->throw()->json();

        return $userInfo;
    }

    /**
     * Create and return new User using given data
     *
     * @param array $data
     * @return User|null
     * @throws Exception
     */
    private function registerNewUser($data)
    {
        $user = new User();
        $user->role_id = 3; //Reader
        $user->readercard_id = 3;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt(random_bytes(8));

        return $user->save() ? $user : null;
    }

    /**
     * Create a new OauthService model for given User
     *
     * @param User $user
     * @param array $tokens
     * @return bool
     */
    private function updateOrCreateOAuthService($user, $tokens)
    {
        if(empty($user->oauthService)) {
            $newService = new OauthService();
            $newService->user_id = $user->id;
            $newService->type = 1; //Google
            $newService->access_token = $tokens['access_token'];
            $newService->valid_until = Carbon::now()
                ->addSeconds($tokens['expires_in']);
            $newService->refresh_token = $tokens['refresh_token'];

            return $newService->save();
        } else {
            $user->oauthService->access_token = $tokens['access_token'];
            $user->oauthService->valid_until = Carbon::now()
                ->addSeconds($tokens['expires_in']);

            return $user->oauthService->update();
        }
    }

    public function __construct()
    {
        $this->authUrl = env('GOOGLE_AUTH_URL');
        $this->tokenUrl = env('GOOGLE_TOKEN_URL');
        $this->redirectUrl = env('GOOGLE_REDIRECT_URL');
        $this->userInfoUrl = env('GOOGLE_USER_INFO_URL');
        $this->clientId = env('GOOGLE_CLIENT_ID');
        $this->clientSecret = env('GOOGLE_CLIENT_SECRET');
    }

    /**
     * Redirect user to Google to confirm signing in
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showGoogleAuthForm()
    {
        $url = $this->authUrl .
            '?client_id=' . $this->clientId .
            '&redirect_uri=' . $this->redirectUrl .
            '&response_type=code' .
            '&scope=https://www.googleapis.com/auth/userinfo.email' .
            '+https://www.googleapis.com/auth/userinfo.profile' .
            '&include_granted_scopes=true' .
            '&access_type=offline';
        return redirect($url);
    }

    /**
     * - Receives a special code in request from Google;
     * - exchanges the code to tokens data;
     * - uses API to get user information;
     * - authenticates the user.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authUser(Request $request)
    {
        try {
            $code = $request->get('code');
            if (empty($code)) {
                throw new Exception('Missing parameter "code".');
            }

            $tokens = $this->getTokens($code);

            $userInfo = $this->getUserInfo($tokens['access_token']);

            $user = User::where('email', $userInfo['email'])->first();
            if (empty($user)) {
                $user = $this->registerNewUser($userInfo);
            }

            $this->updateOrCreateOAuthService($user, $tokens);

            Auth::login($user);

            return redirect()->route('main');
        } catch (Exception $exception) {
            return redirect()
                ->route('login')
                ->withErrors(['msg' => $exception->getMessage()]);
        }
    }
}