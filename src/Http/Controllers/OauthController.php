<?php

/**
 * File: OauthController.php                                                   *
 * Project: apps                                                               *
 * Created Date: Friday, April 11th 2025, 2:14:44 pm                           *
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

namespace Idoalit\LaravelAuthelia\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class OauthController extends Controller
{
    function index()
    {
        // generate and save state
        $state = bin2hex(random_bytes(16));
        session(['oauth_state' => $state]);

        // Construct the full URL
        $auth_url = config('laravel-authelia.authorization_url') . '?' . http_build_query([
            'client_id' => config('laravel-authelia.client_id'),
            'redirect_uri' => url(config('laravel-authelia.redirect_uri')),
            'response_type' => config('laravel-authelia.response_type'),
            'scope' => config('laravel-authelia.scope'),
            'state' => $state
        ]);

        return redirect()->away($auth_url);
    }

    function callback(Request $request)
    {
        $code = request('code');
        $state = request('state');

        // Check if the state parameter matches the one stored in the session
        if ($state !== session('oauth_state')) {
            // redirect to login page
            return redirect()->route('oauth.login');
        }

        // Prepare the POST request
        $data = [
            'grant_type' => config('laravel-authelia.grant_type'),
            'code' => $code,
            'redirect_uri' => url(config('laravel-authelia.redirect_uri')),
            'client_id' => config('laravel-authelia.client_id'),
            'client_secret' => config('laravel-authelia.client_secret')
        ];

        try {
            $response = Http::asForm()->post(config('laravel-authelia.token_url'), $data);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('filament.admin.auth.login');
        }

        // Decode the JSON response to get the access token
        $token_data = json_decode($response, true);
        $access_token = $token_data['access_token'] ?? null;

        if (is_null($access_token)) {
            Log::error($response->body());
            // redirect to login page
            return redirect()->route('oauth.login');
        }

        // save token data to session
        session(['oauth_token' => $token_data]);

        try {
            $response = Http::withToken($access_token)->get(config('laravel-authelia.user_info_url'));
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('filament.admin.auth.login');
        }

        // Output the protected resource data
        $resource_data = json_decode($response, true);
        $email = $resource_data[config('laravel-authelia.user_info_email_field')];

        $user = User::firstOrCreate(['email' => $email], [
            'name' => $resource_data['name'],
            'email' => $email,
            'identity' => $resource_data['preferred_username'] ?? null,
            'password' => Hash::make(uniqid()),
            'is_admin' => false,
            'is_active' => true,
        ]);

        if ($resource_data['email_verified']) {
            $user->email_verified_at = now();
            $user->save();
        }

        if (!$user->is_active) {
            session()->flash('message', 'User is not active');
            session()->flash('name', $resource_data['name']);
            return redirect()->route('oauth.unauthorized');
        }

        $panel_user = config('filament-shield.panel_user.name');
        $super_admin = config('filament-shield.super_admin.name');

        if (!$user->hasRole($panel_user)) {
            // create user panel role if not exists
            $userPanelRole = Role::firstOrCreate(['name' => $panel_user]);
            $user->assignRole($userPanelRole);
        }

        // check if user_id is all number and length is 18
        // if true, assign user to ASN role
        if (preg_match('/^\d{18}$/', $user->identity)) {
            $staffRole = Role::firstOrCreate(['name' => 'ASN']);
            $user->assignRole($staffRole);
        }

        // check if user_id is all number and length is 12
        // if true, assign user to BLU role
        if (preg_match('/^\d{12}$/', $user->identity)) {
            $staffRole = Role::firstOrCreate(['name' => 'BLU']);
            $user->assignRole($staffRole);
        }

        if (in_array($user->email, ['waris.agung@poltekkes-smg.ac.id'])) {
            $user->is_admin = true;
            $user->save();

            if (!$user->hasRole($super_admin)) {
                // create admin role if not exists
                $adminRole = Role::firstOrCreate(['name' => $super_admin]);
                $user->assignRole($adminRole);
            }
        }

        Auth::loginUsingId($user->id);

        // redirect into dashboard admin page
        if ($user->hasRole($super_admin)) {
            return redirect()->intended(config('laravel-authelia.admin_page_route'));
        }

        // redirect into dashboard user page
        return redirect()->intended(config('laravel-authelia.user_page_route'));
    }

    function unauthorized()
    {
        return view('idoalit.authelia::errors.403');
    }
}
