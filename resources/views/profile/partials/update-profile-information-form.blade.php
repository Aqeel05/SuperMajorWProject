<section>
    <header>
        <h3 class="font-medium text-lg text-gray-900">
            {{ __('Update profile') }}
        </h3>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="my-1 block w-full" :value="old('name', $user->name)" required autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
            <p class="text-sm text-gray-600">Required; 1 - 100 characters long</p>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="my-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
            <p class="text-sm text-gray-600">Required; 1 - 200 characters long</p>
        </div>

        <div>
            <p class="block font-medium text-sm text-gray-700">Account type</p>
            <div class="mt-1 flex flex-col space-y-1">
                <div class="border border-gray-300 rounded-md shadow-sm px-2 py-1">
                    <input type="radio" id="patient" name="account_type_id" value=1 class="text-green-500 focus:ring-green-500" required>
                    <label for="patient" class="text-sm text-gray-600">Patient</label>
                </div>
                <div class="border border-gray-300 rounded-md shadow-sm px-2 py-1">
                    <input type="radio" id="staff" name="account_type_id" value=2 class="text-green-500 focus:ring-green-500" required>
                    <label for="staff" class="text-sm text-gray-600">Staff</label>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
