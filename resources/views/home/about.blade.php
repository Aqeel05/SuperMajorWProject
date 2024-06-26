<x-app-layout>
    <style>
        body {
            color: #000000;
            font-family: "Figtree";
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
    </style>

    <header>
        <div class="relative max-w-5xl mx-auto py-4">
            <h1 class="font-sans font-bold text-5xl text-center text-green-500">About the solution</h1>
        </div>
    </header>

    <main>
        <div class="flex flex-col space-y-4">
            <div class="container mx-auto p-4">
                <h3 class="font-sans font-bold text-center text-green-600">How does it work?</h3>
                <h2 class="font-sans font-bold text-2xl text-center text-green-600">The entire process</h2>
                <div class="grid sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8 py-4">
                    <div>
                        <h3 class="font-sans font-bold text-green-600">1: Patient registration</h3>
                        <p class="font-sans">A patient first has to register. Their details are stored in a MySQL database accessible via phpMyAdmin.</p>
                    </div>
                    <div>
                        <h3 class="font-sans font-bold text-green-600">2: Pressure sessions</h3>
                        <p class="font-sans">
                            Pressure sessions help to determine which pressure data is attributed to a specific patient and session.<br>
                            Data can only be monitored during pressure sessions.
                        </p>
                    </div>
                    <div>
                        <h3 class="font-sans font-bold text-green-600">3: Sourcing of data from ESP32 and the pressure sensors</h3>
                        <p class="font-sans">
                            Just before a pressure session, the patient first steps on the foot pressure mat that contains many pressure sensors connected to a central ESP32 Arduino integrated circuit.<br>
                            Once that is done, the assigned staff member will start the pressure session for that specific patient in the database.<br>
                            During this time, the weight of the patient's feet causes the pressure sensors to change in resistance and hence the voltage through them.
                        </p>
                    </div>
                    <div>
                        <h3 class="font-sans font-bold text-green-600">4: Transport of outgoing data via MQTT</h3>
                        <p class="font-sans">
                            A Message Queuing Telemetry Transport (MQTT) service connects the ESP32 to the cloud and the hosting server.<br>
                            During pressure sessions, with the target server as the subscriber of the MQTT topic, and the ESP32 as the transmitter, the ESP32 sends data to the broker;
                            and the broker sends data to the server.
                        </p>
                    </div>
                    <div>
                        <h3 class="font-sans font-bold text-green-600">5: Transport of incoming data to InfluxDB</h3>
                        <p class="font-sans">The incoming data is written to InfluxDB to show the patient's foot pressure values.</p>
                    </div>
                    <div>
                        <h3 class="font-sans font-bold text-green-600">6: Display of data on heatmap and table</h3>
                        <p class="font-sans">
                            Using the data in InfluxDB, the foot pressure values are displayed on a heatmap for short-term reading,
                            and a table on another page for long-term reading.
                        </p>
                    </div>
                </div>
            </div>
            <div class="container mx-auto p-4">
                <h3 class="font-sans font-bold text-center text-green-600">Behind the frontend, API, backend, and everything else</h3>
                <h2 class="font-sans font-bold text-2xl text-center text-green-600">Hardware, software, and frameworks used</h2>
                <div class="grid sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8 py-4">
                    <div>
                        <img class="h-20 py-2" src="{{ asset('pictures/Laravel.svg') }}">
                        <h3 class="font-sans font-bold text-green-600">Laravel</h3>
                        <p class="font-sans">A versatile PHP framework that elevates most PHP based projects - more specifically, we are using Laravel Breeze.</p>
                        <div class="flex space-x-2">
                            <div>
                                <a href="https://laravel.com/">
                                    <x-standard-button>
                                        {{ __('➜ Laravel') }}
                                    </x-standard-button>
                                </a>
                            </div>
                            <div>
                                <a href="https://laravel.com/docs/11.x/starter-kits">
                                    <x-standard-button-dark>
                                        {{ __('Starter kits (includes Breeze)') }}
                                    </x-standard-button-dark>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <img class="h-20 py-2" src="{{ asset('pictures/Tailwind_CSS_Logo.svg') }}">
                        <h3 class="font-sans font-bold text-green-600">Tailwind CSS</h3>
                        <p class="font-sans">A CSS framework that enables creating smooth, intuitive frontends without the need to define classes.</p>
                        <div class="flex space-x-2">
                            <div>
                                <a href="https://tailwindcss.com/">
                                    <x-standard-button>
                                        {{ __('➜ Tailwind CSS') }}
                                    </x-standard-button>
                                </a>
                            </div>
                            <div>
                                <a href="https://tailwindcss.com/docs/installation">
                                    <x-standard-button-dark>
                                        {{ __('Docs') }}
                                    </x-standard-button-dark>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <img class="h-20 py-2" src="{{ asset('pictures/Mysql_logo.png') }}">
                        <a class="font-sans font-bold text-green-600" href="https://www.mysql.com/">MySQL</a>
                        <p class="font-sans">MySQL is a database software that is used for storing patient and staff data.</p>
                    </div>
                    <div>
                        <img class="h-20 py-2" src="{{ asset('pictures/PhpMyAdmin_logo.svg') }}">
                        <a class="font-sans font-bold text-green-600" href="https://www.phpmyadmin.net/">phpMyAdmin</a>
                        <p class="font-sans">phpMyAdmin is used to examine MySQL databases.</p>
                    </div>
                    <div>
                        <img class="h-20 py-2" src="{{ asset('pictures/influxdb-logo-no-text.png') }}">
                        <a class="font-sans font-bold text-green-600" href="https://www.influxdata.com/">InfluxDB</a>
                        <p class="font-sans">
                            A specialised time-series database software that is used for storing time-bound foot pressure data.
                            Requires a complex suite of code to be effective.
                        </p>
                    </div>
                    <div>
                        <img class="h-20 py-2" src="{{ asset('pictures/Plotly-logo.png') }}">
                        <a class="font-sans font-bold text-green-600" href="https://plotly.com/">Plotly</a>
                        <p class="font-sans">Plotly.js is used for graphs and the foot pressure heatmap.</p>
                    </div>
                    <div>
                        <img class="h-20 py-2" src="{{ asset('pictures/nodemcu-esp32.jpg') }}">
                        <a class="font-sans font-bold text-green-600">ESP32</a>
                        <p class="font-sans">
                            A pair of these integrated circuits are connected to 9 FSRs or velostats - the pressure sensors - to measure the pressure
                            readings of each foot.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
