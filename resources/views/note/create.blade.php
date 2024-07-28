<x-app-layout>
    <div class="max-w-4xl mx-auto p-4">
        <div class="py-4">
            <h3 class="font-medium text-lg text-gray-900">Create a new note</h3>
        </div>
        <form action="{{ route('note.store') }}" method="POST">
            @csrf <!--csrf token to protect against csrf attacks-->
            <div class="bg-white rounded-md p-4">
                <label for="title" class="font-medium text-gray-900">Note title</label>
                <textarea id="title" name="title" rows="2" maxlength="200" class="w-full text-gray-600 resize-none rounded-md" placeholder="Title"></textarea>
                <p class="text-gray-600">You may enter a maximum of 200 bytes or leave this space blank.</p>
                <p class="text-red-600">
                    @foreach ($errors->get('title') as $error)
                        {{ $error }}
                    @endforeach
                </p><br>
                <label for="note" class="font-medium text-gray-900">Note contents</label>
                <textarea required id="note" name="note" rows="10" maxlength="65535" class="w-full text-gray-600 resize-none rounded-md" placeholder="Contents"></textarea>
                <p class="text-gray-600">You may enter a maximum of 65,535 bytes.</p>
                <p class="text-red-600">
                    @foreach ($errors->get('note') as $error)
                        {{ $error }}
                    @endforeach
                </p>
            </div>
            <div class="pt-4">
                <button class="inline-flex items-center border px-2 py-1 bg-white rounded-md hover:bg-gray-100 focus:bg-gray-200 transition ease-in-out duration-150">
                    {{ __('Create note') }}
                </button>
            </div>
        </form>
        <div class="pt-2">
            <a href="{{ route('note.index') }}">
                <button class="inline-flex items-center border px-2 py-1 bg-white rounded-md hover:bg-gray-100 focus:bg-gray-200 transition ease-in-out duration-150">
                    {{ __('Cancel') }}
                </button>
            </a>
        </div>
    </div>
</x-app-layout>
