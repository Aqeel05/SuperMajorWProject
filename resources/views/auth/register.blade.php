<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Title and help section -->
        <div>
            <h3 class="font-sans font-medium text-lg text-gray-900">Create a new account.</h3>
            <p class="font-sans text-sm text-gray-600">This is the register page. In both the register and login pages, you can click the icon above to return home if you do not wish to register or log in.</p>
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" class="font-sans" />
            <x-text-input id="name" class="block my-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="font-sans mt-2" />
            <p class="font-sans text-sm text-gray-600">Required; 1 - 100 characters long</p>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="font-sans" />
            <x-text-input id="email" class="block my-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="font-sans mt-2" />
            <p class="font-sans text-sm text-gray-600">Required; 1 - 200 characters long</p>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="font-sans" />

            <x-text-input id="password" class="block my-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="font-sans mt-2" />
            <p class="font-sans text-sm text-gray-600">Required</p>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="font-sans" />

            <x-text-input id="password_confirmation" class="block my-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="font-sans mt-2" />
            <p class="font-sans text-sm text-gray-600">Required; must be the same as Password</p>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline font-sans text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
