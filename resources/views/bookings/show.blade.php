<x-app-layout>
    <div class="max-w-4xl mx-auto p-4">
        <div class="py-4">
            <h3 class="font-medium text-lg text-gray-900 dark:text-gray-400">Viewing booking</h3>
            <p class="text-gray-600 dark:text-white">
                Created at {{ $booking->created_at }}.<br>
                Updated at {{ $booking->updated_at }}.<br>
                Booking id: {{ $booking->id }}<br>
                Booking status: {{ $booking->status }}<br>
                @if ($booking->staff_id === null)
                This booking has not yet been assigned to a staff.
                @else
                This booking has been assigned to the staff with id {{ $booking->staff_id }}.
                @endif
            </p>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-md p-4">
            <label for="booking_date" class="font-medium text-gray-900 dark:text-gray-400">Booking date</label>
            <input disabled type="datetime-local" id="booking_date" name="booking_date" value="{{ $booking->booking_date }}" class="ml-2 rounded-md text-gray-600 dark:text-white dark:bg-gray-900">
        </div>
        <section x-data="{open: false}">
            <div x-show="!open" class="flex pt-4">
                <a href="{{ route('bookings.index') }}">
                    <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-l-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                        {{ __('Back to Bookings') }}
                    </button>
                </a>
                <a href="{{ route('bookings.edit', $booking) }}">
                    <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                        {{ __('Edit') }}
                    </button>
                </a>
                <a>
                    <button x-on:click="open = true" class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-r-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                        {{ __('Delete') }}
                    </button>
                </a>
            </div>
            <div x-show="open" x-cloak class="pt-4">
                <h3 class="font-medium text-lg text-red-600">Are you sure you want to delete this booking?</h3>
                <p class="text-gray-600 dark:text-white pb-2">
                    You are about to destroy an entire booking, which will not only remove all of its contents, but also render the booking's id
                    permanently unusable. This cannot be undone.
                </p>
                <div class="flex justify-start space-x-4">
                    <x-secondary-button x-on:click="open = false">
                        {{ __( 'Cancel' )}}
                    </x-secondary-button>
                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST">
                        @csrf <!--csrf token to protect against csrf attacks-->
                        @method('DELETE')
                        <x-danger-button>
                            {{ __( 'Delete' )}}
                        </x-danger-button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
