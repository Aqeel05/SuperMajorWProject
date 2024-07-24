<!-- resources/views/session-details.blade.php -->
<x-app-layout>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Session Details</title>
    </head>
    <body>
        <div class="container mx-auto p-4">
            <h1>Session Details for Session ID: {{ $session->id }}</h1>
            <p>Start Time: {{ $session->datetimes[0] }}</p>
            <p>End Time: {{ $session->datetimes[1] }}</p>
        </div>
    </body>
</x-app-layout>
