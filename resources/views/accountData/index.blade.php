<x-app-layout>
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
            <h1 class="font-semibold text-5xl text-center text-green-500 py-2">Account data table</h1>
            <div class="max-w-5xl mx-auto">
                <p class="hidden sm:block text-center text-gray-900 dark:text-white py-1">
                    A brief table of all accounts in the users table in the database. For more detailed information, visit a database viewer tool.
                </p>
                <p class="block sm:hidden text-center text-gray-900 dark:text-white py-1">
                    Please rotate your device or expand the window to make the table visible.
                </p>
            </div>
        </div>
    </header>
    <main>
        <div class="hidden sm:block container mx-auto p-4">
            <div>{{ $users->links() }}</div>
            <div>
                <table id="data-table" class="table-auto w-full">
                    <thead>
                        <tr>
                            <th onclick="sortTable(0)" class="p-2 text-gray-900 dark:text-gray-400">ID</th>
                            <th onclick="sortTable(1)" class="p-2 text-gray-900 dark:text-gray-400">Name</th>
                            <th onclick="sortTable(2)" class="p-2 text-gray-900 dark:text-gray-400">Email</th>
                            <th onclick="sortTable(3)" class="p-2 text-gray-900 dark:text-gray-400">Account type</th>
                            <th onclick="sortTable(4)" class="p-2 text-gray-900 dark:text-gray-400">Email verified at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="p-2 font-semibold text-gray-900 dark:text-gray-400">{{ $user->id }}</td>
                                <td class="p-2 text-gray-600 dark:text-white">{{ $user->name }}</td>
                                <td class="p-2 text-gray-600 dark:text-white">{{ $user->email }}</td>
                                <td class="p-2 text-gray-600 dark:text-white">{{ $user->account_type_id }}</td>
                                <td class="p-2 text-gray-600 dark:text-white">{{ $user->email_verified_at ?? "Null" }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</x-app-layout>
