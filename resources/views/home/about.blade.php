<x-app-layout>
    <header>
        <div class="max-w-5xl mx-auto py-4">
            <h1 class="font-bold text-5xl text-center text-green-500">About the solution</h1>
            <div class="m-4 p-4 bg-white rounded-md">
                <h3 class="font-medium text-lg text-gray-900">It's under construction!</h3>
                <p class="text-gray-600">
                    ERD and more details will be added at a later date.
                </p>
            </div>
        </div>
    </header>

    <main>
        <div class="flex flex-col space-y-4">
            <div class="container mx-auto p-4">
                <h3 class="font-bold text-center text-green-600">How does it work?</h3>
                <h2 class="font-bold text-2xl text-center text-green-600">The entire process</h2>
                <div class="grid sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8 py-4">
                    <div class="bg-white rounded-md p-4 hover:shadow transition ease-in-out duration-150">
                        <h3 class="font-medium text-gray-900">1: Patient registration</h3>
                        <p class="text-gray-600">A patient first has to register. Their details are stored in the users table of the MySQL database, accessible via phpMyAdmin.</p>
                    </div>
                    <div class="bg-white rounded-md p-4 hover:shadow transition ease-in-out duration-150">
                        <h3 class="font-medium text-gray-900">2: Pressure sessions</h3>
                        <p class="text-gray-600">
                            Pressure sessions help to determine which pressure data is attributed to a specific patient and session.<br>
                            Each pressure session is stored in the pressure_sessions table.<br>
                            1 patient can have many pressure sessions in total (users to pressure_sessions: 0..*), while each pressure session is only attributed to 1 patient (pressure_sessions to users: 1..1).<br>
                            Data can only be monitored during pressure sessions.
                        </p>
                    </div>
                    <div class="bg-white rounded-md p-4 hover:shadow transition ease-in-out duration-150">
                        <h3 class="font-medium text-gray-900">3: Sourcing of data from ESP32 and the pressure sensors</h3>
                        <p class="text-gray-600">
                            Just before a pressure session, the patient first steps on the foot pressure mat that contains many pressure sensors connected to a central ESP32 Arduino integrated circuit.<br>
                            Once that is done, the assigned staff member will start the pressure session for that specific patient in the database.<br>
                            During this time, the weight of the patient's feet causes the pressure sensors to change in resistance and hence the voltage through them.
                        </p>
                    </div>
                    <div class="bg-white rounded-md p-4 hover:shadow transition ease-in-out duration-150">
                        <h3 class="font-medium text-gray-900">4: Transport of outgoing data via MQTT</h3>
                        <p class="text-gray-600">
                            A Message Queuing Telemetry Transport (MQTT) service connects the ESP32 to the cloud and the hosting server.<br>
                            During pressure sessions, with the target server as the subscriber of the MQTT topic, and the ESP32 as the transmitter, the ESP32 sends data to the broker;
                            and the broker sends data to the server.
                        </p>
                    </div>
                    <div class="bg-white rounded-md p-4 hover:shadow transition ease-in-out duration-150">
                        <h3 class="font-medium text-gray-900">5: Transport of incoming data to InfluxDB</h3>
                        <p class="text-gray-600">The incoming data is written to InfluxDB to show the patient's foot pressure values.</p>
                    </div>
                    <div class="bg-white rounded-md p-4 hover:shadow transition ease-in-out duration-150">
                        <h3 class="font-medium text-gray-900">6: Display of data on heatmap and table</h3>
                        <p class="text-gray-600">
                            Using the data in InfluxDB, the foot pressure values are displayed on a heatmap for short-term reading,
                            and a table on another page for long-term reading.
                        </p>
                    </div>
                </div>
            </div>
            <div class="container mx-auto p-4">
                <h3 class="font-bold text-center text-green-600">Behind the frontend, API, backend, and everything else</h3>
                <h2 class="font-bold text-2xl text-center text-green-600">Hardware, software, and frameworks used</h2>
                <div class="grid sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8 py-4">
                    <div class="bg-white rounded-md p-4 hover:shadow transition ease-in-out duration-150">
                        <img class="h-20 py-2" src="{{ asset('pictures/Laravel.svg') }}">
                        <p class="font-medium text-gray-900">Laravel</p>
                        <p class="text-gray-600">A versatile PHP framework that elevates most PHP based projects - more specifically, we are using Laravel Breeze.</p>
                        <div class="flex justify-end">
                            <a href="https://laravel.com/">
                                <button class="inline-flex items-center text-gray-600 border px-2 py-1 bg-white rounded-l-md hover:bg-gray-100 transition ease-in-out duration-150">
                                    {{ __('Laravel') }}
                                </button>
                            </a>
                            <a href="https://laravel.com/docs/11.x">
                                <button class="inline-flex items-center text-gray-600 border px-2 py-1 bg-white rounded-r-md hover:bg-gray-100 transition ease-in-out duration-150">
                                    {{ __('Docs') }}
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="bg-white rounded-md p-4 hover:shadow transition ease-in-out duration-150">
                        <img class="h-20 py-2" src="{{ asset('pictures/Tailwind_CSS_Logo.svg') }}">
                        <h3 class="font-medium text-gray-900">Tailwind CSS</h3>
                        <p class="text-gray-600">A CSS framework that enables creating smooth, intuitive frontends without the need to define classes.</p>
                        <div class="flex justify-end">
                            <a href="https://tailwindcss.com/">
                                <button class="inline-flex items-center text-gray-600 border px-2 py-1 bg-white rounded-l-md hover:bg-gray-100 transition ease-in-out duration-150">
                                    {{ __('Tailwind CSS') }}
                                </button>
                            </a>
                            <a href="https://tailwindcss.com/docs/installation">
                                <button class="inline-flex items-center text-gray-600 border px-2 py-1 bg-white rounded-r-md hover:bg-gray-100 transition ease-in-out duration-150">
                                    {{ __('Docs') }}
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="bg-white rounded-md p-4 hover:shadow transition ease-in-out duration-150">
                        <img class="h-20 py-2" src="{{ asset('pictures/resend-wordmark-black.svg') }}">
                        <h3 class="font-medium text-gray-900">Resend</h3>
                        <p class="text-gray-600">
                            An email delivery service that allows the application to send emails for users' email verification.
                            I chose Resend over Postmark and any other email delivery service, because Resend's ability to accommodate GitHub or
                            Google authentication makes it accessible to freelance developers; which is something that Postmark cannot do.
                        </p>
                        <div class="flex justify-end">
                            <a href="https://resend.com/home">
                                <button class="inline-flex items-center text-gray-600 border px-2 py-1 bg-white rounded-l-md hover:bg-gray-100 transition ease-in-out duration-150">
                                    {{ __('Resend') }}
                                </button>
                            </a>
                            <a href="https://resend.com/docs/introduction">
                                <button class="inline-flex items-center text-gray-600 border px-2 py-1 bg-white rounded-r-md hover:bg-gray-100 transition ease-in-out duration-150">
                                    {{ __('Docs') }}
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="bg-white rounded-md p-4 hover:shadow transition ease-in-out duration-150">
                        <img class="h-20 py-2" src="{{ asset('pictures/Mysql_logo.png') }}">
                        <a class="font-medium text-gray-900" href="https://www.mysql.com/">MySQL</a>
                        <p class="text-gray-600">MySQL is a database software that is used for storing patient and staff data.</p>
                    </div>
                    <div class="bg-white rounded-md p-4 hover:shadow transition ease-in-out duration-150">
                        <img class="h-20 py-2" src="{{ asset('pictures/PhpMyAdmin_logo.svg') }}">
                        <a class="font-medium text-gray-900" href="https://www.phpmyadmin.net/">phpMyAdmin</a>
                        <p class="text-gray-600">phpMyAdmin is used to examine MySQL databases.</p>
                    </div>
                    <div class="bg-white rounded-md p-4 hover:shadow transition ease-in-out duration-150">
                        <img class="h-20 py-2" src="{{ asset('pictures/influxdb-logo-no-text.png') }}">
                        <a class="font-medium text-gray-900" href="https://www.influxdata.com/">InfluxDB</a>
                        <p class="text-gray-600">
                            A specialised time-series database software that is used for storing time-bound foot pressure data.
                            Requires a complex suite of code to be effective.
                        </p>
                    </div>
                    <div class="bg-white rounded-md p-4 hover:shadow transition ease-in-out duration-150">
                        <img class="h-20 py-2" src="{{ asset('pictures/Plotly-logo.png') }}">
                        <a class="font-medium text-gray-900" href="https://plotly.com/">Plotly</a>
                        <p class="text-gray-600">Plotly.js is used for graphs and the foot pressure heatmap.</p>
                    </div>
                    <div class="bg-white rounded-md p-4 hover:shadow transition ease-in-out duration-150">
                        <img class="h-20 py-2" src="{{ asset('pictures/nodemcu-esp32.jpg') }}">
                        <h3 class="font-medium text-gray-90">ESP32</h3>
                        <p class="text-gray-600">
                            A pair of these integrated circuits are connected to 9 FSRs or velostats - the pressure sensors - to measure the pressure
                            readings of each foot.
                        </p>
                    </div>
                </div>
            </div>
            <div class="container mx-auto p-4">
                <h3 class="font-bold text-center text-green-600">Our database layout</h3>
                <h2 class="font-bold text-2xl text-center text-green-600">Entity relationship diagram</h2>
                <div class="mx-auto p-4">
                    <img class="mx-auto" src="{{ asset('pictures/black-hole.webp') }}">
                </div>
                <p class="font-sans">Replace this picture once the ERD is ready</p>
            </div>
        </div>
    </main>
</x-app-layout>