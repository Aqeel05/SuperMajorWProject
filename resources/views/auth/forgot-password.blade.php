<x-guest-layout>
    <!--
        Title
        Forgot password message used to be: No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
    -->
    <div>
        <h3 class="font-medium text-lg text-gray-900 dark:text-gray-400">Forgot your password?</h3>
        <p class="text-sm text-gray-600 dark:text-white">
            Enter your email address and we will send an email with a link to reset your password.<br>
            Remember to store your passwords somewhere!
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4 space-x-4">
            <a class="underline text-sm text-gray-600 dark:text-white hover:text-gray-900 dark:hover:text-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" href="{{ route('login') }}">
                {{ __('Return to login page') }}
            </a>
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
