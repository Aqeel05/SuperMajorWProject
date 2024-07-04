<x-app-layout>
    <div class="max-w-4xl mx-auto p-4">
        <div class="py-4">
            <h3 class="font-medium text-lg text-gray-900">
                @if ($note->title === "" || $note->title === null)
                    (No title)
                @else
                    {{ $note->title }}
                @endif    
            </h3>
            <p class="text-gray-600">
                Created at {{ $note->created_at }}.<br>
                Updated at {{ $note->updated_at }}.<br>
                Note id: {{ $note->id }}
            </p>
        </div>
        <div class="bg-white rounded-md p-4">
            <p class="text-gray-600">
                {{ $note->note }}
            </p>
        </div>
        <div class="flex mt-4">
            <a href="{{ route('note.index', $note) }}">
                <button class="inline-flex items-center border px-2 py-1 bg-white rounded-l-md hover:bg-gray-100 transition ease-in-out duration-150">
                    {{ __('Back to Notes') }}
                </button>
            </a>
            <a href="{{ route('note.edit', $note) }}">
                <button class="inline-flex items-center border px-2 py-1 bg-white hover:bg-gray-100 transition ease-in-out duration-150">
                    {{ __('Edit') }}
                </button>
            </a>
            <a>
                <button onclick="toggleOpenableMenu()" class="inline-flex items-center border px-2 py-1 bg-white rounded-r-md hover:bg-gray-100 transition ease-in-out duration-150">
                    {{ __('Delete') }}
                </button>
            </a>
        </div>
        <div id="openable-menu" class="hidden py-4">
            <h3 class="font-medium text-lg text-red-600">Are you sure you want to delete this note?</h3>
            <p class="text-gray-600 pb-2">
                You are about to destroy an entire note, which will not only remove all of its contents, but also render the note's id
                permanently unusable. This cannot be undone. Press the white Delete button above to cancel.
            </p>
            <form action="{{ route('note.destroy', $note) }}" method="POST">
                @csrf <!--csrf token to protect against csrf attacks-->
                @method('DELETE')
                <x-danger-button>
                    {{ __( 'Delete' )}}
                </x-danger-button>
            </form>
        </div>
    </div>
</x-app-layout>
