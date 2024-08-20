<x-app-layout>
    <header>
        <!-- Header section -->
        <div class="bg-green-100 dark:bg-green-900 p-4">
            <h1 class="font-semibold text-5xl text-center text-green-500 py-2">Notes</h1>
            <div class="max-w-5xl mx-auto">
                <p class="text-center text-gray-900 dark:text-white py-1">
                    Our project offers a note-taking feature so that our patients can remember and take down important information from their doctors.
                </p>
                <div class="flex justify-center">
                    <a href="{{ route('note.create') }}">
                        <x-standard-button>
                            {{ __('New Note') }}
                        </x-standard-button>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container mx-auto p-4">
            <div>
                {{ $notes->links() }}
            </div>  
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 py-4">
                @foreach($notes as $note)
                    <div class="bg-white dark:bg-gray-900 rounded-md p-4 min-w-80">
                        <div class="flex flex-col space-y-2 h-full">
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 dark:text-gray-400">
                                    {{ Str::words($note->title, 20) ?? "(No title)" }}
                                </p>
                                <p class="text-gray-600 dark:text-white">{{ $note->updated_at }} | Note id: {{ $note->id }}</p><br>
                                <p class="text-gray-600 dark:text-white">
                                    {{ Str::words($note->note, 40) }}
                                </p>
                            </div>
                            <div class="flex-none">
                                <div class="flex items-center justify-end">
                                    <a href="{{ route('note.show', $note) }}">
                                        <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-l-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                                            {{ __('View') }}
                                        </button>
                                    </a>
                                    <a href="{{ route('note.edit', $note) }}">
                                        <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-r-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                                            {{ __('Edit') }}
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
</x-app-layout>
