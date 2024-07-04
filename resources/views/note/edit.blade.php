<x-app-layout>
    <div class="max-w-4xl mx-auto p-4">
        <div class="py-4">
            <h3 class="font-medium text-lg text-gray-900">
                @if ($note->title === "" || $note->title === null)
                    (No title) - Editing
                @else
                    {{ $note->title }} - Editing
                @endif
            </h3>
            <p class="text-gray-600">
                Created at {{ $note->created_at }}.<br>
                Updated at {{ $note->updated_at }}.<br>
                Note id: {{ $note->id }}
            </p>
        </div>
        <form action="{{ route('note.update', $note) }}" method="POST">
            @csrf <!--csrf token to protect against csrf attacks-->
            @method('PUT')
            <div class="bg-white rounded-md p-4">
                <p class="font-medium text-gray-900">Note title</p>
                <textarea name="title" rows="1" class="w-full text-gray-600" placeholder="Enter your title here...">
                    {{ $note->title }}
                </textarea>
                <p class="font-medium text-gray-900">Note contents</p>
                <textarea name="note" rows="10" class="w-full text-gray-600" placeholder="Enter your note here...">
                    {{ $note->note }}
                </textarea>
            </div>
            <div class="mt-4">
                <button class="inline-flex items-center border px-2 py-1 bg-white rounded-md hover:bg-gray-100 transition ease-in-out duration-150">
                    {{ __('Make changes') }}
                </button>
            </div>
        </form>
        <div class="pt-2">
            <a href="{{ route('note.index') }}">
                <button class="inline-flex items-center border px-2 py-1 bg-white rounded-md hover:bg-gray-100 transition ease-in-out duration-150">
                    {{ __('Cancel') }}
                </button>
            </a>
        </div>
    </div>
</x-app-layout>
