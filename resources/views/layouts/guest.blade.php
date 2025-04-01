<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                width: 100%;
            }

            .w-full {
                width: 100%;
            }

            *,
            *::before,
            *::after {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: Roboto, -apple-system, 'Helvetica Neue', 'Segoe UI', Arial, sans-serif;
                background: #3b4465;
            }

            .forms-section {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 20px;
            }

            .section-title {
                font-size: 32px;
                letter-spacing: 1px;
                color: #fff;
                text-align: center;
            }

            .forms {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
                max-width: 400px;
                margin-top: 30px;
            }

            .form-wrapper {
                animation: hideLayer .3s ease-out forwards;
                width: 100%;
            }

            .form-wrapper.is-active {
                animation: showLayer .3s ease-in forwards;
            }

            .switcher {
                position: relative;
                cursor: pointer;
                display: block;
                margin-right: auto;
                margin-left: auto;
                padding: 0;
                text-transform: uppercase;
                font-family: inherit;
                font-size: 16px;
                letter-spacing: .5px;
                color: #999;
                background-color: transparent;
                border: none;
                outline: none;
                transform: translateX(0);
                transition: all .3s ease-out;
                text-align: center;
            }

            .switcher-login .underline::before {
                transform: translateX(101%);
            }

            .switcher-signup .underline::before {
                transform: translateX(-101%);
            }

            .underline {
                position: absolute;
                bottom: -5px;
                left: 0;
                overflow: hidden;
                pointer-events: none;
                width: 100%;
                height: 2px;
            }

            .underline::before {
                content: '';
                position: absolute;
                top: 0;
                left: inherit;
                display: block;
                width: inherit;
                height: inherit;
                background-color: currentColor;
                transition: transform .2s ease-out;
            }

            .form {
                overflow: hidden;
                width: 100%;
                margin-top: 30px;
                padding: 30px 25px;
                border-radius: 5px;
                transform-origin: top;
                background-color: #fff;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .input-block {
                margin-bottom: 20px;
            }

            .input-block label {
                font-size: 14px;
                color: #a1b4b4;
            }

            .input-block input {
                display: block;
                width: 100%;
                margin-top: 8px;
                padding-right: 15px;
                padding-left: 15px;
                font-size: 16px;
                line-height: 40px;
                color: #3b4465;
                background: #eef9fe;
                border: 1px solid #cddbef;
                border-radius: 2px;
            }

            .form [type='submit'] {
                opacity: 0;
                display: block;
                min-width: 120px;
                margin: 30px auto 10px;
                font-size: 18px;
                line-height: 40px;
                border-radius: 25px;
                border: none;
                transition: all .3s ease-out;
            }

            .form-wrapper.is-active .form [type='submit'] {
                opacity: 1;
                transform: translateX(0);
                transition: all .4s ease-in;
            }

            .btn-login {
                color: #fbfdff;
                background: #a7e245;
                transform: translateX(-30%);
            }

            .btn-signup {
                color: #a7e245;
                background: #fbfdff;
                box-shadow: inset 0 0 0 2px #a7e245;
                transform: translateX(30%);
            }

            /* Media Queries for responsiveness */
            @media (max-width: 768px) {
                .section-title {
                    font-size: 24px;
                }

                .forms {
                    flex-direction: column;
                    max-width: 100%;
                    margin-top: 20px;
                }

                .form-wrapper {
                    width: 100%;
                }

                .form {
                    padding: 20px;
                }

                .switcher {
                    font-size: 14px;
                }

                .input-block input {
                    font-size: 14px;
                }

                .btn-login, .btn-signup {
                    font-size: 16px;
                    line-height: 35px;
                    padding: 10px 20px;
                }
            }

            @media (max-width: 480px) {
                .section-title {
                    font-size: 20px;
                }

                .forms {
                    margin-top: 15px;
                }

                .form {
                    padding: 15px;
                }

                .input-block input {
                    font-size: 14px;
                    padding: 12px;
                }

                .btn-login, .btn-signup {
                    font-size: 14px;
                    line-height: 30px;
                    padding: 8px 15px;
                }

                .switcher {
                    font-size: 12px;
                }
            }



        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">


            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
