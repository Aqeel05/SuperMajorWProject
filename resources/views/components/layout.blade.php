<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- or can put app.css in public folder and 
        do <link rel="stylesheet" href="/app,css">
        -->

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        @session('message')
        <div class="success-message">
            {{ session('message') }}
        </div>
        @endsession
        {{ $slot }}
    </body>
</html>
