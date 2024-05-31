<x-app-layout>
    <style>
        body {
            font-family: "Segoe UI Emoji", "Segoe UI Symbol";
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f5f5f5;
        }

        .title {
            text-align: center;
            margin-top: 0px;
            font-size: 2.5em;
            color: #04AA6D;
        }

        .content {
            margin: 0 auto;
            max-width: 800px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .highlight {
            color: #04AA6D;
            font-weight: bold;
        }

        .box {
            margin: 20px auto;
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .box h3 {
            margin-bottom: 10px;
            color: #04AA6D;
        }

        .box p {
            margin-bottom: 20px;
        }

        .box-small {
            display: inline-block;
            padding: 10px 20px;
            background-color: #04AA6D;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
        }

        .box-small:hover {
            background-color: #066f4b;
        }
    </style>

    <header>
        <h1 class="title">FWDIS</h1> 
        <h2 class="title">An accessible Foot Weight Distribution Identifier Solution</h2>
    </header>

    <div class="content">
        <h2 class="title">Introduction</h2>
        <p>
            <span class="highlight">The synopsis:</span> A lot of foot weight distribution identifiers, although effective, are unfortunately not accessible enough to be used outside a specific measurement room, much less an entire building where that room is.<br>
            To solve this problem, our aim is to create a highly accessible foot pressure distribution identifier to ascertain foot pressure distribution patterns, particularly in the elderly or those with mobility impairments.
        </p>
    </div>

    <div class="box">
        <h3>About FWDIS</h3>
        <p>The information of this project has recently been moved to a new layout to save index space.</p>
        <a href="{{ route('home.about') }}" class="box-small">About</a>
    </div>

</x-app-layout>
