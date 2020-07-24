<?php

namespace App\Http\Controllers\Auth\OAuth;

use Illuminate\Http\Request;

class LinkedInOAuthController extends BaseOAuthController
{
    public function __construct()
    {
        $this->authUrl = env('LINKEDIN_AUTH_URL');
        $this->tokenUrl = env('LINKEDIN_TOKEN_URL');
        $this->redirectUrl = env('LINKEDIN_REDIRECT_URL');
        $this->userInfoUrl = env('LINKEDIN_USER_INFO_URL');
        $this->clientId = env('LINKEDIN_CLIENT_ID');
        $this->clientSecret = env('LINKEDIN_CLIENT_SECRET');
        $this->serviceType = 2; //LinkedId

        parent::__construct();
    }

    /**
     * Redirect user to LinkedIn to confirm signing in.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showLinkedInAuthForm()
    {
        $params = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUrl,
            'scope' => 'r_liteprofile r_emailaddress',
            'response_type' => 'code',
        ];

        return $this->redirectToAuthService($params);
    }

    /**
     * Receive a special code in request from LinkedId and go through auth flow.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authUser(Request $request)
    {
        $code = $request->get('code');

        $postParams = [
            'code' => $code,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => $this->redirectUrl,
            'grant_type' => 'authorization_code',
        ];

        return $this->passAuthFlow($postParams);
    }
}
