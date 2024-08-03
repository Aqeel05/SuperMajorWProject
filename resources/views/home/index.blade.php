<x-app-layout>
    <header>
        <!-- Header section -->
        <div class="bg-green-100 dark:bg-green-900 p-4">
            <div class="header-container">
                <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 3V7M17 5H21M19 17V21M17 19H21M10 5L8.53001 8.72721C8.3421 9.20367 8.24814 9.4419 8.10427 9.64278C7.97675 9.82084 7.82084 9.97675 7.64278 10.1043C7.4419 10.2481 7.20367 10.3421 6.72721 10.53L3 12L6.72721 13.47C7.20367 13.6579 7.4419 13.7519 7.64278 13.8957C7.82084 14.0233 7.97675 14.1792 8.10427 14.3572C8.24814 14.5581 8.3421 14.7963 8.53001 15.2728L10 19L11.47 15.2728C11.6579 14.7963 11.7519 14.5581 11.8957 14.3572C12.0233 14.1792 12.1792 14.0233 12.3572 13.8957C12.5581 13.7519 12.7963 13.6579 13.2728 13.47L17 12L13.2728 10.53C12.7963 10.3421 12.5581 10.2481 12.3572 10.1043C12.1792 9.97675 12.0233 9.82084 11.8957 9.64278C11.7519 9.4419 11.6579 9.20367 11.47 8.72721L10 5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <h1 class="font-semibold text-5xl text-center text-green-500 py-2">FWDIS</h1>
                <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 3V7M17 5H21M19 17V21M17 19H21M10 5L8.53001 8.72721C8.3421 9.20367 8.24814 9.4419 8.10427 9.64278C7.97675 9.82084 7.82084 9.97675 7.64278 10.1043C7.4419 10.2481 7.20367 10.3421 6.72721 10.53L3 12L6.72721 13.47C7.20367 13.6579 7.4419 13.7519 7.64278 13.8957C7.82084 14.0233 7.97675 14.1792 8.10427 14.3572C8.24814 14.5581 8.3421 14.7963 8.53001 15.2728L10 19L11.47 15.2728C11.6579 14.7963 11.7519 14.5581 11.8957 14.3572C12.0233 14.1792 12.1792 14.0233 12.3572 13.8957C12.5581 13.7519 12.7963 13.6579 13.2728 13.47L17 12L13.2728 10.53C12.7963 10.3421 12.5581 10.2481 12.3572 10.1043C12.1792 9.97675 12.0233 9.82084 11.8957 9.64278C11.7519 9.4419 11.6579 9.20367 11.47 8.72721L10 5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="max-w-5xl mx-auto">
                <h2 class="font-medium text-2xl text-green-600 py-1">The complete Foot Weight Distribution Identifier Solution</h2>
                <p class="text-gray-900 dark:text-gray-100 py-1">
                    <span class="font-medium text-green-600">The synopsis:</span> Many foot pressure distribution systems currently used by hospitals or clinics - despite their effectiveness - tend to be overly costly (hundreds to thousands of dollars) and have restricted portability (can only be used in hospital/clinic), forcing patients to travel to the intended locations for onsite measurements, and attempt to ascertain what their condition is.<br>
                    In order to improve and innovate on these systems, we intend to make use of revolutionary new materials and affordable equipment that increase portability and easy access to insights on the analysis of rehabilitative progress of patients.
                </p>
                <div class="flex space-x-2">
                    <a href="{{ route('home.about') }}">
                        <x-standard-button>
                            {{ __('Learn more ➜') }}
                        </x-standard-button>
                    </a>
                </div>
            </div>
        </div>
    </header>
</x-app-layout>
