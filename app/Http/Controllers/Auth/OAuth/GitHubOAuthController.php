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
     * Exchanges given code to an API access token.
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
     * Returns user's primary email using API with token.
     *
     * @param $token
     * @return mixed|string
     * @throws \Illuminate\Http\Client\RequestException
     */
    private function getUserEmail($token)
    {
        $getHeaders = [
            'Authorization' => 'token ' . $token,
            'Connection' => 'close'
        ];
        $userEmails = Http::withHeaders($getHeaders)
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
     * Returns array which contains user's data using API with token.
     *
     * @param string $token
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    private function getUserData($token)
    {
        $getHeaders = [
            'Authorization' => 'token ' . $token,
            'Connection' => 'close'
        ];
        $userData = Http::withHeaders($getHeaders)
            ->get($this->userUrl)->throw()->json();

        return $userData;
    }

    /**
     * Creates and returns new User using given data
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

    public function __construct()
    {
        $this->authUrl = env('GITHUB_AUTH_URL');
        $this->tokenUrl = env('GITHUB_TOKEN_URL');
        $this->userUrl = env('GITHUB_USER_URL');
        $this->clientId = env('GITHUB_CLIENT_ID');
        $this->clientSecret = env('GITHUB_CLIENT_SECRET');
    }

    /**
     * Redirects user to GitHub to confirm signing in
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
     * Receives a special code from GitHub,
     *
     * than gets user's data by the token and authenticates the user.
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

            $token = $this->getAccessToken($code);
//            $service = OauthService::where('token', $token)->first();

//            if (!empty($service)) {
//                Auth::login($service->user);
//            } else {
            $primaryEmail = $this->getUserEmail($token);

            $user = User::where('email', $primaryEmail)->first();
            if (empty($user)) {
                $userData = $this->getUserData($token);
                $userData['primary_email'] = $primaryEmail;
                $user = $this->registerNewUser($userData);
            }

//                $newService = new OauthService();
//                $newService->user_id = $user->id;
//                $newService->type = 3; //GitHub
//                $newService->token = $token;
//                $newService->save();

            Auth::login($user);
//            }
            return redirect()->route('main');
        } catch (Exception $exception) {
            return redirect()
                ->route('login')
                ->withErrors(['msg' => $exception->getMessage()]);
        }
    }
}
