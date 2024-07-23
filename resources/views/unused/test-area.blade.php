<x-app-layout>
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