<?php

namespace App\Http\Controllers\Auth\OAuth;

use Illuminate\Http\Request;

class GitLabOAuthController extends BaseOAuthController
{
    public function __construct()
    {
        $this->authUrl = env('GITLAB_AUTH_URL');
        $this->tokenUrl = env('GITLAB_TOKEN_URL');
        $this->redirectUrl = env('GITLAB_REDIRECT_URL');
        $this->userInfoUrl = env('GITLAB_USER_INFO_URL');
        $this->clientId = env('GITLAB_CLIENT_ID');
        $this->clientSecret = env('GITLAB_CLIENT_SECRET');
        $this->serviceType = 4; //GitLab

        parent::__construct();
    }

    /**
     * Redirect user to GitLab to confirm signing in.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showGitLabAuthForm()
    {
        $params = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUrl,
            'scope' => 'read_user',
            'response_type' => 'code',
        ];

        return $this->redirectToAuthService($params);
    }

    /**
     * Receive a special code in request from GitLab and go through auth flow.
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
