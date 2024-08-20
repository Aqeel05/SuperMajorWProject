<x-app-layout>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
        <script src="https://d3js.org/d3.v7.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="user-id" content="{{ Auth::id() }}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" type="text/css" href="dashboard.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/dashboard.css', 'resources/js/app.js', 'resources/js/analytics.js'])

        <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
        <style>
            .ratios-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-top: 10px;
                margin-bottom: 10px;
                background-color: #f0f0f0;
                padding: 10px;
                border-radius: 5px;
                text-align: center;
            }
            .ratios {
                display: flex;
                justify-content: space-around;
                width: 100%;
                margin-bottom: 10px;
            }
            .ratio-text {
                font-size: 1.2em;
                font-weight: bold;
                text-align: center;
                margin: 5px;
                border: 2px solid black;
                padding: 5px;
            }
            .visualization-container {
                display: flex;
                justify-content: center;
                margin-bottom: 20px;
            }
            #heatmap, #chart {
                width: 80%;
                max-width: 800px;
                margin: auto;
            }
            #foot3D {
                transform: translateX(50px); 
                width: 80%;
                max-width: 800px;
                margin: auto;
            }
            .refresh-btn, .capture-btn, .btn-container button {
                display: block;
                margin: 10px auto;
                padding: 10px 20px;
                font-size: 1em;
                font-weight: bold;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: all 0.3s ease;
            }
            .capture-btn {
                background-color: #3cc6a1;
            }
            .refresh-btn:hover, .capture-btn:hover, .btn-container button:hover {
                background-color: #45a049;
                transform: scale(1.05);
            }
            .capture-btn:hover {
                background-color: #34b08c;
            }
            .disabled-btn {
                background-color: #ccc;
                color: #666;
                cursor: not-allowed;
            }
            .heatmap-container {
                display: flex;
                justify-content: space-around;
                margin: auto;
                width: 100%;
                max-width: 1600px; /* Optional: Adjust as needed */
            }
            .heatmap {
                width: 45%; /* Adjust width to your needs */
                margin: 0 10px; /* Add some spacing between heatmaps */
            }
        </style>
    </head>
    <body>
        <ul class="wrapper">
            <li class="form-row">
                <label for="topic">Topic</label>
                <input type="text" id="topic" />
            </li>
         
            <li class="form-row">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="10" readonly></textarea>
            </li>
         
            <li class="form-row">
                <label for="status">Status</label>
                <input type="text" id="status" readonly />
            </li>
            <li class="form-row-save">
                <label class="switch">
                    <input type="checkbox" id="save-session-checkbox">
                    <span class="slider"></span>
                </label>
                <label for="save-session-checkbox">Save Sessions</label>
            </li>
            <li class="form-row">
                <div class="btn-container">
                    <button type="button" id="subscribe">Start Session</button>
                    <button type="button" id="unsubscribe">End Session</button>
                    <button type="button" id="save-session">Download Session</button>
                </div>
                <button class="capture-btn" type="button" id="capture">Capture</button>
            </li>
        </ul>

        <button class="refresh-btn" id="refresh">Refresh Graphs</button>

        <div class="line"></div>

        <!-- Combined visualization container -->
        <div class="heatmap-container">
            <div id='heatmap1' class="heatmap"></div>
            <div id='heatmap2' class="heatmap"></div>
        </div>

        <div id="chart-container">
            <div id="chart"></div>
        </div>

        <br>

        <div class="visualization-container">
            <div id="foot3D"></div>
        </div>

        <br>

    </body>
</x-app-layout>
