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
        <div class="flex-container">
            <h1 class="font-sans font-bold text-4xl text-center text-green-500 py-2">About the solution</h1>
        </div>
    </header>

    <main>
        <div class="grid lg:grid-cols-2 gap-16 sm:px-8 md:px-16 lg:px-24 xl:px-36 py-4">
            <div class="container bg-green-200 max-w-screen-md mx-auto p-4 rounded-md transition ease-in-out hover:shadow duration-800">
                <h2 class="font-sans font-bold text-2xl text-center text-green-600 py-2">The entire process</h2>
                <div class="flex flex-col space-y-4">
                    <div>
                        <h3 class="font-sans font-medium text-xl text-green-600">Patient registration</h3>
                        <p class="font-sans">A patient first has to register. Their details are stored in a MySQL database accessible via phpMyAdmin.</p>
                    </div>
                    <div>
                        <h3 class="font-sans font-medium text-xl text-green-600">Pressure sessions</h3>
                        <p class="font-sans">
                            Pressure sessions help to determine which pressure data is attributed to a specific patient and session.<br>
                            Data can only be monitored during pressure sessions.
                        </p>
                    </div>
                    <div>
                        <h3 class="font-sans font-medium text-xl text-green-600">Sourcing of data from ESP32 and the pressure sensors</h3>
                        <p class="font-sans">
                            Just before a pressure session, the patient first steps on the foot pressure mat that contains many pressure sensors connected to a central ESP32 Arduino integrated circuit.<br>
                            Once that is done, the assigned staff member will start the pressure session for that specific patient in the database.<br>
                            During this time, the weight of the patient's feet causes the pressure sensors to change in resistance and hence the voltage through them.
                        </p>
                    </div>
                    <div>
                        <h3 class="font-sans font-medium text-xl text-green-600">Transport of outgoing data via Message Queuing Telemetry Transport (MQTT)</h3>
                        <p class="font-sans">
                            A Message Queuing Telemetry Transport (MQTT) service connects the ESP32 to the cloud and the hosting server.<br>
                            During pressure sessions, with the target server as the subscriber of the MQTT topic, and the ESP32 as the transmitter, the ESP32 sends data to the broker;
                            and the broker sends data to the server.
                        </p>
                    </div>
                    <div>
                        <h3 class="font-sans font-medium text-xl text-green-600">Transport of incoming data to InfluxDB</h3>
                        <p class="font-sans">The incoming data is written to InfluxDB to show the patient's foot pressure values.</p>
                    </div>
                    <div>
                        <h3 class="font-sans font-medium text-xl text-green-600">Display of data on heatmap and table</h3>
                        <p class="font-sans">
                            Using the data in InfluxDB, the foot pressure values are displayed on a heatmap for short-term reading,
                            and a table on another page for long-term reading.
                        </p>
                    </div>
                </div>
            </div>
            <div class="container bg-green-200 max-w-screen-md mx-auto p-4 rounded-md transition ease-in-out hover:shadow duration-800">
                <h2 class="font-sans font-bold text-2xl text-center text-green-600 py-2">Software and frameworks used</h2>
                <div class="grid xl:grid-cols-2 gap-4">
                    <div>
                        <img class="h-16 w-auto mx-auto" src="{{ asset('pictures/Laravel.svg') }}">
                        <h3 class="font-sans font-medium text-xl text-green-600">Laravel</h3>
                        <p class="font-sans">A versatile PHP framework that elevates most PHP based projects - more specifically we are using Laravel Breeze.</p>
                        <div class="flex space-x-2">
                            <div>
                                <a href="https://laravel.com/">
                                    <div class="flex-container bg-green-300 my-1 px-2 py-1 rounded-md transition ease-in-out hover:shadow duration-800">
                                        <p class="font-sans">Laravel</p>
                                    </div>
                                </a>
                            </div>
                            <div>
                                <a href="https://laravel.com/docs/11.x/starter-kits">
                                    <div class="flex-container bg-green-300 my-1 px-2 py-1 rounded-md transition ease-in-out hover:shadow duration-800">
                                        <p class="font-sans">Starter kits (includes Breeze)</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <img class="h-16 w-auto mx-auto" src="{{ asset('pictures/Tailwind_CSS_Logo.svg') }}">
                        <h3 class="font-sans font-medium text-xl text-green-600">Tailwind CSS</h3>
                        <p class="font-sans">A CSS framework that enables creating smooth, intuitive frontends without the need to define classes.</p>
                        <div class="flex space-x-2">
                            <div>
                                <a href="https://tailwindcss.com/">
                                    <div class="flex-container bg-green-300 my-1 px-2 py-1 rounded-md transition ease-in-out hover:shadow duration-800">
                                        <p class="font-sans">Tailwind CSS</p>
                                    </div>
                                </a>
                            </div>
                            <div>
                                <a href="https://tailwindcss.com/docs/installation">
                                    <div class="flex-container bg-green-300 my-1 px-2 py-1 rounded-md transition ease-in-out hover:shadow duration-800">
                                        <p class="font-sans">Docs</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <img class="h-16 w-auto mx-auto" src="{{ asset('pictures/Mysql_logo.png') }}">
                        <a class="font-sans font-medium text-xl text-green-600" href="https://www.mysql.com/">MySQL</a>
                        <p class="font-sans">MySQL is a database software that is used for storing patient and staff data.</p>
                    </div>
                    <div>
                        <img class="h-16 w-auto mx-auto" src="{{ asset('pictures/PhpMyAdmin_logo.svg') }}">
                        <a class="font-sans font-medium text-xl text-green-600" href="https://www.phpmyadmin.net/">phpMyAdmin</a>
                        <p class="font-sans">phpMyAdmin is used to examine MySQL databases.</p>
                    </div>
                    <div>
                        <img class="h-16 w-auto mx-auto" src="{{ asset('pictures/influxdb-logo-no-text.png') }}">
                        <a class="font-sans font-medium text-xl text-green-600" href="https://www.influxdata.com/">InfluxDB</a>
                        <p class="font-sans">
                            A specialised time-series database software that is used for storing time-bound foot pressure data.
                            Requires a complex suite of code to be effective.
                        </p>
                    </div>
                    <div>
                        <img class="h-16 w-auto mx-auto" src="{{ asset('pictures/Plotly-logo.png') }}">
                        <a class="font-sans font-medium text-xl text-green-600" href="https://plotly.com/">Plotly</a>
                        <p class="font-sans">Plotly.js is used for graphs.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
