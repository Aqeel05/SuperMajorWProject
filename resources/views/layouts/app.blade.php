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

        <!-- Alpine plugins and initialisation -->
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- CSS for loading spinner -->
    </head>
    <body x-data="{darkMode: $persist(true)}" :class="{'dark': darkMode === true }" class="font-sans antialiased">
        <div class="min-h-screen bg-gray-50 dark:bg-gray-950">
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
        <!-- Message prompt -->
        @if (session()->has('message'))
        <div id="message-prompt" class="absolute left-4 bottom-4 bg-white dark:bg-gray-800 rounded-md px-4 py-2">
            <p class="text-gray-600 dark:text-white">
                {{ session()->get('message') }}
            </p>
            <p class="text-gray-900 dark:text-gray-400 text-sm">Refresh to close this message prompt.</p>
        </div>
        @endif

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
