<x-guest-layout>
    <!-- 
        Title
        Previous message was: Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
        If you didn\'t receive the email, we will gladly send you another.
    -->
    <div>
        <h3 class="font-medium text-gray-900 dark:text-gray-400 text-lg">Identify yourself.</h3>
        <p class="text-gray-600 dark:text-white text-sm">
            You must have your email address verified before proceeding.<br>
            Click on the Send Verification Email button below and we will send an email containing a link to verify your email address.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Send Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="underline text-sm text-gray-600 dark:text-white hover:text-gray-900 dark:hover:text-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
