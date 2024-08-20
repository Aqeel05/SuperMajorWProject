<x-app-layout>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Visualization Dashboard</title>
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
        <script src="https://d3js.org/d3.v7.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            .dashboard-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
            }
            .visualization-box {
                width: 45%;
                margin: 20px;
                border: 1px solid #ddd;
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 0 15px 4px rgba(0, 0, 0, 0.1);
            }
            .heatmap, .line-chart, .three-d-plot {
                width: 100%;
                height: 300px;
            }
            .ratios-container {
                display: flex;
                justify-content: space-around;
                margin: 20px 0;
            }
            .ratio-text {
                font-size: 1.2em;
                font-weight: bold;
                text-align: center;
                margin: 5px;
                padding: 10px;
                border: 2px solid black;
                border-radius: 5px;
            }
            .note-btn {
                display: block;
                margin: 20px auto;
                padding: 15px 30px;
                font-size: 1.2em;
                font-weight: bold;
                color: white;
                background-color: #28a745;
                border: none;
                border-radius: 10px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }
            .note-btn:hover {
                background-color: #218838;
            }
            .no-captures-container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                color: white;
                font-size: 2em;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="dashboard-container" id="dashboard-container">
            @if ($noCaptures)
                <div class="no-captures-container">
                    <div>No captures taken</div>
                </div>
            @else
                <script>
                    const sensorData = @json($sensorData);
                    
                    window.addEventListener("load", (event) => {
                        sensorData.forEach(data => createVisualizationBox(data));
                    });
    
                    function createVisualizationBox(data) {
                        const container = document.querySelector("#dashboard-container");
    
                        const box = document.createElement("div");
                        box.className = "visualization-box";
                        box.innerHTML = `
                            <h2>Capture at ${data.timestamp}</h2>
                            <div id="heatmap2D-${data.timestamp}" class="heatmap"></div>
                            <div class="ratios-container">
                                <div id="leftFootRatio-${data.timestamp}" class="ratio-text">Left Foot: ${data.leftFootRatio}%</div>
                                <div id="rightFootRatio-${data.timestamp}" class="ratio-text">Right Foot: ${data.rightFootRatio}%</div>
                            </div>
                            <div class="ratios-container">
                                <div id="leftFootTopRatio-${data.timestamp}" class="ratio-text">Left Foot Top: ${data.leftFootTopRatio}%</div>
                                <div id="leftFootBottomRatio-${data.timestamp}" class="ratio-text">Left Foot Bottom: ${data.leftFootBottomRatio}%</div>
                                <div id="rightFootTopRatio-${data.timestamp}" class="ratio-text">Right Foot Top: ${data.rightFootTopRatio}%</div>
                                <div id="rightFootBottomRatio-${data.timestamp}" class="ratio-text">Right Foot Bottom: ${data.rightFootBottomRatio}%</div>
                            </div>
                            <div id="threeDPlot-${data.timestamp}" class="three-d-plot"></div>
                            
                            <a href="{{ route('note.create') }}">
                                <button type="button" class="note-btn">Create Note</button>
                            </a>

                                                    
                        `;
    
                        container.appendChild(box);
    
                        render2DHeatmap(data.timestamp, data.data);
                        render3DPlot(data.timestamp, data.data);
                    }
    
                    function render2DHeatmap(timestamp, footMatrix) {
                        const data = [{
                            z: footMatrix,
                            type: 'heatmap',
                            hoverongaps: false,
                            colorscale: 'RdBu'
                        }];
    
                        Plotly.newPlot(`heatmap2D-${timestamp}`, data);
                    }
    
                    function render3DPlot(timestamp, footMatrix) {
                        const data = [{
                            z: footMatrix,
                            type: 'surface',
                            colorscale: 'YIGnBu'
                        }];
    
                        const layout = {
                            title: `3D Heatmap for Capture at ${timestamp}`,
                            autosize: false,
                            height: 300,
                            width: 300,
                            margin: {
                                l: 65,
                                r: 50,
                                b: 65,
                                t: 90,
                            }
                        };
    
                        Plotly.newPlot(`threeDPlot-${timestamp}`, data, layout);
                    }
                </script>
            @endif
        </div>
    </body>
</x-app-layout>
    