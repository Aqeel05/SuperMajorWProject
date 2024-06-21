
<x-app-layout>
    <head>
        <title>MQTT Real-time Graph</title>
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.js"></script>
        <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
    </head>
    <body>
        <button id="subscribeBtn">Subscribe</button>
        <button id="unsubscribeBtn">Unsubscribe</button>
        <div id="chart"></div>

        <script>
            var subscribeBtn = document.getElementById('subscribeBtn');
            var unsubscribeBtn = document.getElementById('unsubscribeBtn');

            var data = [{
                y: [],
                type: 'line',
                name: 'Sensor Data'
            }];

            Plotly.newPlot('chart', data);

            subscribeBtn.addEventListener('click', function() {
                axios.get('/subscribe')
                    .then(function(response) {
                        console.log(response.data.message);
                    })
                    .catch(function(error) {
                        console.error(error);
                    });
            });

            unsubscribeBtn.addEventListener('click', function() {
                axios.get('/unsubscribe')
                    .then(function(response) {
                        console.log(response.data.message);
                    })
                    .catch(function(error) {
                        console.error(error);
                    });
            });

            // Laravel Echo for real-time updates
            var echo = new Echo({
                broadcaster: 'socket.io',
                host: window.location.hostname + ':6001'
            });

            echo.channel('mqtt-messages')
                .listen('.mqtt.message.received', function(e) {
                    var newData = [e.data.sensorValue];
                    Plotly.extendTraces('chart', { y: [newData] }, [0]);
                });
        </script>
    </body>
</x-app-layout>
