<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mx-auto my-4">
            <p class="font-medium text-gray-900">
                @if ($note->title === "" || $note->title === null)
                    (No title)
                @else
                    {{ $note->title }}
                @endif    
            </p>
            <p class="text-gray-600">
                Created at {{ $note->created_at }}.<br>
                Updated at {{ $note->updated_at }}.<br>
                Note id: {{ $note->id }}
            </p>
        </div>
        <div class="bg-white rounded-md p-4 my-4 hover:shadow transition ease-in-out duration-150">
            <p class="text-gray-600">
                {{ $note->note }}
            </p>
        </div>
        <div class="flex">
            <a href="{{ route('note.index', $note) }}">
                <button class="inline-flex items-center border px-2 py-1 bg-white rounded-l-md hover:bg-gray-100 transition ease-in-out duration-150">
                    {{ __('Back to Notes') }}
                </button>
            </a>
            <a href="{{ route('note.edit', $note) }}">
                <button class="inline-flex items-center border px-2 py-1 bg-white rounded-r-md hover:bg-gray-100 transition ease-in-out duration-150">
                    {{ __('Edit') }}
                </button>
            </a>
        </div>
    </div>
</x-app-layout>
