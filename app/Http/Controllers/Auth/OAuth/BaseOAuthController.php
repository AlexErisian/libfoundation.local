<?php

namespace App\Http\Controllers\Auth\OAuth;

use App\Http\Controllers\Controller;
use App\Models\OauthService;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

abstract class BaseOAuthController extends Controller
{
    //Auth flow URIs
    protected $authUrl;
    protected $redirectUrl;
    protected $tokenUrl;
    protected $userInfoUrl;
    //App credentials
    protected $clientId;
    protected $clientSecret;
    //Service data
    protected $serviceType;

    public function __construct()
    {
        //
    }

    /**
     * Redirect user's browser to the specified OAuth provider authentication form.
     *
     * @param $params
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectToAuthService($params)
    {
        $url = $this->authUrl . '?' .
            http_build_query($params, null, '&');

        return redirect($url);
    }

    /**
     * - Exchange given params to an access token;
     * - use API to handle a user information;
     * - authenticate the user.
     *
     * @param array $tokenPostParams
     * @param array|null $tokenPostHeaders
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function passAuthFlow($tokenPostParams, $tokenPostHeaders = null)
    {
        try {
            if (empty($tokenPostParams['code'])) {
                throw new Exception('Missing parameter "code".');
            }

            $tokens = $this->getTokens($tokenPostParams, $tokenPostHeaders);

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
                ->withErrors($exception->getMessage());
        }
    }

    /**
     * Exchange given code to an API access token
     * (and refresh token for the first time auth).
     *
     * @param array $postParams
     * @param array|null $postHeaders
     * @return array|mixed
     * @throws Exception
     */
    private function getTokens($postParams, $postHeaders = null)
    {
        $ch = curl_init($this->tokenUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            http_build_query($postParams, '', '&'));
        if(!empty($postHeaders)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $postHeaders);
        }

        return $this->getResponseData($ch);
    }

    /**
     * Return array which contains user's data.
     * Uses API with access token.
     *
     * @param string $accessToken
     * @return array
     * @throws Exception
     */
    private function getUserInfo($accessToken)
    {
        $headers = [
            'Authorization: Bearer ' . $accessToken,
            'Connection: Close',
            'User-Agent: Demo'
        ];

        $ch = curl_init($this->userInfoUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $userInfo = $this->getResponseData($ch);

        if (empty($userInfo['email'])) {
            $ch = curl_init($this->userInfoUrl . '/emails');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $userEmails = $this->getResponseData($ch);

            foreach ($userEmails as $email) {
                if ($email['primary']) {
                    $userInfo['email'] = $email['email'];
                    break;
                }
            }
        }
        if (empty($userInfo['email'])) {
            throw new Exception('Схоже, що доступ до Email користувача обмежено.
            Будь ласка, перевірте налаштування свого облікового запису на обраному сайті.');
        }

        return $userInfo;
    }

    /**
     * Perform cURL session and get response data.
     *
     * @param resource $ch cURL handle
     * @return array|null
     * @throws Exception
     */
    private function getResponseData($ch)
    {
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if (!empty($error)) {
            throw new Exception($error);
        }

        return json_decode($response, true);
    }

    /**
     * Create, save and return a new User using given data
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
     * Create new OauthService model or update existing one for given User
     *
     * @param User $user
     * @param array $tokens
     * @return bool
     */
    private function updateOrCreateOAuthService($user, $tokens)
    {
        $validUntil = empty($tokens['expires_in']) ?
            Carbon::now()->addSeconds(3600) :
            Carbon::now()->addSeconds($tokens['expires_in']);

        if (empty($user->oauthService)) {
            $newService = new OauthService();
            $newService->user_id = $user->id;
            $newService->type = $this->serviceType;
            $newService->access_token = $tokens['access_token'];
            $newService->valid_until = $validUntil;
            $newService->refresh_token = $tokens['refresh_token'] ?? null;

            return $newService->save();
        } else {
            $user->oauthService->access_token = $tokens['access_token'];
            $user->oauthService->valid_until = $validUntil;

            return $user->oauthService->update();
        }
    }
}
