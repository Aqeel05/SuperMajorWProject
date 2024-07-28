let mqttClient;
let dataBuffer = [];
let footMatrix = Array.from({ length: 8 }, () => Array(8).fill(0));
let leftFootCumulative = 0;
let rightFootCumulative = 0;
let leftFootTopCumulative = 0;
let leftFootBottomCumulative = 0;
let rightFootTopCumulative = 0;
let rightFootBottomCumulative = 0;
let leftFootLineChart = [];
let rightFootLineChart = [];
let leftFootTopLineChart = [];
let leftFootBottomLineChart = [];
let rightFootTopLineChart = [];
let rightFootBottomLineChart = [];

window.addEventListener("load", (event) => {
    connectToBroker();

    const subscribeBtn = document.querySelector("#subscribe");
    subscribeBtn.addEventListener("click", function () {
        subscribeToTopic();
        changeStatusBackground();
        if (document.querySelector("#save-session-checkbox").checked) {
            startSession();
        }
    });

    const unsubscribeBtn = document.querySelector("#unsubscribe");
    unsubscribeBtn.addEventListener("click", function () {
        unsubscribeToTopic();
        changeStatusBackground();
        if (document.querySelector("#save-session-checkbox").checked) {
            stopSession();
        }
    });

    const saveSessionBtn = document.querySelector("#save-session");
    saveSessionBtn.addEventListener("click", function () {
        saveSessionData();
    });

    const refreshBtn = document.querySelector("#refresh");
    refreshBtn.addEventListener("click", function () {
        refreshGraphs();
    });

    initializeHeatmap();
    initializeLineChart();
    initialize3DPlot();
    initializeRatioTexts();
});

