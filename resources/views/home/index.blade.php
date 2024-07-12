<x-app-layout>
    <header>
        <!-- Header section -->
        <div class="bg-green-100 p-4">
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
                <p class="text-gray-900 py-1">
                    <span class="font-medium text-green-600">The synopsis:</span> A lot of foot weight distribution identifiers, although effective, are unfortunately not accessible enough to be used outside a specific measurement room, much less an entire building where that room is.<br>
                    To solve this problem, our aim is to create a highly accessible foot pressure distribution identifier to ascertain foot pressure distribution patterns, particularly in the elderly or those with mobility impairments.
                </p>
                <div class="flex space-x-2">
                    <a href="{{ route('home.about') }}">
                        <x-standard-button>
                            {{ __('➜ Learn more') }}
                        </x-standard-button>
                    </a>
                </div>
            </div>
            
        </div>
    </header>
    <main>
        <div class="flex flex-col space-y-4">
            <div class="container max-w-screen-md mx-auto p-4">
                <h2 class="font-semibold text-2xl text-center text-green-600 py-2">Test area</h2>
                <p class="text-gray-600">An example of an Alpine.js reactive dropdown.</p>
                <div class="flex justify-center">
                    <div
                        x-data="{open: false}"
                        class="relative"
                    >
                        <!-- Button -->
                        <button
                            x-ref="button"
                            x-on:click="open = !open"
                            type="button"
                            class="flex items-center gap-2 bg-white px-5 py-2.5 rounded-md shadow"
                        >
                            Options
                
                            <!-- Hero icon: chevron-down -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                
                        <!-- Panel -->
                        <div
                            x-ref="panel"
                            x-show="open"
                            x-transition.opacity
                            x-transition.duration.200ms
                            style="display: none;"
                            class="absolute left-0 mt-2 w-40 rounded-md bg-white shadow-md"
                        >
                            <a href="#" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                                New Task
                            </a>
                
                            <a href="#" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                                Edit Task
                            </a>
                
                            <a href="#" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                                <span class="text-red-600">Delete Task</span>
                            </a>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600">The button is still being tested. For reference, the CSS for the button can be found in the component, standard-button.blade.php. Also it leaves a small white ring between the green ring and the button border.</p>
                <div class="flex space-x-2 justify-center">
                    <a>
                        <x-standard-button>
                            {{ __('This doesn\'t do anything') }}
                        </x-standard-button>
                    </a>
                    @auth
                    <a>
                        <x-standard-button-dark>
                            {{ __("Logged in as " . Auth::user()->name) }}
                        </x-standard-button-dark>
                    </a>
                    @endauth
                </div>
                <p class="text-gray-600">
                    Another set of buttons that features no horizontal space between them.<br>
                    The leftmost button has rounded left borders. The rightmost button has rounded right borders.<br>
                    All of the middle buttons do not have any rounded borders so that they can fit with the non-rounded borders of the other buttons.
                </p>
                <div class="flex justify-center">
                    <a>
                        <button class="inline-flex items-center text-gray-600 border px-2 py-1 bg-white rounded-l-md hover:bg-gray-100 transition ease-in-out duration-150">
                            {{ __('1') }}
                        </button>
                    </a>
                    <a>
                        <button class="inline-flex items-center text-gray-600 border px-2 py-1 bg-white hover:bg-gray-100 transition ease-in-out duration-150">
                            {{ __('2') }}
                        </button>
                    </a>
                    <a>
                        <button class="inline-flex items-center text-gray-600 border px-2 py-1 bg-white hover:bg-gray-100 transition ease-in-out duration-150">
                            {{ __('3') }}
                        </button>
                    </a>
                    <a>
                        <button class="inline-flex items-center text-gray-600 border px-2 py-1 bg-white rounded-r-md hover:bg-gray-100 transition ease-in-out duration-150">
                            {{ __('4') }}
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
