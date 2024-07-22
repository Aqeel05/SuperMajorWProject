<x-app-layout>
    <!-- Script -->
    @vite(['resources/js/calendar.js'])
    <header>
        <!-- Header section -->
        <div class="bg-green-100 p-4">
            <h1 class="font-semibold text-5xl text-center text-green-500 py-2">Bookings</h1>
            <div class="max-w-5xl mx-auto">
                <p class="text-center text-gray-900 py-1">
                    A brief list of
                    @if (Auth::user()->account_type_id === 1)
                    your bookings.
                    @elseif (Auth::user()->account_type_id === 2)
                    all patients' bookings. For more information, visit a database viewer.
                    @endif
                </p>
                @if (Auth::user()->account_type_id === 1)
                <div class="flex justify-center">
                    <a href="{{ route('bookings.create') }}">
                        <x-standard-button>
                            {{ __('New Booking') }}
                        </x-standard-button>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </header>
    <main>
        <div class="flex flex-col space-y-4 lg:flex-row lg:space-x-4">
            <div class="lg:w-1/2 mx-auto p-4">
                <div class="calendar-wrapper rounded-md bg-white shadow-sm">
                <div class="flex justify-between">
                    <button id="btnPrev" type="button" class="inline-flex items-center border px-2 py-1 bg-white rounded-md hover:bg-gray-100 focus:bg-gray-200 transition ease-in-out duration-150">Prev</button>
                    <button id="btnNext" type="button" class="inline-flex items-center border px-2 py-1 bg-white rounded-md hover:bg-gray-100 focus:bg-gray-200 transition ease-in-out duration-150">Next</button>
                </div>
                <div id="divCal" class="mt-1"></div>
                </div>
            </div>
            <div class="lg:w-1/2 mx-auto p-4">
                <div>{{ $bookings->links() }}</div>
                <div>
                    <table id="data-table" class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="p-2 text-gray-900">ID</th>
                                @if (Auth::user()->account_type_id === 2)
                                <th class="p-2 text-gray-900">Patient ID</th>
                                @endif
                                <th class="p-2 text-gray-900">Booking date</th>
                                <th class="p-2 text-gray-900">Staff ID</th>
                                <th class="p-2 text-gray-900">Created at</th>
                                <th class="p-2 text-gray-900">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td class="p-2 font-semibold text-gray-900">{{ $booking->id }}</td>
                                    @if (Auth::user()->account_type_id === 2)
                                    <td class="p-2 text-gray-600">{{ $booking->patient_id }}</td>
                                    @endif
                                    <td class="p-2 text-gray-600">
                                        {{ $booking->booking_date }}<br>
                                        {{ date_diff(date_create(), date_create($booking->booking_date))->format("%R%ad %hh") }}
                                    </td>
                                    <td class="p-2 text-gray-600">
                                        <!-- Needs to have a null if statement because staff_id can be null -->
                                        @if ($booking->staff_id === null)
                                        Null
                                        @else
                                        {{ $booking->staff_id }}
                                        @endif
                                    </td>
                                    <td class="p-2 text-gray-600">{{ $booking->created_at }}</td>
                                    <td class="p-2 text-gray-600">
                                        <div class="flex items-center">
                                            <a href="{{ route('bookings.show', $booking) }}">
                                                <button class="inline-flex items-center border px-2 py-1 bg-white rounded-l-md hover:bg-gray-100 focus:bg-gray-200 transition ease-in-out duration-150">
                                                    {{ __('View') }}
                                                </button>
                                            </a>
                                            <a href="{{ route('bookings.edit', $booking) }}">
                                                <button class="inline-flex items-center border px-2 py-1 bg-white rounded-r-md hover:bg-gray-100 focus:bg-gray-200 transition ease-in-out duration-150">
                                                    {{ __('Edit') }}
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>