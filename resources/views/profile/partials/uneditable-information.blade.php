<section>
    <header>
        <h2 class="font-medium text-lg text-gray-900 dark:text-gray-400">
            {{ __('Uneditable information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-white">
            {{ __('For safety purposes, the details in this section cannot be normally edited because they are highly sensitive.') }}
        </p>
    </header>
    <div class="mt-6">
        <p class="block font-medium text-sm text-gray-700 dark:text-gray-200">User ID</p>
        <p class="mt-1 text-sm text-gray-600 dark:text-white">
            {{ __($user->id) }}
        </p>
    </div>
    <div class="mt-6">
        <p class="block font-medium text-sm text-gray-700 dark:text-gray-200">Account type</p>
        <p class="mt-1 text-sm text-gray-600 dark:text-white">
        @if ($user->account_type_id === 1)
            {{ __($user->account_type_id . " (Patient)") }}
        @elseif ($user->account_type_id === 2)
            {{ __($user->account_type_id . " (Staff)") }}
        @else
            {{ __($user->account_type_id . " is not a valid account_type_id") }}
        @endif
        </p>
    </div>
    <div class="mt-6">
        <p class="block font-medium text-sm text-gray-700 dark:text-gray-200">Email verification status</p>
        @if (!$user->hasVerifiedEmail())
            <p class="mt-1 text-sm text-gray-600 dark:text-white">
                Your email address is unverified.
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail)
                    <button form="send-verification" class="underline text-sm text-gray-600 dark:text-white hover:text-gray-900 dark:hover:text-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
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
            <p class="mt-1 text-sm text-gray-600 dark:text-white">
                {{ __("Your email address was verified at " . $user->email_verified_at . " UTC +8.") }}
            </p>  
        @endif
    </div>
</section>