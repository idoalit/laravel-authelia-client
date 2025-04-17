<?php
/**
 * File: web.php                                                               *
 * Project: apps                                                               *
 * Created Date: Friday, April 11th 2025, 2:07:44 pm                           *
 * Author: Waris Agung Widodo <ido.alit@gmail.com>                             *
 * -----                                                                       *
 * Last Modified: Fri Apr 11 2025                                              *
 * Modified By: Waris Agung Widodo                                             *
 * -----                                                                       *
 * Copyright (c) 2025 Waris Agung Widodo                                       *
 * -----                                                                       *
 * HISTORY:                                                                    *
 * Date      	By	Comments                                                   *
 * ----------	---	---------------------------------------------------------  *
 */

use Idoalit\LaravelAuthelia\Http\Controllers\OauthController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::get('oauth/login', [OauthController::class, 'index'])->name('oauth.login');
    Route::get('oauth/callback', [OauthController::class, 'callback'])->name('oauth.callback');
    Route::get('oauth/unauthorized', [OauthController::class, 'unauthorized'])->name('oauth.unauthorized');
});