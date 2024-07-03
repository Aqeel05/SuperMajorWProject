<x-app-layout>
    <header>
        <!-- Header section -->
        <div class="max-w-5xl mx-auto py-4">
            <h1 class="font-bold text-5xl text-center text-green-500">Your notes</h1>
            <div class="m-4 p-4 bg-white rounded-md">
                <h3 class="font-medium text-lg text-gray-900">It's under construction!</h3>
                <p class="text-gray-600">
                    This project has recently gained an email-sending feature so that users can verify their emails, and hence
                    access to this page. Considering this page has not hitherto been touched, things can appear a bit out of place.
                </p>
            </div>
            <p class="text-center py-2">
                FWDIS offers a note-taking feature so that our patients can remember and take down important information from their doctors.<br>
                @if ($notes->count() > 1)
                    {{ __($notes->count() . " notes found.") }}
                @elseif ($notes->count() === 1)
                    {{ __($notes->count() . " note found.") }}
                @else
                    {{ __("You have no notes.") }}
                @endif
            </p>
            <div class="flex space-x-2 justify-center">
                <a href="{{ route('note.create') }}">
                    <x-standard-button>
                        {{ __('New Note') }}
                    </x-standard-button>
                </a>
            </div>
        </div>
    </header>
    <main>
        <div class="container mx-auto p-4">
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 py-4">
                @foreach($notes as $note)
                    <div class="bg-white rounded-md p-4 hover:shadow transition ease-in-out duration-150">
                        <p class="font-medium text-gray-900">
                            @if ($note->title === "" || $note->title === null)
                                (No title)
                            @else
                                {{ Str::words($note->title, 20) }}
                            @endif    
                        </p>
                        <div class="text-gray-600">{{ $note->updated_at }}</div><br>
                        <div class="text-gray-600">
                            {{ Str::words($note->note, 40) }}
                        </div>
                        <div class="flex justify-end">
                            <a href="{{ route('note.show', $note) }}">
                                <button class="inline-flex items-center border px-2 py-1 bg-white rounded-l-md hover:bg-gray-100 transition ease-in-out duration-150">
                                    {{ __('View') }}
                                </button>
                            </a>
                            <a href="{{ route('note.edit', $note) }}">
                                <button class="inline-flex items-center border px-2 py-1 bg-white rounded-r-md hover:bg-gray-100 transition ease-in-out duration-150">
                                    {{ __('Edit') }}
                                </button>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="p-6">
                {{ $notes->links() }}
            </div>
        </div>
    </main>
</x-app-layout>
