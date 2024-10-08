<x-app-layout>
    <div class="max-w-4xl mx-auto p-4">
        <div class="py-4">
            <h3 class="font-medium text-lg text-gray-900 dark:text-gray-400">Editing booking</h3>
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
        <form action="{{ route('bookings.update', $booking) }}" method="POST">
            @csrf <!--csrf token to protect against csrf attacks-->
            @method('PUT')
            <div class="bg-white dark:bg-gray-900 rounded-md p-4">
                <label for="booking_date" class="font-medium text-gray-900 dark:text-gray-400">Booking date</label>
                <input required type="datetime-local" id="booking_date" name="booking_date" value="{{ $booking->booking_date }}" class="ml-2 rounded-md text-gray-600 dark:text-white dark:bg-gray-900">
                @if (Auth::user()->account_type_id === 2)
                <br><br>
                <label for="status" class="font-medium text-gray-900 dark:text-gray-400">Status</label>
                <select id="status" name="status" value="{{ $booking->status }}" class="ml-2 rounded-md text-gray-600 dark:text-white dark:bg-gray-900">
                    <option value="Pending">Pending</option>
                    <option value="Ready">Ready</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select><br><br>
                <label for="staff" class="font-medium text-gray-900 dark:text-gray-400">Booking assignment</label>
                <select name="staff_id" id="staff" class="ml-2 rounded-md text-gray-600 dark:text-white dark:bg-gray-900">
                    <option value="{{$booking->staff_id}}">Keep old assignment</option>
                    <option value="{{Auth::user()->id}}">Assign yourself</option>
                </select>
                @endif
            </div>
            <div class="pt-4">
                <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                    {{ __('Make changes') }}
                </button>
            </div>
        </form>
        <div class="pt-2">
            <a href="{{ route('bookings.show', $booking) }}">
                <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                    {{ __('Cancel') }}
                </button>
            </a>
        </div>
    </div>
</x-app-layout>
