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

        .subtitle {
            color: #333;
            text-align: center;
            font-size: 1.5em;
            margin: 10px;
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

        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px; /* Adjust the spacing between items */
        }
    </style>

    <header>
        
        <div class="header-container">
            <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 3V7M17 5H21M19 17V21M17 19H21M10 5L8.53001 8.72721C8.3421 9.20367 8.24814 9.4419 8.10427 9.64278C7.97675 9.82084 7.82084 9.97675 7.64278 10.1043C7.4419 10.2481 7.20367 10.3421 6.72721 10.53L3 12L6.72721 13.47C7.20367 13.6579 7.4419 13.7519 7.64278 13.8957C7.82084 14.0233 7.97675 14.1792 8.10427 14.3572C8.24814 14.5581 8.3421 14.7963 8.53001 15.2728L10 19L11.47 15.2728C11.6579 14.7963 11.7519 14.5581 11.8957 14.3572C12.0233 14.1792 12.1792 14.0233 12.3572 13.8957C12.5581 13.7519 12.7963 13.6579 13.2728 13.47L17 12L13.2728 10.53C12.7963 10.3421 12.5581 10.2481 12.3572 10.1043C12.1792 9.97675 12.0233 9.82084 11.8957 9.64278C11.7519 9.4419 11.6579 9.20367 11.47 8.72721L10 5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h1 class="title" style="font-family: cursive;">FWDIS</h1> 
            <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 3V7M17 5H21M19 17V21M17 19H21M10 5L8.53001 8.72721C8.3421 9.20367 8.24814 9.4419 8.10427 9.64278C7.97675 9.82084 7.82084 9.97675 7.64278 10.1043C7.4419 10.2481 7.20367 10.3421 6.72721 10.53L3 12L6.72721 13.47C7.20367 13.6579 7.4419 13.7519 7.64278 13.8957C7.82084 14.0233 7.97675 14.1792 8.10427 14.3572C8.24814 14.5581 8.3421 14.7963 8.53001 15.2728L10 19L11.47 15.2728C11.6579 14.7963 11.7519 14.5581 11.8957 14.3572C12.0233 14.1792 12.1792 14.0233 12.3572 13.8957C12.5581 13.7519 12.7963 13.6579 13.2728 13.47L17 12L13.2728 10.53C12.7963 10.3421 12.5581 10.2481 12.3572 10.1043C12.1792 9.97675 12.0233 9.82084 11.8957 9.64278C11.7519 9.4419 11.6579 9.20367 11.47 8.72721L10 5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <h2 class="subtitle">The complete Foot Weight Distribution Identifier Solution</h2>
    </header>

    <div class="content">
        <h2 class="title">Introduction</h2>
        <p>
            <span class="highlight">The synopsis:</span> A lot of foot weight distribution identifiers, although effective, are unfortunately not accessible enough to be used outside a specific measurement room, much less an entire building where that room is.<br>
            To solve this problem, our aim is to create a highly accessible foot pressure distribution identifier to ascertain foot pressure distribution patterns, particularly in the elderly or those with mobility impairments.
        </p>
        <br>
    </div>

    <div class="box">
        <h3>About FWDIS</h3>
        <p>The information of this project has recently been moved to a new layout to save index space.</p>
        <a href="{{ route('home.about') }}" class="box-small">About</a>
    </div>

</x-app-layout>
