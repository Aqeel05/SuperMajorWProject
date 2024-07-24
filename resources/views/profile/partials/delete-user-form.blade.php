<section x-data="{'isModalOpen': false}">
    <div x-show="!isModalOpen">
        <header>
            <h2 class="font-medium text-lg text-red-700">
                {{ __('Delete account') }}
            </h2>
        </header>
        <p class="mt-1 text-sm text-red-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
        <x-danger-button x-on:click="isModalOpen = true" class="mt-2">
            {{ __('Delete Account') }}
        </x-danger-button>
    </div>

    <div
        x-show="isModalOpen"
        x-cloak
    >
        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <h2 class="font-medium text-lg text-red-700">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-red-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end space-x-4">
                <x-secondary-button x-on:click="isModalOpen = false">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button>
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </div>
</section>
