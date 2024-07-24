<section>
    <header>
        <h2 class="font-medium text-lg text-gray-900">
            {{ __('Uneditable information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('For safety purposes, the details in this section cannot be normally edited because they are highly sensitive.') }}
        </p>
    </header>
    <div class="mt-6">
        <p class="block font-medium text-sm text-gray-700">User ID</p>
        <p class="mt-1 text-sm text-gray-600">
            {{ __($user->id) }}
        </p>
    </div>
    <div class="mt-6">
        <p class="block font-medium text-sm text-gray-700">Account type</p>
        @if ($user->account_type_id === 1)
            <p class="mt-1 text-sm text-gray-600">
                {{ __($user->account_type_id . " (Patient)") }}
            </p>
        @elseif ($user->account_type_id === 2)
            <p class="mt-1 text-sm text-gray-600">
                {{ __($user->account_type_id . " (Staff)") }}
            </p>
        @else
            <p class="mt-1 text-sm text-gray-600">
                {{ __($user->account_type_id . " is not a valid account_type_id") }}
            </p>
        @endif
    </div>
    <div class="mt-6">
        <p class="block font-medium text-sm text-gray-700">Email verification status</p>
        @if (!$user->hasVerifiedEmail())
            <p class="mt-1 text-sm text-gray-600">
                Your email address is unverified.
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail)
                    <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Click here to send the verification email.') }}
                    </button>
                @else
                    You cannot verify your email.
                @endif
            </p>
            @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
            @endif
        @else
            <p class="mt-1 text-sm text-gray-600">
                {{ __("Your email address was verified at " . $user->email_verified_at . " UTC +8.") }}
            </p>  
        @endif
    </div>
</section>