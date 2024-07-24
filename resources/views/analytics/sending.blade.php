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
          <input type="text" id="topic" value="sensor_data" readonly />
        </li>
        <li class="form-row">
          <button type="button" class="start-publishing">Start Publishing</button>
          <button type="button" class="stop-publishing">Stop Publishing</button>
        </li>
      </ul>
      <script>
          let mqttClient;
          let publishInterval;
  
          window.addEventListener("load", (event) => {
              connectToBroker();
  
              const startBtn = document.querySelector(".start-publishing");
              startBtn.addEventListener("click", function () {
                  startPublishing();
              });
  
              const stopBtn = document.querySelector(".stop-publishing");
              stopBtn.addEventListener("click", function () {
                  stopPublishing();
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
  
          function startPublishing() {
              const topic = document.querySelector("#topic").value.trim();
              let quadrants = [];
              
              // Define quadrants
              for (let i = 0; i < 8; i++) {
                  for (let j = 0; j < 8; j++) {
                      quadrants.push({row: i, col: j});
                  }
              }
  
              publishInterval = setInterval(() => {
                  const timestamp = new Date().toISOString(); // ISO 8601 datetime string
                  quadrants.forEach(quadrant => {
                      const {row, col} = quadrant;
                      const quadrantID = `${row}${col}`;
                      const value = Math.floor(Math.random() * 101); // Random value between 0 and 100
                      const messagePayload = JSON.stringify({
                          timestamp: timestamp,
                          quadrantID: quadrantID,
                          value: value.toString()
                      });
  
                      console.log(`Sending Topic: ${topic}, Message: ${messagePayload}`);
                      mqttClient.publish(topic, messagePayload, {
                          qos: 0,
                          retain: false,
                      });
                  });
              }, 1000); // Publish every second
          }
  
          function stopPublishing() {
              clearInterval(publishInterval);
          }
      </script>
    </body>
  </x-app-layout>
