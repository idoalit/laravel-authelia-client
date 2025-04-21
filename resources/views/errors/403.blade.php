{{--
 * File: 403.blade.php                                                         *
 * Project: apps                                                               *
 * Created Date: Friday, April 11th 2025, 2:32:02 pm                           *
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
 --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 403 - Forbidden</title>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Lato");

        * {
            position: relative;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Lato", sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to bottom right, #EEE, #AAA);
        }

        h1 {
            margin: 40px 0 20px;
        }

        .lock {
            border-radius: 5px;
            width: 55px;
            height: 45px;
            background-color: #333;
            animation: dip 1s;
            animation-delay: 1.5s;
        }

        .lock::before,
        .lock::after {
            content: "";
            position: absolute;
            border-left: 5px solid #333;
            height: 20px;
            width: 15px;
            left: calc(50% - 12.5px);
        }

        .lock::before {
            top: -30px;
            border: 5px solid #333;
            border-bottom-color: transparent;
            border-radius: 15px 15px 0 0;
            height: 30px;
            animation: lock 2s, spin 2s;
        }

        .lock::after {
            top: -10px;
            border-right: 5px solid transparent;
            animation: spin 2s;
        }

        .message {
            text-align: center;
            color: #333;
            font-size: 20px;
            animation: dip 1s;
            animation-delay: 1.5s;
        }

        @keyframes lock {
            0% {
                top: -45px;
            }

            65% {
                top: -45px;
            }

            100% {
                top: -30px;
            }
        }

        @keyframes spin {
            0% {
                transform: scaleX(-1);
                left: calc(50% - 30px);
            }

            65% {
                transform: scaleX(1);
                left: calc(50% - 12.5px);
            }
        }

        @keyframes dip {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(10px);
            }

            100% {
                transform: translateY(0px);
            }
        }
        .alert {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #d6d8db;
            border-radius: 5px;
            background-color: #f8d7da;
            color: #721c24;
            font-size: 16px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="lock"></div>
    <div class="message">
        <h1>Access to this page is restricted</h1>
        <p>Contact your administrator if you think this is a mistake.</p>
        @if (session('message'))
            <p class="alert">{{ session('message') }}</p>
        @endif
        <p>Or go back to <a href="{{ url('/') }}">home</a></p>
    </div>
</body>

</html>