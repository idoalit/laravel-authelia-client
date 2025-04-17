<?php
/**
 * File: laravel-authelia.php                                                  *
 * Project: apps                                                               *
 * Created Date: Friday, April 11th 2025, 2:29:17 pm                           *
 * Author: Waris Agung Widodo <ido.alit@gmail.com>                             *
 * -----                                                                       *
 * Last Modified: Sat Apr 12 2025                                              *
 * Modified By: Waris Agung Widodo                                             *
 * -----                                                                       *
 * Copyright (c) 2025 Waris Agung Widodo                                       *
 * -----                                                                       *
 * HISTORY:                                                                    *
 * Date      	By	Comments                                                   *
 * ----------	---	---------------------------------------------------------  *
 */

return [
    /*
     * The default guard for the application
     * This is used to determine which guard to use for authentication
     */
    'client_id' => env('OAUTH_CLIENT_ID', 'oauth_client_id'),
    'client_secret' => env('OAUTH_CLIENT_SECRET', 'oauth_client_secret'),
    'redirect_uri' => env('OAUTH_REDIRECT_URI', 'oauth/callback'),

    'scope' => env('OAUTH_SCOPE', 'email profile'),
    'response_type' => env('OAUTH_RESPONSE_TYPE', 'code'),
    'grant_type' => env('OAUTH_GRANT_TYPE', 'authorization_code'),

    /**
     * Configuration for the OAuth2 server
     * The default values are for the Poltekkes Semarang OAuth2 server
     */
    'base_url' => env('OAUTH_BASE_URL', 'https://auth.poltekkes-smg.ac.id'),
    'authorization_url' => env('OAUTH_AUTHORIZATION_URL', 'https://auth.poltekkes-smg.ac.id/api/oidc/authorization'),
    'token_url' => env('OAUTH_TOKEN_URL', 'https://auth.poltekkes-smg.ac.id/api/oidc/token'),
    'user_info_url' => env('OAUTH_USER_INFO_URL', 'https://auth.poltekkes-smg.ac.id/api/oidc/userinfo'),
    'user_info_email_field' => env('OAUTH_USER_INFO_EMAIL_FIELD', 'email'),
];