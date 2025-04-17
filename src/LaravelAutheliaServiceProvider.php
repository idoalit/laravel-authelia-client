<?php

/**
 * File: LaravelAutheliaServiceProvider.php                                    *
 * Project: apps                                                               *
 * Created Date: Friday, April 11th 2025, 1:55:32 pm                           *
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

namespace Idoalit\LaravelAuthelia;

use Illuminate\Support\ServiceProvider;

class LaravelAutheliaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-authelia.php' => config_path('laravel-authelia.php'),
        ]);
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'idoalit.authelia');
    }
}
