<?php

namespace App\Http\Controllers\Auth\OAuth;

use App\Http\Controllers\Controller;
use App\Models\OauthService;
use App\Models\User;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GitHubOAuthController extends Controller
{
    private $authUrl;
    private $tokenUrl;
    private $userUrl;
    private $clientId;
    private $clientSecret;

    /**
     * Exchange given code to an API access token.
     *
     * @param string $code
     * @return mixed|string
     * @throws \Illuminate\Http\Client\RequestException
     */
    private function getAccessToken($code)
    {
        $postHeaders = [
            'Accept' => 'application/json',
        ];
        $postParams = [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'code' => $code,
        ];
        $data = Http::withHeaders($postHeaders)
            ->post($this->tokenUrl, $postParams)->throw()->json();

        return $data['access_token'] ?? '';
    }

    /**
     * Return user's primary email using API with token.
     *
     * @param $accessToken
     * @return mixed|string
     * @throws \Illuminate\Http\Client\RequestException
     */
    private function getUserEmail($accessToken)
    {
        $getHeaders = [
            'Connection' => 'close'
        ];
        $userEmails = Http::withToken($accessToken)
            ->withHeaders($getHeaders)
            ->get($this->userUrl . '/emails')->throw()->json();

        $primaryEmail = '';
        foreach ($userEmails as $email) {
            if ($email['primary']) {
                $primaryEmail = $email['email'];
                break;
            }
        }

        return $primaryEmail;
    }

    /**
     * Return array using API with token which contains user's data.
     *
     * @param string $accessToken
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    private function getUserData($accessToken)
    {
        $getHeaders = [
            'Connection' => 'close'
        ];
        $userData = Http::withToken($accessToken)
            ->withHeaders($getHeaders)
            ->get($this->userUrl)->throw()->json();

        return $userData;
    }

    /**
     * Create and return new User using given data
     *
     * @param $data
     * @return User|null
     * @throws Exception
     */
    private function registerNewUser($data)
    {
        $user = new User();
        $user->role_id = 3; //Reader
        $user->readercard_id = 3;
        $user->name = $data['name'] ?? $data['login'];
        $user->email = $data['primary_email'];
        $user->password = bcrypt(random_bytes(8));

        return $user->save() ? $user : null;
    }

    /**
     * Create a new OauthService model for given User
     *
     * @param User $user
     * @param string $accessToken
     * @return bool
     */
    private function updateOrCreateOAuthService($user, $accessToken)
    {
        if (empty($user->oauthService)) {
            $newService = new OauthService();
            $newService->user_id = $user->id;
            $newService->type = 3; //GitHub
            $newService->access_token = $accessToken;

            return $newService->save();
        } else {
            $user->oauthService->access_token = $accessToken;

            return $user->oauthService->update();
        }


    }

    public function __construct()
    {
        $this->authUrl = env('GITHUB_AUTH_URL');
        $this->tokenUrl = env('GITHUB_TOKEN_URL');
        $this->userUrl = env('GITHUB_USER_URL');
        $this->clientId = env('GITHUB_CLIENT_ID');
        $this->clientSecret = env('GITHUB_CLIENT_SECRET');
    }

    /**
     * Redirect user to GitHub to confirm signing in
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showGitHubAuthForm()
    {
        $url = $this->authUrl .
            '?client_id=' . $this->clientId .
            '&scope=user:email';
        return redirect($url);
    }

    /**
     * - Receives a special code in request from GitHub;
     * - exchanges the code to an access token;
     * - uses API to get a user information;
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

            $accessToken = $this->getAccessToken($code);

            $primaryEmail = $this->getUserEmail($accessToken);

            $user = User::where('email', $primaryEmail)->first();
            if (empty($user)) {
                $userData = $this->getUserData($accessToken);
                $userData['primary_email'] = $primaryEmail;
                $user = $this->registerNewUser($userData);
            }

            $this->updateOrCreateOAuthService($user, $accessToken);

            Auth::login($user);

            return redirect()->route('main');
        } catch (Exception $exception) {
            return redirect()
                ->route('login')
                ->withErrors(['msg' => $exception->getMessage()]);
        }
    }
}
