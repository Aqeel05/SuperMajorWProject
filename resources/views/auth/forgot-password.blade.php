<x-guest-layout>
    <!--
        Title
        Forgot password message used to be: No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
    -->
    <div>
        <h3 class="font-sans font-medium text-lg text-gray-900">Forgot your password?</h3>
        <p class="font-sans text-sm text-gray-600">
            Enter your email address and Resend will send an email containing a link to reset your password.<br>
            You should remember your passwords through a safe password storage app.
            <a class="underline font-sans text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" href="{{ route('login') }}">
                {{ __('Return to login page') }}
            </a>
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="font-sans" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
