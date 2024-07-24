<x-app-layout>
    <div class="max-w-4xl mx-auto p-4">
        <div class="py-4">
            <h3 class="font-medium text-lg text-gray-900">Create a new booking</h3>
        </div>
        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf <!--csrf token to protect against csrf attacks-->
            <div class="bg-white rounded-md p-4 mb-4">
                <label for="booking_date" class="font-medium text-gray-900">Booking date</label>
                <input required type="datetime-local" id="booking_date" name="booking_date" class="ml-2 rounded-md">
                <p class="text-gray-600">It is recommended to book at least 14 days in advance to let the staff know of your booking.</p>
                <p class="text-red-600">
                    @foreach ($errors->get('booking_date') as $error)
                        {{ $error }}
                    @endforeach
                </p>
            </div>
            <div>
                <button class="inline-flex items-center border px-2 py-1 bg-white rounded-md hover:bg-gray-100 focus:bg-gray-200 transition ease-in-out duration-150">
                    {{ __('Create booking') }}
                </button>
            </div>
        </form>
        <div class="pt-2">
            <a href="{{ route('bookings.index') }}">
                <button class="inline-flex items-center border px-2 py-1 bg-white rounded-md hover:bg-gray-100 focus:bg-gray-200 transition ease-in-out duration-150">
                    {{ __('Cancel') }}
                </button>
            </a>
        </div>
    </div>
</x-app-layout>
