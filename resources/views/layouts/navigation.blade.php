<nav x-data="{ open: false }" class="sticky top-0 bg-white dark:bg-green-600 border-b border-gray-100 dark:border-gray-600 z-10">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home.index') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- All navigation links -->
                <div class="hidden space-x-8 md:-my-px md:ml-10 md:flex">
                    <!-- Standard navigation links -->
                    <x-nav-link :href="route('home.index')" :active="request()->routeIs('home.index')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('home.about')" :active="request()->routeIs('home.about')">
                        {{ __('About') }}
                    </x-nav-link>
                    <!-- Authenticated (staff and patient) navigation links -->
                    <!-- For this div-button-dropdown combo, the div has the border CSS while the button text has the text CSS -->
                    @auth
                    <!-- Start of the dropdown -->
                    <div
                        x-data="{open: false}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent
                        hover:border-gray-300 dark:hover:border-gray-100
                        focus:outline-none focus:border-gray-300
                        transition duration-150 ease-in-out"
                    >
                        <!-- Button -->
                        <button
                            x-on:click="open = !open"
                            class="inline-flex items-center text-sm font-medium leading-5 text-gray-500 dark:text-white
                            hover:text-gray-700 dark:hover:text-gray-200
                            transition duration-150 ease-in-out"
                        >
                            <div>Patient pages</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>

                        <!-- Panel -->
                        <div
                            x-ref="panel"
                            x-show="open"
                            x-transition.opacity
                            x-transition.duration.200ms
                            x-on:click.away="open = false"
                            style="display: none;"
                            class="origin-top absolute top-12 mt-2 w-48 rounded-md shadow-lg py-1 bg-white dark:bg-gray-800 ring-1 ring-black dark:ring-gray-200 ring-opacity-5"
                        >
                            <x-dropdown-link :href="route('note.index')" :active="request()->routeIs('note.index')">
                                {{ __('Notes') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('bookings.index')" :active="request()->routeIs('bookings.index')">
                                {{ __('Bookings') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('analytics.sending')" :active="request()->routeIs('analytics.sending')">
                                {{ __('Send MQTT') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('analytics.send')" :active="request()->routeIs('analytics.send')">
                                {{ __('Send analytics') }}
                            </x-dropdown-link>
                        </div>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('analytics.index')" :active="request()->routeIs('analytics.index')">
                            {{ __('Analytics') }}
                        </x-nav-link>
                        <x-nav-link :href="route('history.index')" :active="request()->routeIs('history.index')">
                            {{ __('Past sessions') }}
                        </x-nav-link>
                    </div>

                    <!-- Staff-only navigation link -->
                    @if (Auth::user()->id === 2)
                    <x-nav-link :href="route('accountData.index')" :active="request()->routeIs('accountData.index')">
                        {{ __('Account datatable') }}
                    </x-nav-link>
                    @endif
                    @endauth
                    <!-- Light/dark theme toggle switch (navbar) -->
                    <div class="inline-flex items-center px-1 pt-1">
                        <x-theme-toggle/>
                    </div>
                </div>
            </div>

            <!-- User profile settings dropdown -->
            <div class="hidden md:flex md:items-center md:ml-6 ml-auto">
                @auth
                    <!-- Start of the dropdown -->
                    <div
                        x-data="{open: false}"
                        class="relative"
                    >
                        <!-- Button -->
                        <button
                            x-ref="button"
                            x-on:click="open = !open"
                            type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md
                            text-white bg-green-600 dark:bg-gray-800
                            hover:bg-green-500 dark:hover:bg-gray-700
                            focus:outline-none
                            transition ease-in-out duration-150"
                        >
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>

                        <!-- Panel -->
                        <div
                            x-ref="panel"
                            x-show="open"
                            x-transition.opacity
                            x-transition.duration.200ms
                            x-on:click.away="open = false"
                            style="display: none;"
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white dark:bg-gray-800 ring-1 ring-black dark:ring-gray-200 ring-opacity-5"
                        >
                            <x-dropdown-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </div>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md
                        text-gray-500 dark:text-white
                        hover:text-gray-700
                        focus:outline-none
                        transition ease-in-out duration-150"
                    >
                        {{ __('Login') }}
                    </a>
                    <a
                        href="{{ route('register') }}"
                        class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md
                        text-white bg-green-600 dark:bg-gray-800
                        hover:bg-green-500 dark:hover:bg-gray-700
                        focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-0
                        transition ease-in-out duration-150"
                    >
                        {{ __('Get started ➜') }}
                    </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center md:hidden">
                <button
                    @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md
                    text-gray-400 dark:text-white
                    hover:text-gray-500 hover:bg-gray-200 dark:hover:text-gray-200 dark:hover:bg-green-600
                    focus:outline-none focus:bg-gray-200 focus:text-gray-500 dark:focus:bg-green-500 dark:focus:text-white
                    transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive navigation menu -->
    <div
        x-ref="panel"
        x-show="open"
        x-transition.opacity
        x-transition.duration.200ms
        style="display: none;"
        class="absolute bg-white dark:bg-gray-800 w-full z-10 md:hidden"
    >
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home.index')" :active="request()->routeIs('home.index')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('home.about')" :active="request()->routeIs('home.about')">
                {{ __('About') }}
            </x-responsive-nav-link>
            @guest
                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            @endguest

            @auth
                <x-responsive-nav-link :href="route('note.index')" :active="request()->routeIs('note.index')">
                    {{ __('Notes') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.index')">
                    {{ __('Bookings') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('history.index')" :active="request()->routeIs('history.index')">
                    {{ __('Past sessions') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('analytics.sending')" :active="request()->routeIs('analytics.sending')">
                    {{ __('Send MQTT') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('analytics.send')" :active="request()->routeIs('analytics.send')">
                    {{ __('Send analytics') }}
                </x-responsive-nav-link>
                @if (Auth::user()->id === 2)
                <x-responsive-nav-link :href="route('accountData.index')" :active="request()->routeIs('accountData.index')">
                    {{ __('Account datatable') }}
                </x-responsive-nav-link>
                @endif  
            @endauth
        </div>

        <!-- Responsive user profile settings -->
        <div class="py-4 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-300">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-green-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4">
                    <a href="{{ route('login') }}" class="font-medium text-base text-gray-800 dark:text-white">
                        {{ __('Login') }}
                    </a>
                </div>
            @endauth
            <!-- Light/dark theme toggle switch (small menu) -->
            <div class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent transition duration-150 ease-in-out">
                <x-theme-toggle/>
            </div>
        </div>
    </div>
</nav>
