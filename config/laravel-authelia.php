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
 
    'client_id' => env('OAUTH_CLIENT_ID', 'oauth-client-id'),
    'client_secret' => env('OAUTH_CLIENT_SECRET', 'oauth-client-secret'),
    'redirect_uri' => env('OAUTH_REDIRECT_URI', 'http://localhost:8000/oauth/callback'),

    'scope' => env('OAUTH_SCOPE', 'email profile'),
    'response_type' => env('OAUTH_RESPONSE_TYPE', 'code'),
    'grant_type' => env('OAUTH_GRANT_TYPE', 'authorization_code'),

    'base_url' => env('OAUTH_BASE_URL', 'http://localhost:8000/oauth'),
    'authorization_url' => env('OAUTH_AUTHORIZATION_URL', 'http://localhost:8000/oauth/authorize'),
    'token_url' => env('OAUTH_TOKEN_URL', 'http://localhost:8000/oauth/token'),
    'user_info_url' => env('OAUTH_USER_INFO_URL', 'http://localhost:8000/oauth/userinfo'),
    'user_info_email_field' => env('OAUTH_USER_INFO_EMAIL_FIELD', 'email'),

    'admin_page' => env('OAUTH_ADMIN_PAGE', 'http://localhost:8000/admin'),
    'admin_page_route' => env('OAUTH_ADMIN_PAGE_ROUTE', 'admin'),

    'user_page_route' => env('OAUTH_USER_PAGE_ROUTE', 'app'),
];