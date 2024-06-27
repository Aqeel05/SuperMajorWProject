<x-app-layout>
    <header>
        <!-- Header section -->
        <div class="max-w-5xl mx-auto py-4">
            <h1 class="font-sans font-bold text-5xl text-center text-green-500">Your notes</h1>
            <div class="m-4 p-4 bg-white rounded-md">
                <h3 class="font-sans font-medium text-lg text-gray-900">It's under construction!</h3>
                <p class="font-sans text-gray-600">
                    This project has recently gained an email-sending feature so that users can verify their emails, and hence
                    access to this page. Considering this page has not hitherto been touched, things can appear a bit out of place.
                </p>
            </div>
            <p class="font-sans text-center py-2">
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
    <div class="note-container" py-12>
        <div class="notes">
            @foreach($notes as $note)
                <div class="note">
                    <div class="note-body">Note id: {{ $note->id }}</div>
                    <div class="note-body">
                        {{ Str::words($note->note, 30) }}
                    </div>
                    <div class="note-buttons">
                        <a href="{{ route('note.show', $note) }}" 
                        class="note-edit-button">View</a>
                        <a href="{{ route('note.edit', $note) }}" 
                        class="note-edit-button">Edit</a>
                        <form action="{{ route('note.destroy', $note) }}" method="POST">
                            @csrf <!--csrf token to protect against csrf attacks-->
                            @method('DELETE')
                            <button class="note-delete-button">Delete</button>
                        </form>
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
