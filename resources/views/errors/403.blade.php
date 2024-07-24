@extends('layouts.errs')
@include('layouts.navigation') <!-- Include navigation here -->

<style>
    #main {
        background-color: black;
        height: 93%;
    }

    #main h1, p {
        font-family: monospace;
        text-shadow: 0px 0px 6px;
    }

    @keyframes blink {
        0% {
            opacity: 0;
        }

        49% {
            opacity: 0;
        }

        50% {
            opacity: 1;
        }

        100% {
            opacity: 1;
        }
    }

    .blink {
        animation-name: blink;
        animation-duration: 2s;
        animation-iteration-count: infinite;
    }
</style>

<div id="main">
    <div class="flex flex-col justify-center items-center space-y-2 p-16">
        <div>
            <h1 class="text-5xl text-green-400">403 Forbidden</h1>
        </div>
        <div>
            <p class="text-red-500">You shouldn't have done that.</p>
        </div>
    </div>
</div>