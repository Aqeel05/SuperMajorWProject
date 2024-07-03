<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
            // Script to toggle the profile dropdown
            function toggleDropdown() {
                var dropdown = document.getElementById("profile-dropdown");
                if (dropdown.style.display !== "block") { dropdown.style.display = "block"; }
                else {dropdown.style.display = "none";}
            }

            // Script to toggle the patient page dropdown
            function toggleDropdown2() {
                var dropdown2 = document.getElementById("patient-dropdown");
                if (dropdown2.style.display !== "block") { dropdown2.style.display = "block"; }
                else {dropdown2.style.display = "none";}
            }

            // Script to toggle the delete menu
            function toggleDeleteMenu() {
                var menu = document.getElementById("delete-menu");
                if (menu.style.display !== "block") { menu.style.display = "block"; }
                else {menu.style.display = "none";}
            }
        </script>

        <!-- CSS for loading spinner -->
        
    </head>
    <body class="antialiased">
        <!--
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
        -->
        
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
</html>
