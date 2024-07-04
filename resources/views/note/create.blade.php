<x-app-layout>
    <div class="max-w-4xl mx-auto p-4">
        <div class="py-4">
            <h3 class="font-medium text-lg text-gray-900">Create a new note</h3>
        </div>
        <form action="{{ route('note.store') }}" method="POST">
            @csrf <!--csrf token to protect against csrf attacks-->
            <div class="bg-white rounded-md p-4 mb-4 hover:shadow transition ease-in-out duration-150">
                <textarea name="note" rows="10" class="w-full text-gray-600" placeholder="Enter your note here..."></textarea>
            </div>
            <div>
                <button class="inline-flex items-center border px-2 py-1 bg-white rounded-md hover:bg-gray-100 transition ease-in-out duration-150">
                    {{ __('Create note') }}
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
