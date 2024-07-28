<x-app-layout>
    <div class="max-w-4xl mx-auto p-4">
        <div class="py-4">
            <h3 class="font-medium text-lg text-gray-900">
                {{ $note->title ?? "(No title)" }}
            </h3>
            <p class="text-gray-600">
                Created at {{ $note->created_at }}.<br>
                Updated at {{ $note->updated_at }}.<br>
                Note id: {{ $note->id }}
            </p>
        </div>
        <div class="bg-white rounded-md p-4">
            <!-- No white spaces should be inserted here, as that will create an unnecessarily large gap between the start of the text area and the text itself. -->
            <textarea disabled name="note" rows="10" class="w-full text-gray-600 resize-none border-none">{{ $note->note }}</textarea>
        </div>
        <section x-data="{open: false}">
            <div x-show="!open" class="flex pt-4">
                <a href="{{ route('note.index') }}">
                    <button class="inline-flex items-center border px-2 py-1 bg-white rounded-l-md hover:bg-gray-100 focus:bg-gray-200 transition ease-in-out duration-150">
                        {{ __('Back to Notes') }}
                    </button>
                </a>
                <a href="{{ route('note.edit', $note) }}">
                    <button class="inline-flex items-center border px-2 py-1 bg-white hover:bg-gray-100 focus:bg-gray-200 transition ease-in-out duration-150">
                        {{ __('Edit') }}
                    </button>
                </a>
                <a>
                    <button x-on:click="open = true" class="inline-flex items-center border px-2 py-1 bg-white rounded-r-md hover:bg-gray-100 focus:bg-gray-200 transition ease-in-out duration-150">
                        {{ __('Delete') }}
                    </button>
                </a>
            </div>
            <div x-show="open" x-cloak class="pt-4">
                <h3 class="font-medium text-lg text-red-600">Are you sure you want to delete this note?</h3>
                <p class="text-gray-600 pb-2">
                    You are about to destroy an entire note, which will not only remove all of its contents, but also render the note's id
                    permanently unusable. This cannot be undone.
                </p>
                <div class="flex justify-start space-x-4">
                    <x-secondary-button x-on:click="open = false">
                        {{ __( 'Cancel' )}}
                    </x-secondary-button>
                    <form action="{{ route('note.destroy', $note) }}" method="POST">
                        @csrf <!--csrf token to protect against csrf attacks-->
                        @method('DELETE')
                        <x-danger-button>
                            {{ __( 'Delete' )}}
                        </x-danger-button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
