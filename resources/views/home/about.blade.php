<x-app-layout>
    <style>
        body {
            color: #000000;
            font-family: "Segoe UI Emoji", "Segoe UI Symbol";
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
            color: #04AA6D;
            transition: color 0.3s;
            font-size: 1.5em;
        }

        a:hover {
            color: #66BB6A;
        }


        .content {
            margin: 0px auto;
            width: 90%;
            max-width: 1200px;
            padding: 20px;
        }

        .highlight {
            color: #04AA6D;
            font-weight: bold;
        }

        .title {
            text-align: center;
            margin-top: 40px;
            font-size: 2.5em;
            color: #66BB6A;
        }

        #main-content {
            margin-top: 60px;
        }

        .dropdown, .dropdown-right {
            display: none;
        }

        img {
            width: 20%;
            margin: 20px 40px 20px 0;
            float: left;
        }
    </style>

    <header>
        <h1 class="title">About FWDIS</h1>
    </header>

    <main id="main-content">
        <div class="content">
            <h2 class="title">How does it work?</h2>
            <h3 class="highlight">Patient registration</h3>
            <p>A patient first has to register. Their details are stored in a MySQL database accessible via phpMyAdmin.</p>
            <br>
            <h3 class="highlight">Sourcing of data from ESP32 and the pressure sensors</h3>
            <ol>
                <li>Not final: The machine may be set to capture data for a specific patient in the database.</li>
                <li>The patient first steps on the foot pressure plate that contains many pressure sensors connected to a central ESP32 Arduino integrated circuit.</li>
                <li>The weight of the patient's feet causes the pressure sensors to cause a change in its resistance and hence the voltage through it. (May not be: Change accordingly)</li>
            </ol>
            <br>
            <h3 class="highlight">Transport of outgoing data via Message Queuing Telemetry Transport (MQTT)</h3>
            <ol>
                <li>A Message Queuing Telemetry Transport (MQTT) service connects the ESP32 to the cloud and the hosting server.</li>
                <li>With the target server as the subscriber of the MQTT topic, and the ESP32 as the transmitter, the ESP32 sends data to the broker; and the broker sends data to the server.</li>
            </ol>
            <br>
            <h3 class="highlight">Transport of incoming data to InfluxDB</h3>
            <p>The incoming data is written to InfluxDB to show the patient's foot pressure values.</p>
            <br>
            <h3 class="highlight">Display of data on heatmap and table</h3>
            <p>Using the data in InfluxDB, the foot pressure values are displayed on a heatmap and table.</p>
        </div>

        <div class="content">
            <h2 class="title">Technologies used</h2>
            <div>
                <img src="{{ asset('pictures/Mysql_logo.png') }}">
                <a href="https://www.mysql.com/">MySQL</a>
                <p>MySQL is a database software that is used for storing patient and staff data.</p>
                
            </div>
            <div>
                <img src="{{ asset('pictures/PhpMyAdmin_logo.svg') }}">
                <a href="https://www.phpmyadmin.net/">phpMyAdmin</a>
                <p>phpMyAdmin is used to examine MySQL databases.</p>
                
            </div>
            <div>
                <img src="{{ asset('pictures/influxdb-logo-no-text.png') }}">
                <a href="https://www.influxdata.com/">InfluxDB</a>
                <p>A specialised time-series database software that is used for storing time-bound foot pressure data.</p>
                
            </div>
            <div>
                <img src="{{ asset('pictures/Plotly-logo.png') }}">
                <a href="https://plotly.com/">Plotly</a>
                <p>Plotly.js is used for graphs.</p>
                
            </div>
        </div>
    </main>
</x-app-layout>
