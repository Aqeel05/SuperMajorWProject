<x-app-layout>
    <header>
        <!-- Header section -->
        <div class="max-w-5xl mx-auto py-4">
            <h1 class="font-bold text-5xl text-center text-green-500">Account data</h1>
        </div>
    </header>
    <main>
        <div class="max-w-5xl mx-auto p-4 rounded-md bg-white">
            <p class="text-gray-600">
                @if ($users->count() > 1)
                    {{ $users->count() }} users found.
                @elseif ($users->count() === 1)    
                    {{ $users->count() }} user found.
                @endif
            </p>
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="p-2 text-gray-900">ID</th>
                        <th class="p-2 text-gray-900">Name</th>
                        <th class="p-2 text-gray-900">Email</th>
                        <th class="p-2 text-gray-900">Account Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="p-2 font-bold text-gray-900">{{ $user->id }}</td>
                            <td class="p-2 text-gray-600">{{ $user->name }}</td>
                            <td class="p-2 text-gray-600">{{ $user->email }}</td>
                            <td class="p-2 text-gray-600">{{ $user->account_type_id }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</x-app-layout>
