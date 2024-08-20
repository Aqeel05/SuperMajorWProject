<x-app-layout>
    <!-- Script -->
    @vite(['resources/js/calendar.js'])
    <script>
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("data-table");
            switching = true;
            //Set the sorting direction to ascending:
            dir = "asc"; 
            /*Make a loop that will continue until
            no switching has been done:*/
            while (switching) {
                //start by saying: no switching is done:
                switching = false;
                rows = table.rows;
                /*Loop through all table rows (except the
                first, which contains table headers):*/
                for (i = 1; i < (rows.length - 1); i++) {
                    //start by saying there should be no switching:
                    shouldSwitch = false;
                    /*Get the two elements you want to compare,
                    one from current row and one from the next:*/
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    /*check if the two rows should switch place,
                    based on the direction, asc or desc:*/
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch= true;
                        break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                        }
                    }
                }
                if (shouldSwitch) {
                    /*If a switch has been marked, make the switch
                    and mark that a switch has been done:*/
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    //Each time a switch is done, increase this count by 1:
                    switchcount ++;      
                } else {
                    /*If no switching has been done AND the direction is "asc",
                    set the direction to "desc" and run the while loop again.*/
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
    </script>
    <header>
        <!-- Header section -->
        <div class="bg-green-100 dark:bg-green-900 p-4">
            <h1 class="font-semibold text-5xl text-center text-green-500 py-2">Bookings</h1>
            <div class="max-w-5xl mx-auto">
                <p class="text-center text-gray-900 dark:text-white py-1">
                    A brief list of
                    @if (Auth::user()->account_type_id === 1)
                    your bookings.
                    @elseif (Auth::user()->account_type_id === 2)
                    all patients' bookings. For more detailed information, visit a database viewer tool.
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
        <div class="flex flex-col lg:flex-row lg:space-x-4">
            <div class="w-full max-w-lg mx-auto p-2 sm:p-4">
                <div class="calendar-wrapper rounded-md bg-white dark:bg-gray-900 shadow-sm">
                <div class="flex justify-between">
                    <button id="btnPrev" type="button" class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">Previous</button>
                    <button id="btnNext" type="button" class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">Next</button>
                </div>
                <div id="divCal" class="mt-1"></div>
                </div>
            </div>
            <div class="mx-auto p-4">
                <div>{{ $bookings->links() }}</div>
                <div>
                    <table id="data-table" class="table-auto w-full">
                        <thead>
                            <tr>
                                <th onclick="sortTable(0)" class="p-2 text-gray-900 dark:text-gray-400">ID</th>
                                @if (Auth::user()->account_type_id === 2)
                                <th onclick="sortTable(1)" class="p-2 text-gray-900 dark:text-gray-400">Patient ID</th>
                                <th onclick="sortTable(2)" class="p-2 text-gray-900 dark:text-gray-400">Booking date</th>
                                <th onclick="sortTable(3)" class="p-2 text-gray-900 dark:text-gray-400 hidden sm:table-cell">Staff ID</th>
                                @elseif (Auth::user()->account_type_id === 1)
                                <th onclick="sortTable(1)" class="p-2 text-gray-900 dark:text-gray-400">Booking date</th>
                                <th onclick="sortTable(2)" class="p-2 text-gray-900 dark:text-gray-400 hidden sm:table-cell">Staff ID</th>
                                @endif
                                <th class="p-2 text-gray-900 dark:text-gray-400 hidden sm:table-cell">Status</th>
                                <th class="p-2 text-gray-900 dark:text-gray-400 hidden sm:table-cell">Created at</th>
                                <th class="p-2 text-gray-900 dark:text-gray-400">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td class="p-2 font-semibold text-gray-900 dark:text-gray-400">{{ $booking->id }}</td>
                                    @if (Auth::user()->account_type_id === 2)
                                    <td class="p-2 text-gray-600 dark:text-white">{{ $booking->patient_id }}</td>
                                    @endif
                                    <td class="p-2 text-gray-600 dark:text-white">
                                        {{ $booking->booking_date }}<br>
                                        {{ date_diff(date_create(), date_create($booking->booking_date))->format("%R%ad %hh") }}
                                    </td>
                                    <td class="p-2 text-gray-600 dark:text-white hidden sm:table-cell">
                                        <!-- Needs to have a null coalescence because staff_id can be null -->
                                        {{ $booking->staff_id ?? "Null" }}
                                    </td>
                                    <td class="p-2 text-gray-600 dark:text-white hidden sm:table-cell">
                                        {{ $booking->status }}
                                    </td>
                                    <td class="p-2 text-gray-600 dark:text-white hidden sm:table-cell">{{ $booking->created_at }}</td>
                                    <td class="p-2 text-gray-600 dark:text-white">
                                        <div class="flex items-center">
                                            <a href="{{ route('bookings.show', $booking) }}">
                                                <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-l-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                                                    {{ __('View') }}
                                                </button>
                                            </a>
                                            <a href="{{ route('bookings.edit', $booking) }}">
                                                <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-r-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
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