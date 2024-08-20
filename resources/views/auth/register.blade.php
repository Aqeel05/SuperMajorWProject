<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Title and help section -->
        <div>
            <h3 class="font-medium text-lg text-gray-900 dark:text-gray-400">Create a new account</h3>
            <p class="text-sm text-gray-600 dark:text-white">You may register as a patient or staff.</p>
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block my-1 w-full" type="text" name="name" minlength="1" maxlength="100" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <p class="text-sm text-gray-600 dark:text-white">Required; 1 - 100 characters long</p>
        </div>

        <!-- Email address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block my-1 w-full" type="email" name="email" minlength="6" maxlength="200" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <p class="text-sm text-gray-600 dark:text-white">Required; 6 - 200 characters long</p>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block my-1 w-full" type="password" name="password" minlength="8" maxlength="40" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <p class="text-sm text-gray-600 dark:text-white">Required; 8 - 40 characters long</p>
        </div>

        <!-- Confirm password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm password')" />
            <x-text-input id="password_confirmation" class="block my-1 w-full" type="password" name="password_confirmation" minlength="8" maxlength="40" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            <p class="text-sm text-gray-600 dark:text-white">Required; must be the same as Password</p>
        </div>

        <!-- Radio buttons for users to sign up as either a patient or staff -->
        <div class="mt-4">
            <p class="font-medium text-sm text-gray-700 dark:text-gray-200">Account type</p>
            <div class="mt-1 flex flex-col space-y-1">
                <div class="border border-gray-300 dark:border-gray-600 rounded-md shadow-sm px-2 py-1">
                    <input type="radio" id="patient" name="account_type_id" value=1 class="text-green-500 focus:ring-green-500">
                    <label for="patient" class="text-sm text-gray-600 dark:text-white">Patient</label>
                </div>
                <div class="border border-gray-300 dark:border-gray-600 rounded-md shadow-sm px-2 py-1">
                    <input type="radio" id="staff" name="account_type_id" value=2 class="text-green-500 focus:ring-green-500">
                    <label for="staff" class="text-sm text-gray-600 dark:text-white">Staff</label>
                </div>
            </div>
            <x-input-error :messages="$errors->get('account_type_id')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4 space-x-4">
            <a class="underline text-sm text-gray-600 dark:text-white hover:text-gray-900 dark:hover:text-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            <x-primary-button>
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
