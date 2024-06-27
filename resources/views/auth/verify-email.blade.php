<x-guest-layout>
    <!-- 
        Title
        Previous message was: Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
        If you didn\'t receive the email, we will gladly send you another.
    -->
    <div>
        <h3 class="font-sans font-medium text-gray-900 text-lg">Identify yourself.</h3>
        <p class="font-sans text-gray-600 text-sm">
            You must have your email address verified before proceeding further.<br>
            Press the Send Verification Email button below and Resend will send an email containing a link to verify your email address.
            If you did not receive the email, you may request again. However, due to the limited number of emails Resend can send (100/day), you are not
            guaranteed to receive one.<br>
            Alternatively, you may choose to leave by clicking the icon.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-sans font-medium text-sm text-green-600">
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

            <button type="submit" class="underline font-sans text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
