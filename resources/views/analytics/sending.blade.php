<x-app-layout>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>MQTT Over WebSockets Publisher</title>
    <style>
        *,
        *:before,
        *:after {
        box-sizing: border-box;
        }

        /****** Styling for the Layout ***********/
        .wrapper {
        background-color: rgb(247, 244, 244);
        list-style-type: none;
        padding: 0;
        border-radius: 5px;
        }
        .form-row {
        display: flex;
        justify-content: flex-end;
        padding: 0.5em;
        }
        .form-row > label {
        padding: 1em;
        flex: 1;
        font-size: 1.2em;
        font-weight: bold;
        }
        .form-row > input {
        flex: 2;
        }

        .form-row > input,
        .form-row > button {
        padding: 1em;
        margin: 10px 0;
        box-shadow: 0 0 15px 4px rgba(0, 0, 0, 0.06);
        border-radius: 10px;
        font-size: 1.2em;
        }
        .form-row > button {
        background-color: #3f51b5;
        color: white;
        border: 0;
        flex: 3;
        font-weight: 600;
        }
    </style>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
  </head>
  <body>
    <div class="line"></div>
    <ul class="wrapper">
      <li class="form-row">
        <label for="topic">Topic</label>
        <input type="text" id="topic" />
      </li>
      <li class="form-row">
        <label for="message">Message</label>
        <input type="text" id="message" />
      </li>
      <li class="form-row">
        <button type="button" class="publish">Publish</button>
      </li>
    </ul>
    <script>
        let mqttClient;

        window.addEventListener("load", (event) => {
        connectToBroker();

        const publishBtn = document.querySelector(".publish");
        publishBtn.addEventListener("click", function () {
            publishMessage();
        });
        });

        function connectToBroker() {
        const clientId = "client" + Math.random().toString(36).substring(7);

        // Change this to point to your MQTT broker
        const host = "ws://localhost:9001/mqtt";

        const options = {
            keepalive: 60,
            clientId: clientId,
            protocolId: "MQTT",
            protocolVersion: 4,
            clean: true,
            reconnectPeriod: 1000,
            connectTimeout: 30 * 1000,
        };

        mqttClient = mqtt.connect(host, options);

        mqttClient.on("error", (err) => {
            console.log("Error: ", err);
            mqttClient.end();
        });

        mqttClient.on("reconnect", () => {
            console.log("Reconnecting...");
        });

        mqttClient.on("connect", () => {
            console.log("Client connected:" + clientId);
        });

        // Received
        mqttClient.on("message", (topic, message, packet) => {
            console.log(
            "Received Message: " + message.toString() + "\nOn topic: " + topic
            );
        });
        }

        function publishMessage() {
        const messageInput = document.querySelector("#message");

        const topic = document.querySelector("#topic").value.trim();
        const message = messageInput.value.trim();

        console.log(`Sending Topic: ${topic}, Message: ${message}`);

        mqttClient.publish(topic, message, {
            qos: 0,
            retain: false,
        });
        messageInput.value = "";
        }
    </script>
  </body>
</x-app-layout>