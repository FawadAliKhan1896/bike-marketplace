<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BikeMarket') }}</title>

        <!-- Enterprise Font Selection: Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Core Stylesheet -->
        <link rel="stylesheet" href="{{asset('assets/styles.css')}}">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .auth-card {
                background: var(--white);
                padding: 40px;
                border-radius: var(--radius-lg);
                box-shadow: var(--shadow-xl);
                border: 1px solid var(--gray-200);
                width: 100%;
                max-width: 450px;
            }
            .auth-logo {
                margin-bottom: 32px;
                text-align: center;
            }
            .auth-logo img {
                height: 60px;
            }
            body {
                background-color: var(--gray-50);
                font-family: var(--font-sans);
            }
            input:focus {
                border-color: var(--primary) !important;
                ring-color: var(--primary) !important;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="auth-card">
                <div class="auth-logo">
                    <a href="/">
                        <img src="{{asset('assets/images/logo.png')}}" alt="BikeMarket Logo">
                    </a>
                </div>

                {{ $slot }}
            </div>
            
            <div style="margin-top: 24px; font-size: 14px; color: var(--gray-500);">
                &copy; {{ date('Y') }} BikeMarket (Pvt) Ltd.
            </div>
        </div>
    </body>
</html>
