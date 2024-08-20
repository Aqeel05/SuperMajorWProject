<x-app-layout>
    <header>
        <!-- Header section -->
        <div class="bg-green-100 dark:bg-green-900 p-4">
            <h1 class="font-semibold text-5xl text-center text-green-500 py-2">About the solution</h1>
        </div>
    </header>

    <main>
        <div x-data="{open1: false, open2: false}" class="flex flex-col space-y-4">
            <div class="container mx-auto p-4">
                <h3 class="font-semibold text-center text-green-500">How does it work?</h3>
                <h2 class="font-semibold text-2xl text-center text-green-500">The entire process</h2>
                <button x-on:click="open1 = !open1" class="border">
                    <p x-show="!open1" class="text-gray-600 dark:text-white"> More Info </p>
                    <p x-show="open1" class="text-gray-600 dark:text-white">Less Info ↑</p>
                </button>
                <div class="grid sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8 py-4">
                    <div class="bg-white dark:bg-gray-900 rounded-md p-4">
                        <p class="font-medium text-gray-900 dark:text-gray-400">1: Patient registration</p>
                        <p x-show="open1" class="text-gray-600 dark:text-white" style="display: none;">
                            A patient first has to register. Their details are stored in the users table of the MySQL database, accessible via a database viewer tool.<br>
                            To access pages other than the index and about pages, their email needs to be verified. Upon request, the email service provider
                            will send an email to the intended email address that allows them to verify their email.
                        </p>
                    </div>
                    <div class="bg-white dark:bg-gray-900 rounded-md p-4">
                        <p class="font-medium text-gray-900 dark:text-gray-400">2: Patient bookings</p>
                        <p x-show="open1" class="text-gray-600 dark:text-white" style="display: none;">
                            Patients are required to make bookings for foot pressure sessions, preferably at least 2 weeks in advance.
                        </p>
                    </div>
                    <div class="bg-white dark:bg-gray-900 rounded-md p-4">
                        <p class="font-medium text-gray-900 dark:text-gray-400">3: Pressure sessions</p>
                        <p x-show="open1" class="text-gray-600 dark:text-white" style="display: none;">
                            Pressure sessions help to determine which pressure data is attributed to a specific patient and session.<br>
                            Each pressure session is stored in the pressure_sessions table.<br>
                            1 patient can have many pressure sessions in total (users to pressure_sessions: 0..*), while each pressure session is only attributed to 1 patient (pressure_sessions to users: 1..1).<br>
                            Data can only be monitored during pressure sessions.
                        </p>
                    </div>
                    <div class="bg-white dark:bg-gray-900 rounded-md p-4">
                        <p class="font-medium text-gray-900 dark:text-gray-400">4: Sourcing of data from ESP32 and the pressure sensor</p>
                        <p x-show="open1" class="text-gray-600 dark:text-white" style="display: none;">
                            Just before a pressure session, the patient first steps on the foot pressure mat that contains a velostat connected to a central ESP32 Arduino integrated circuit.<br>
                            Once that is done, the pressure session will start for that specific patient in the database.<br>
                            During this time, the weight of the patient's feet causes the various points in the velostat to change in resistance, and hence the voltage through them.
                        </p>
                    </div>
                    <div class="bg-white dark:bg-gray-900 rounded-md p-4">
                        <p class="font-medium text-gray-900 dark:text-gray-400">5: Transport of outgoing data via MQTT</p>
                        <p x-show="open1" class="text-gray-600 dark:text-white" style="display: none;">
                            A Message Queuing Telemetry Transport (MQTT) service connects the ESP32 to the cloud and the hosting server.<br>
                            During pressure sessions, with the web application as the subscriber of the MQTT topic, and the ESP32 as the transmitter, the ESP32 sends data to the broker;
                            and the broker sends data to the server.
                        </p>
                    </div>
                    <div class="bg-white dark:bg-gray-900 rounded-md p-4">
                        <p class="font-medium text-gray-900 dark:text-gray-400">6: Transport of incoming data to InfluxDB</p>
                        <p x-show="open1" class="text-gray-600 dark:text-white" style="display: none;">The incoming data is written to InfluxDB to show the patient's foot pressure values.</p>
                    </div>
                    <div class="bg-white dark:bg-gray-900 rounded-md p-4">
                        <p class="font-medium text-gray-900 dark:text-gray-400">7: Display of data on heatmap and table</p>
                        <p x-show="open1" class="text-gray-600 dark:text-white" style="display: none;">
                            Using the data in InfluxDB, the foot pressure values are displayed on a heatmap for short-term reading,
                            and a table on another page for long-term reading.
                        </p>
                    </div>
                </div>
            </div>
            <div class="container mx-auto p-4">
                <h3 class="font-semibold text-center text-green-500">Powering the frontend, API, backend, and everything else</h3>
                <h2 class="font-semibold text-2xl text-center text-green-500">Hardware, software, and frameworks used</h2>
                <button x-on:click="open2 = !open2" class="border">
                    <p x-show="!open2" class="text-gray-600 dark:text-white"> More Info </p>
                    <p x-show="open2" class="text-gray-600 dark:text-white">Less Info ↑</p>
                </button>
                <div class="grid sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8 py-4">
                    <div class="bg-white dark:bg-gray-900 rounded-md p-4">
                        <div class="flex flex-col space-y-2 h-full">
                            <div class="flex-none">
                                <img class="h-20 py-2" src="{{ asset('pictures/Laravel.svg') }}">
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 dark:text-gray-400">Laravel</p>
                                <p x-show="open2" class="text-gray-600 dark:text-white" style="display: none;">
                                    A versatile PHP framework that provides a good starting point for many full-stack developers and PHP programmers. We chose this because:<br>
                                    - It is a scalable framework: The presence of PHP makes it suitable for beginners as well as experts;<br>
                                    - It features wide support for and integration capabilities with other software, which allows for easier implementation;<br>
                                    - It provides a structured set of project directories, with accessible routing, controller requests, and page editing;<br>
                                    - There are many first-party packages for use in Laravel that are applicable for a multitude of use-cases (such as Breeze, a quick authentication package).<br>
                                    In addition to Laravel as a whole, we are using Laravel Breeze combined with the JavaScript frameworks, vite.js and Alpine.js.
                                </p>
                            </div>
                            <div class="flex-none">
                                <div class="flex items-center justify-end">
                                    <a href="https://laravel.com/" target="_blank">
                                        <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-l-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                                            {{ __('Laravel') }}
                                        </button>
                                    </a>
                                    <a href="https://laravel.com/docs/11.x" target="_blank">
                                        <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-r-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                                            {{ __('Docs (11.x)') }}
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-900 rounded-md p-4">
                        <div class="flex flex-col space-y-2 h-full">
                            <div class="flex-none">
                                <img class="h-20 py-2" src="{{ asset('pictures/Tailwind_CSS_Logo.svg') }}">
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 dark:text-gray-400">Tailwind CSS</p>
                                <p x-show="open2" class="text-gray-600 dark:text-white" style="display: none;">
                                    A CSS framework that enables creating smooth, intuitive frontends with utility-first classes,
                                    leading to higher consistency and stability.<br>
                                    However, it is only an add-on to standard CSS and may not be universally applicable;
                                    meaning, it still requires a standard CSS file to exist
                                    and may require custom ids or classes to be made for where Tailwind CSS cannot solve.
                                </p>
                            </div>
                            <div class="flex-none">
                                <div class="flex items-center justify-end">
                                    <a href="https://tailwindcss.com/" target="_blank">
                                        <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-l-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                                            {{ __('Tailwind CSS') }}
                                        </button>
                                    </a>
                                    <a href="https://tailwindcss.com/docs/installation" target="_blank">
                                        <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-r-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                                            {{ __('Docs') }}
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-900 rounded-md p-4">
                        <div class="flex flex-col space-y-2 h-full">
                            <div class="flex-none">
                                <img class="h-20 py-2" src="{{ asset('pictures/resend-wordmark-black.svg') }}">
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 dark:text-gray-400">Resend</p>
                                <p x-show="open2" class="text-gray-600 dark:text-white" style="display: none;">
                                    An email delivery service that allows the application to send emails for users' email verification and password resetting.
                                    I chose Resend over Postmark and Mailgun, because:<br>
                                    - Resend's ability to accommodate GitHub or Google authentication without the need for a work email
                                    makes it accessible to freelance developers, which is something that Postmark cannot do;<br>
                                    - It can be used for free;<br>
                                    - Allows 100 emails to be sent per day on the free plan alone. Other providers have lower limits.
                                </p>
                            </div>
                            <div class="flex-none">
                                <div class="flex items-center justify-end">
                                    <a href="https://resend.com/home" target="_blank">
                                        <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-l-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                                            {{ __('Resend') }}
                                        </button>
                                    </a>
                                    <a href="https://resend.com/docs/introduction" target="_blank">
                                        <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-r-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                                            {{ __('Docs') }}
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-900 rounded-md p-4">
                        <div class="flex flex-col space-y-2 h-full">
                            <div class="flex-none">
                                <img class="h-20 py-2" src="{{ asset('pictures/influxdb-logo-no-text.png') }}">
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 dark:text-gray-400">InfluxDB</p>
                                <p x-show="open2" class="text-gray-600 dark:text-white" style="display: none;">
                                    A specialised time-series database software that is used for storing time-bound foot pressure data.
                                    Requires a complex suite of code to be effective.
                                </p>
                            </div>
                            <div class="flex-none">
                                <div class="flex items-center justify-end">
                                    <a href="https://www.influxdata.com/" target="_blank">
                                        <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                                            {{ __('Influx') }}
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-900 rounded-md p-4">
                        <div class="flex flex-col space-y-2 h-full">
                            <div class="flex-none">
                                <img class="h-20 py-2" src="{{ asset('pictures/Mqtt-hor.svg') }}">
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 dark:text-gray-400">Message Queuing Telemetry Transport (MQTT)</p>
                                <p x-show="open2" class="text-gray-600 dark:text-white" style="display: none;">
                                    A lightweight publish-subscribe messaging transport that is ideal for small IoT systems and is responsible for connecting
                                    the ESP32 with the Influx database.
                                </p>
                            </div>
                            <div class="flex-none">
                                <div class="flex items-center justify-end">
                                    <a href="https://mqtt.org/" target="_blank">
                                        <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                                            {{ __('MQTT') }}
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-900 rounded-md p-4">
                        <div class="flex flex-col space-y-2 h-full">
                            <div class="flex-none">
                                <img class="h-20 py-2" src="{{ asset('pictures/Mysql_logo.png') }}">
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 dark:text-gray-400">MySQL</p>
                                <p x-show="open2" class="text-gray-600 dark:text-white" style="display: none;">
                                    MySQL is a database software that is used for storing account (patient/staff)
                                    and user session data (that tracks when and where the website is accessed).<br>
                                    - A lot of database accessing software (such as DBeaver) and cloud computing services (such as AWS and Laravel Vapor)
                                    support MySQL, making it highly accessible;<br>
                                    - Does not require a cumbersome setup process unlike Microsoft SQL Server or PostgreSQL,
                                    saving some valuable time;<br>
                                    - MySQL is a popular database software that is light and stable, making it good for projects that are not expected to
                                    have a large database;<br>
                                    - Naturally supports PHP.
                                </p>
                            </div>
                            <div class="flex-none">
                                <div class="flex items-center justify-end">
                                    <a href="https://www.mysql.com/" target="_blank">
                                        <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                                            {{ __('MySQL') }}
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-900 rounded-md p-4">
                        <div class="flex flex-col space-y-2 h-full">
                            <div class="flex-none">
                                <img class="h-20 py-2" src="{{ asset('pictures/PhpMyAdmin_logo.svg') }}">
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 dark:text-gray-400">phpMyAdmin</p>
                                <p x-show="open2" class="text-gray-600 dark:text-white" style="display: none;">phpMyAdmin is the first database viewer tool used to examine MySQL databases. It is planned to be replaced by AWS Relational Database Services.</p>
                            </div>
                            <div class="flex-none">
                                <div class="flex items-center justify-end">
                                    <a href="https://www.phpmyadmin.net/" target="_blank">
                                        <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                                            {{ __('phpMyAdmin') }}
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-900 rounded-md p-4">
                        <div class="flex flex-col space-y-2 h-full">
                            <div class="flex-none">
                                <img class="h-20 py-2" src="{{ asset('pictures/Alpine.js.svg') }}">
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 dark:text-gray-400">Alpine.js</p>
                                <p x-show="open2" class="text-gray-600 dark:text-white" style="display: none;">
                                    A JavaScript framework that allows the creation of reactive, animated components.
                                </p>
                            </div>
                            <div class="flex-none">
                                <div class="flex items-center justify-end">
                                    <a href="https://alpinejs.dev/" target="_blank">
                                        <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-l-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                                            {{ __('Alpine.js') }}
                                        </button>
                                    </a>
                                    <a href="https://alpinejs.dev/start-here" target="_blank">
                                        <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-r-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                                            {{ __('Docs') }}
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-900 rounded-md p-4">
                        <div class="flex flex-col space-y-2 h-full">
                            <div class="flex-none">
                                <img class="h-20 py-2" src="{{ asset('pictures/Voiceflow-wordmark-dark.svg') }}">
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 dark:text-gray-400">Voiceflow</p>
                                <p x-show="open2" class="text-gray-600 dark:text-white" style="display: none;">
                                    This software powers our chatbot that is accessible through all pages as long as the user is authenticated.<br>
                                    - The chatbots that can be made with Voiceflow can be used for many purposes, including general customer support
                                    or as an all-purpose chatbot;<br>
                                    - Straightforward HTML implementation, with a choice for the chatbot to be implemented in all pages;<br>
                                    - Offers a low-code, beginner-friendly interface for creating effective chatbots, and supports various ChatGPT,
                                    Claude, and Gemini versions;<br>
                                    - Offers up to 100,000 AI credits per month on the free plan alone, which is far higher than other chatbot software
                                    (which offer only 20 - 100 credits on the free plan, or do not have a free plan at all),
                                    making it much more accessible to beginning or low-spending developers.
                                </p>
                            </div>
                            <div class="flex-none">
                                <div class="flex items-center justify-end">
                                    <a href="https://www.voiceflow.com/" target="_blank">
                                        <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                                            {{ __('Voiceflow') }}
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-900 rounded-md p-4">
                        <div class="flex flex-col space-y-2 h-full">
                            <div class="flex-none">
                                <img class="h-20 py-2" src="{{ asset('pictures/Plotly-logo.png') }}">
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 dark:text-gray-400">Plotly</p>
                                <p x-show="open2" class="text-gray-600 dark:text-white" style="display: none;">Plotly.js is used for graphs and the foot pressure heatmap.</p>
                            </div>
                            <div class="flex-none">
                                <div class="flex items-center justify-end">
                                    <a href="https://plotly.com/" target="_blank">
                                        <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                                            {{ __('Plotly') }}
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-900 rounded-md p-4">
                        <div class="flex flex-col space-y-2 h-full">
                            <div class="flex-none">
                                <img class="h-20 py-2" src="{{ asset('pictures/nodemcu-esp32.jpg') }}">
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 dark:text-gray-400">ESP32</p>
                                <p x-show="open2" class="text-gray-600 dark:text-white" style="display: none;">
                                    This IC chip is connected to a velostat to measure the pressure readings of each foot.
                                </p>
                            </div>
                            <div class="flex-none">
                                <div class="flex items-center justify-end">
                                    <a href="https://www.espressif.com/sites/default/files/documentation/esp32_datasheet_en.pdf" target="_blank">
                                        <button class="inline-flex items-center text-gray-600 dark:text-white border px-2 py-1 bg-white dark:bg-gray-900 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-700 transition ease-in-out duration-150">
                                            {{ __('Datasheet') }}
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-5xl mx-auto p-4">
                <h3 class="font-semibold text-center text-green-500">Our database layout</h3>
                <h2 class="font-semibold text-2xl text-center text-green-500">Entity relationship diagram</h2>
                <div class="m-4">
                    <img class="mx-auto" src="{{ asset('pictures/file_2024-08-07_03.42.06.png') }}" alt="FWDIS Entity Relationship Diagram">
                </div>
            </div>
            <div class="max-w-5xl mx-auto p-4">
                <h2 class="font-semibold text-2xl text-center text-green-500">System Architecture</h2>
                <div class="m-4">
                    <img class="dark:bg-white rounded-md mx-auto" src="{{ asset('pictures/MPsysarchdiagramFinal.drawio.png') }}" alt="FWDIS System Architecture Diagram">
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
