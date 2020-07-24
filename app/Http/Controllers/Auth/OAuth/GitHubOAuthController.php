<?php

namespace App\Http\Controllers\Auth\OAuth;

use Illuminate\Http\Request;

class GitHubOAuthController extends BaseOAuthController
{
    public function __construct()
    {
        $this->authUrl = env('GITHUB_AUTH_URL');
        $this->redirectUrl = env('GITHUB_REDIRECT_URL');
        $this->tokenUrl = env('GITHUB_TOKEN_URL');
        $this->userInfoUrl = env('GITHUB_USER_INFO_URL');
        $this->clientId = env('GITHUB_CLIENT_ID');
        $this->clientSecret = env('GITHUB_CLIENT_SECRET');
        $this->serviceType = 3; //GitHub

        parent::__construct();
    }

    /**
     * Redirect user to GitHub to confirm signing in.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showGitHubAuthForm()
    {
        $params = [
            'client_id' => $this->clientId,
            'scope' => 'user:email'
        ];

        return $this->redirectToAuthService($params);
    }

    /**
     * Receive a special code in request from GitHub and go through auth flow.
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
        ];
        $postHeaders = [
            'Accept: application/json'
        ];

        return $this->passAuthFlow($postParams, $postHeaders);
    }
}
