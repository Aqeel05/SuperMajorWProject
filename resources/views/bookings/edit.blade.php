<x-app-layout>
    <div class="max-w-4xl mx-auto p-4">
        <div class="py-4">
            <h3 class="font-medium text-lg text-gray-900">Editing booking</h3>
            <p class="text-gray-600">
                Created at {{ $booking->created_at }}.<br>
                Updated at {{ $booking->updated_at }}.<br>
                Booking id: {{ $booking->id }}<br>
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
            <div class="bg-white rounded-md p-4">
                <label for="booking_date" class="font-medium text-gray-900">Booking date</label>
                <input required type="datetime-local" id="booking_date" name="booking_date" value="{{ $booking->booking_date }}" class="ml-2 rounded-md"><br><br>
                @if (Auth::user()->account_type_id === 2)
                <label for="staff" class="font-medium text-gray-900">Booking assignment</label>
                <select required name="staff_id" id="staff" class="ml-2 rounded-md">
                    <option value="{{$booking->staff_id}}">Keep old assignment</option>
                    <option value="{{Auth::user()->id}}">Assign yourself</option>
                </select>
                @endif
            </div>
            <div class="pt-4">
                <button class="inline-flex items-center border px-2 py-1 bg-white rounded-md hover:bg-gray-100 focus:bg-gray-200 transition ease-in-out duration-150">
                    {{ __('Make changes') }}
                </button>
            </div>
        </form>
        <div class="pt-2">
            <a href="{{ route('bookings.show', $booking) }}">
                <button class="inline-flex items-center border px-2 py-1 bg-white rounded-md hover:bg-gray-100 focus:bg-gray-200 transition ease-in-out duration-150">
                    {{ __('Cancel') }}
                </button>
            </a>
        </div>
    </div>
</x-app-layout>
