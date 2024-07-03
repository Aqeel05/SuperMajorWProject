<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mx-auto my-4">
            <p class="font-medium text-gray-900">Create new note</p>
        </div>
        <form action="{{ route('note.store') }}" method="POST">
            @csrf <!--csrf token to protect against csrf attacks-->
            <div class="bg-white rounded-md p-4 my-4 hover:shadow transition ease-in-out duration-150">
                <textarea name="note" rows="10" class="w-full text-gray-600" placeholder="Enter your note here..."></textarea>
            </div>
            <div class="flex">
                <button class="inline-flex items-center border px-2 py-1 bg-white rounded-md hover:bg-gray-100 transition ease-in-out duration-150">
                    {{ __('Create note') }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
