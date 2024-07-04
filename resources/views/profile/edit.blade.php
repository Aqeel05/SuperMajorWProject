<x-app-layout>
    <div class="bg-green-100 p-4">
        <h1 class="font-semibold text-5xl text-center text-green-500 py-2">Your profile</h1>
        <div class="max-w-5xl mx-auto">
            <p class="text-center text-gray-900 py-1">
                You can change your email, name, and password, as well as view other account particulars.
            </p>
        </div>    
    </div>
    <div class="pt-12 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight ml-4">
                {{ __('Profile details') }}
            </h2>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="font-medium text-lg text-gray-900">
                            {{ __('Uneditable information') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('For safety purposes, the details in this section cannot be normally edited because they are highly sensitive.') }}
                        </p>
                    </header>
                    <div class="mt-6">
                        <x-input-label :value="__('Account ID')" />
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __($user->id) }}
                        </p>
                    </div>
                    <div class="mt-6">
                        <x-input-label :value="__('Account type')" />
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
                        <x-input-label :value="__('Email verification status')" />
                        @if (! $user->hasVerifiedEmail())
                            <p class="mt-1 text-sm text-gray-600">Your email address is unverified.</p>
                        @else
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Your email address was verified at " . $user->email_verified_at . " UTC +8.") }}
                            </p>  
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight ml-4">
                {{ __('Safe zone') }}
            </h2>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
    <div class="pb-12 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <h2 class="font-semibold text-xl text-red-600 leading-tight ml-4">
                {{ __('Danger zone') }}
            </h2>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>    
    </div>
</x-app-layout>