function startSession() {
    fetch('/start-session', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('Session started:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

function stopSession() {
    fetch('/stop-session', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('Session stopped:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}


function connectToBroker() {
    const clientId = "client" + Math.random().toString(36).substring(7);

    const host = "ws://broker.hivemq.com:8000/mqtt";

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

    mqttClient.on("message", (topic, message, packet) => {
        console.log(
            "Received Message: " + message.toString() + "\nOn topic: " + topic
        );
        const messageTextArea = document.querySelector("#message");
        messageTextArea.value += message + "\r\n";
        dataBuffer.push(message.toString());

        // Save to InfluxDB if save session is on
        const saveSessionCheckbox = document.querySelector("#save-session-checkbox");
        if (saveSessionCheckbox.checked) {
            saveMessageToInfluxDB(message.toString());
        }
    });

    requestAnimationFrame(updateVisualizations); // Start the update loop
}

function saveMessageToInfluxDB(message) {
    fetch('/save-mqtt-message', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ message: message })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Message saved to InfluxDB:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

function subscribeToTopic() {
    const status = document.querySelector("#status");
    const topic = document.querySelector("#topic").value.trim();
    console.log(`Subscribing to Topic: ${topic}`);

    mqttClient.subscribe(topic, { qos: 0 }, (err, granted) => {
        if (err) {
            status.style.color = "red";
            status.value = "ERROR SUBSCRIBING";
            console.error("Subscription error: ", err);
        } else {
            status.style.color = "green";
            status.value = "SUBSCRIBED";
            console.log("Subscribed to: ", granted);

            const unsubscribeBtn = document.querySelector("#unsubscribe");
            unsubscribeBtn.classList.remove("disabled-btn");
            unsubscribeBtn.disabled = false;
        }
    });
}

function unsubscribeToTopic() {
    const status = document.querySelector("#status");
    const topic = document.querySelector("#topic").value.trim();
    console.log(`Unsubscribing to Topic: ${topic}`);

    if (status.value !== "SUBSCRIBED") {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'A session has not been started.',
        });
        return;
    }

    mqttClient.unsubscribe(topic, (err) => {
        if (err) {
            status.style.color = "red";
            status.value = "ERROR UNSUBSCRIBING";
            console.error("Unsubscription error: ", err);
        } else {
            status.style.color = "red";
            status.value = "UNSUBSCRIBED";
            console.log("Unsubscribed from: ", topic);

            const unsubscribeBtn = document.querySelector("#unsubscribe");
            unsubscribeBtn.classList.add("disabled-btn");
            unsubscribeBtn.disabled = true;
        }
    });
}

function saveSessionData() {
    const checkbox = document.querySelector("#save-session-checkbox");
    if (!checkbox.checked) {
        alert("Please switch on the toggle to save session data.");
        return;
    }

    const topic = document.querySelector("#topic").value.trim();
    const message = document.querySelector("#message").value;
    const status = document.querySelector("#status").value;
    const sessionData = `Topic: ${topic}\nMessages:\n${message}\nStatus: ${status}`;

    const blob = new Blob([sessionData], { type: "text/plain" });
    const url = URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = "session_data.txt";
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}

function changeStatusBackground() {
    const status = document.querySelector("#status");
    status.style.backgroundColor = "lightcyan";
}

function initializeHeatmap() {
    const footData = {
        z: footMatrix,
        x: ['0', '1', '2', '3', '4', '5', '6', '7'],
        y: ['7', '6', '5', '4', '3', '2', '1', '0'], // Ensure the Y-axis is correctly set
        type: 'heatmap',
        hoverongaps: false,
        zsmooth: 'best',
        colorscale: 'RdBu'
    };

    Plotly.newPlot('heatmap', [footData]);
}

function initializeLineChart() {
    const data = [{
        y: leftFootLineChart,
        mode: 'lines',
        name: 'Left Foot'
    }, {
        y: rightFootLineChart,
        mode: 'lines',
        name: 'Right Foot'
    }, {
        y: leftFootTopLineChart,
        mode: 'lines',
        name: 'Left Foot Top'
    }, {
        y: leftFootBottomLineChart,
        mode: 'lines',
        name: 'Left Foot Bottom'
    }, {
        y: rightFootTopLineChart,
        mode: 'lines',
        name: 'Right Foot Top'
    }, {
        y: rightFootBottomLineChart,
        mode: 'lines',
        name: 'Right Foot Bottom'
    }];

    Plotly.newPlot('chart', data);
}

function initialize3DPlot() {
    const foot3D = {
        z: footMatrix,
        type: 'surface',
        colorscale: 'YIGnBu'
    };

    const layout = {
        title: "Feet in 3D",
        autosize: false,
        height: 600,
        width: 700,
        margin: {
            l: 65,
            r: 50,
            b: 65,
            t: 30,
        }
    };

    Plotly.newPlot('foot3D', [foot3D], layout);
}

function initializeRatioTexts() {
    // Clear existing dynamic texts if any
    const ratiosContainer = document.querySelector('.ratios-container');
    if (ratiosContainer) {
        ratiosContainer.remove();
    }

    const newRatiosContainer = document.createElement('div');
    newRatiosContainer.className = 'ratios-container';

    const leftRightContainer = document.createElement('div');
    leftRightContainer.className = 'ratios';

    const leftFootRatioText = document.createElement('div');
    leftFootRatioText.id = 'leftFootRatio';
    leftFootRatioText.className = 'ratio-text';
    leftFootRatioText.textContent = 'Left Foot: 0%';

    const rightFootRatioText = document.createElement('div');
    rightFootRatioText.id = 'rightFootRatio';
    rightFootRatioText.className = 'ratio-text';
    rightFootRatioText.textContent = 'Right Foot: 0%';

    leftRightContainer.appendChild(leftFootRatioText);
    leftRightContainer.appendChild(rightFootRatioText);

    const topBottomContainer = document.createElement('div');
    topBottomContainer.className = 'ratios';

    const leftFootTopRatioText = document.createElement('div');
    leftFootTopRatioText.id = 'leftFootTopRatio';
    leftFootTopRatioText.className = 'ratio-text';
    leftFootTopRatioText.textContent = 'Left Foot Top: 0%';

    const leftFootBottomRatioText = document.createElement('div');
    leftFootBottomRatioText.id = 'leftFootBottomRatio';
    leftFootBottomRatioText.className = 'ratio-text';
    leftFootBottomRatioText.textContent = 'Left Foot Bottom: 0%';

    const rightFootTopRatioText = document.createElement('div');
    rightFootTopRatioText.id = 'rightFootTopRatio';
    rightFootTopRatioText.className = 'ratio-text';
    rightFootTopRatioText.textContent = 'Right Foot Top: 0%';

    const rightFootBottomRatioText = document.createElement('div');
    rightFootBottomRatioText.id = 'rightFootBottomRatio';
    rightFootBottomRatioText.className = 'ratio-text';
    rightFootBottomRatioText.textContent = 'Right Foot Bottom: 0%';

    topBottomContainer.appendChild(leftFootTopRatioText);
    topBottomContainer.appendChild(leftFootBottomRatioText);
    topBottomContainer.appendChild(rightFootTopRatioText);
    topBottomContainer.appendChild(rightFootBottomRatioText);

    newRatiosContainer.appendChild(leftRightContainer);
    newRatiosContainer.appendChild(topBottomContainer);

    const chartContainer = document.querySelector('#chart-container');
    chartContainer.insertBefore(newRatiosContainer, chartContainer.firstChild);
}

function updateVisualizations() {
    while (dataBuffer.length > 0) {
        const message = dataBuffer.shift();
        let parsedMessage;

        try {
            parsedMessage = JSON.parse(message);
            console.log("Parsed message: ", parsedMessage);
        } catch (e) {
            console.error("Failed to parse message", e);
            continue;
        }

        const { timestamp, quadrantID, value } = parsedMessage;
        const row = parseInt(quadrantID[0]);
        const column = parseInt(quadrantID[1]);
        const numericValue = parseFloat(value);

        const currentTime = new Date().getTime();
        const messageTime = new Date(timestamp).getTime();

        // Filter data to only include last few seconds
        if (currentTime - messageTime <= 10000) {
            footMatrix[row][column] = numericValue;

            console.log(`Updated footMatrix[${row}][${column}] to ${numericValue}`);

            // Update cumulative values and line charts
            if (column < 4) {
                leftFootCumulative += numericValue;
                if (row < 4) {
                    leftFootTopCumulative += numericValue;
                } else {
                    leftFootBottomCumulative += numericValue;
                }
            } else {
                rightFootCumulative += numericValue;
                if (row < 4) {
                    rightFootTopCumulative += numericValue;
                } else {
                    rightFootBottomCumulative += numericValue;
                }
            }

            const totalValue = leftFootCumulative + rightFootCumulative;
            const leftFootRatio = (leftFootCumulative / totalValue) * 100 || 0;
            const rightFootRatio = (rightFootCumulative / totalValue) * 100 || 0;

            const leftFootTopRatio = (leftFootTopCumulative / leftFootCumulative) * 100 || 0;
            const leftFootBottomRatio = (leftFootBottomCumulative / leftFootCumulative) * 100 || 0;
            const rightFootTopRatio = (rightFootTopCumulative / rightFootCumulative) * 100 || 0;
            const rightFootBottomRatio = (rightFootBottomCumulative / rightFootCumulative) * 100 || 0;

            leftFootLineChart.push(leftFootRatio);
            rightFootLineChart.push(rightFootRatio);
            leftFootTopLineChart.push(leftFootTopRatio);
            leftFootBottomLineChart.push(leftFootBottomRatio);
            rightFootTopLineChart.push(rightFootTopRatio);
            rightFootBottomLineChart.push(rightFootBottomRatio);

            document.getElementById('leftFootRatio').textContent = `Left Foot: ${leftFootRatio.toFixed(2)}%`;
            document.getElementById('rightFootRatio').textContent = `Right Foot: ${rightFootRatio.toFixed(2)}%`;
            document.getElementById('leftFootTopRatio').textContent = `Left Foot Top: ${leftFootTopRatio.toFixed(2)}%`;
            document.getElementById('leftFootBottomRatio').textContent = `Left Foot Bottom: ${leftFootBottomRatio.toFixed(2)}%`;
            document.getElementById('rightFootTopRatio').textContent = `Right Foot Top: ${rightFootTopRatio.toFixed(2)}%`;
            document.getElementById('rightFootBottomRatio').textContent = `Right Foot Bottom: ${rightFootBottomRatio.toFixed(2)}%`;

            Plotly.redraw('heatmap');
            Plotly.redraw('foot3D');

            Plotly.extendTraces('chart', {
                y: [[leftFootRatio], [rightFootRatio], [leftFootTopRatio], [leftFootBottomRatio], [rightFootTopRatio], [rightFootBottomRatio]]
            }, [0, 1, 2, 3, 4, 5]);
        }
    }

    requestAnimationFrame(updateVisualizations); // Continue the update loop
}

function refreshGraphs() {
    // Reset the cumulative values and charts
    leftFootCumulative = 0;
    rightFootCumulative = 0;
    leftFootTopCumulative = 0;
    leftFootBottomCumulative = 0;
    rightFootTopCumulative = 0;
    rightFootBottomCumulative = 0;

    leftFootLineChart = [];
    rightFootLineChart = [];
    leftFootTopLineChart = [];
    leftFootBottomLineChart = [];
    rightFootTopLineChart = [];
    rightFootBottomLineChart = [];

    footMatrix = Array.from({ length: 8 }, () => Array(8).fill(0));

    initializeHeatmap();
    initializeLineChart();
    initialize3DPlot();
    initializeRatioTexts();
}

