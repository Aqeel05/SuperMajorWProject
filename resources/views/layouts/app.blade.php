<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Title and favicon -->
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/x-icon" href="pictures/application-logo.svg">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=lexend:300,400,500,600,700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- CSS for loading spinner -->
        
    </head>
    <body class="font-sans antialiased">
        @auth
        <div class="spinner-wrapper" id="spinner">
            <div class="spinner">
                <svg
                    class="container" 
                    x="0px" 
                    y="0px"
                    viewBox="0 0 50 31.25"
                    height="31.25"
                    width="50"
                    preserveAspectRatio='xMidYMid meet'
                    >
                    <path 
                        class="track"
                        stroke-width="4" 
                        fill="none" 
                        pathlength="100"
                        d="M0.625 21.5 h10.25 l3.75 -5.875 l7.375 15 l9.75 -30 l7.375 20.875 v0 h10.25"
                    />
                    <path 
                        class="car"
                        stroke-width="4" 
                        fill="none" 
                        pathlength="100"
                        d="M0.625 21.5 h10.25 l3.75 -5.875 l7.375 15 l9.75 -30 l7.375 20.875 v0 h10.25"
                    />
                </svg>
            </div>
        </div>
        @endauth
        
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
    <footer>
        <!--
            Previous title was: Starting Template - Webchat;
            Previous description was: Our virtual agent is here to help you;
            Previous hex colour was: 2E7FF1
        -->

        @auth
        <script type="text/javascript">
            (function(d, t) {
                var v = d.createElement(t), s = d.getElementsByTagName(t)[0];
                v.onload = function() {
                    window.voiceflow.chat.load({
                    verify: { projectID: '6690879b3bcb0b5459016ad4' },
                    url: 'https://general-runtime.voiceflow.com',
                    versionID: 'production'
                    });
                }
                v.src = "https://cdn.voiceflow.com/widget/bundle.mjs"; v.type = "text/javascript"; s.parentNode.insertBefore(v, s);
            })(document, 'script');
        </script>
        @endauth
    </footer>
</html>
