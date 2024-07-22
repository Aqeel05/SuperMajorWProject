<x-app-layout>
    <header>
        <!-- Header section -->
        <div class="bg-green-100 p-4">
            <h1 class="font-semibold text-5xl text-center text-green-500 py-2">Account data table</h1>
            <div class="max-w-5xl mx-auto">
                <p class="text-center text-gray-900 py-1">
                    A brief list of all accounts in the users table in the database. For more detailed information, visit a database viewer.
                </p>
            </div>
        </div>
    </header>
    <main>
        <div class="container mx-auto p-4">
            <div>{{ $users->links() }}</div>
            <div>
                <table id="data-table" class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="p-2 text-gray-900">ID</th>
                            <th class="p-2 text-gray-900">Name</th>
                            <th class="p-2 text-gray-900">Email</th>
                            <th class="p-2 text-gray-900">Account type</th>
                            <th class="p-2 text-gray-900">Email verified at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="p-2 font-semibold text-gray-900">{{ $user->id }}</td>
                                <td class="p-2 text-gray-600">{{ $user->name }}</td>
                                <td class="p-2 text-gray-600">{{ $user->email }}</td>
                                <td class="p-2 text-gray-600">{{ $user->account_type_id }}</td>
                                <td class="p-2 text-gray-600">{{ $user->email_verified_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</x-app-layout>
