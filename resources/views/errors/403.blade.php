@extends('layouts.errs')
@include('layouts.navigation') <!-- Include navigation here -->

<div class="container px-60 py-40">
    <div class="flex flex-col space-y-4">
        <h1 class="font-bold text-7xl">403 Forbidden</h1>
        <h2 class="text-4xl">"You shall not pass!"</h2>
        <p>The system has detected that you have been authenticated, but due to insufficient credentials, it is refusing access to this page.</p>
        <a href="{{ route('home.index') }}">
            <x-primary-button>
                {{ __('Get back to safety') }}
            </x-primary-button>
        </a>
    </div>
</div>