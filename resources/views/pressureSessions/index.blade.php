<x-app-layout>
    <!-- Script -->
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
        <div class="bg-green-100 p-4">
            <h1 class="font-semibold text-5xl text-center text-green-500 py-2">Pressure session history</h1>
            <div class="max-w-5xl mx-auto">
                <p class="text-center text-gray-900 py-1">
                    A brief list of
                    @if (Auth::user()->account_type_id === 1)
                    your pressure sessions.
                    @elseif (Auth::user()->account_type_id === 2)
                    all patients' pressure sessions. For more detailed information, visit a database viewer tool.
                    @endif
                </p>
            </div>
        </div>
    </header>
    <main>
        <div class="container mx-auto p-4">
            <div>{{ $pressureSessions->links() }}</div>
            <div>
                <table id="data-table" class="table-auto w-full">
                    <thead>
                        <tr>
                            <th onclick="sortTable(0)" class="p-2 text-gray-900">ID</th>
                            @if (Auth::user()->account_type_id === 2)
                            <th onclick="sortTable(1)" class="p-2 text-gray-900">Patient ID</th>
                            <th onclick="sortTable(2)" class="p-2 text-gray-900">Start time</th>
                            <th onclick="sortTable(3)" class="p-2 text-gray-900 hidden sm:table-cell">End time</th>
                            @elseif (Auth::user()->account_type_id === 1)
                            <th onclick="sortTable(1)" class="p-2 text-gray-900">Start time</th>
                            <th onclick="sortTable(2)" class="p-2 text-gray-900 hidden sm:table-cell">End time</th>
                            @endif
                            <th class="p-2 text-gray-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pressureSessions as $pressureSession)
                            <tr>
                                <td class="p-2 font-semibold text-gray-900">{{ $pressureSession->id }}</td>
                                @if (Auth::user()->account_type_id === 2)
                                <td class="p-2 text-gray-600">{{ $pressureSession->user_id }}</td>
                                @endif
                                <td class="p-2 text-gray-600">
                                    {{ $pressureSession->datetimes[0] ?? "Null" }}
                                </td>
                                <td class="p-2 text-gray-600 hidden sm:table-cell">
                                    {{ $pressureSession->datetimes[1] ?? "Null" }}
                                </td>
                                <td class="p-2 text-gray-600">
                                    <div class="flex items-center">
                                        <a href="{{ route('pressureSessions.show', $pressureSession) }}"> <!-- route('pressureSessions.show', $pressureSession) -->
                                            <button class="inline-flex items-center border px-2 py-1 bg-white rounded-l-md hover:bg-gray-100 focus:bg-gray-200 transition ease-in-out duration-150">
                                                {{ __('View') }}
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
    </main>
</x-app-layout>