<x-app-layout>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Visualization Dashboard</title>
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
        <script src="https://d3js.org/d3.v7.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            body {
                color: white; /* Set default text color to white */
            }
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
                box-shadow: 0 0 15px 4px rgba(255, 255, 255, 0.1);
                background-color: #333; /* Added background color to make text visible */
            }
            .visualization-box h2 {
                color: white; /* Set header text color to white */
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
                border: 2px solid white;
                border-radius: 5px;
                color: white; /* Set ratio text color to white */
                background-color: #444; /* Added background color to make text visible */
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
        </style>
    </head>
    <body>
        <div class="dashboard-container" id="dashboard-container"></div>
    
        <script>
            const exampleData = [
                {
                    sessionId: 1,
                    footMatrix: [
                        [5, 15, 25, 35, 40, 25, 15, 5],
                        [15, 25, 35, 30, 25, 35, 25, 15],
                        [20, 30, 25, 24, 15, 25, 30, 20],
                        [0, 20, 15, 10, 5, 15, 20, 0],
                        [0, 20, 15, 10, 5, 15, 20, 0],
                        [20, 30, 45, 20, 15, 35, 30, 20],
                        [15, 25, 35, 30, 25, 35, 25, 15],
                        [10, 20, 30, 40, 35, 30, 20, 10]
                    ],
                    leftFootRatio: 52,
                    rightFootRatio: 48,
                    leftFootTopRatio: 50,
                    leftFootBottomRatio: 50,
                    rightFootTopRatio: 50,
                    rightFootBottomRatio: 50,
                },
                {
                    sessionId: 2,
                    footMatrix: [
                        [5, 15, 25, 35, 40, 25, 15, 5],
                        [15, 25, 35, 30, 25, 35, 25, 15],
                        [20, 30, 25, 20, 15, 25, 30, 20],
                        [0, 20, 15, 10, 5, 15, 20, 0],
                        [0, 20, 15, 10, 5, 15, 20, 0],
                        [20, 30, 25, 20, 15, 25, 30, 20],
                        [15, 25, 35, 30, 25, 35, 25, 15],
                        [10, 20, 30, 40, 35, 30, 20, 10]
                    ],
                    leftFootRatio: 55,
                    rightFootRatio: 45,
                    leftFootTopRatio: 55,
                    leftFootBottomRatio: 45,
                    rightFootTopRatio: 45,
                    rightFootBottomRatio: 55,
                },
                {
                    sessionId: 8,
                    footMatrix: [
                        [5, 15, 25, 35, 40, 25, 15, 5],
                        [15, 25, 35, 30, 25, 35, 25, 15],
                        [20, 30, 25, 20, 15, 25, 30, 20],
                        [0, 20, 15, 10, 5, 15, 20, 0],
                        [0, 20, 15, 10, 5, 15, 20, 0],
                        [20, 30, 25, 20, 15, 25, 30, 20],
                        [15, 25, 35, 30, 25, 35, 25, 15],
                        [10, 20, 30, 40, 35, 30, 20, 10]
                    ],
                    leftFootRatio: 52,
                    rightFootRatio: 48,
                    leftFootTopRatio: 50,
                    leftFootBottomRatio: 50,
                    rightFootTopRatio: 50,
                    rightFootBottomRatio: 50,
                }
            ];
    
            window.addEventListener("load", (event) => {
                exampleData.forEach(data => createVisualizationBox(data));
            });
    
            function createVisualizationBox(data) {
                const container = document.querySelector("#dashboard-container");
    
                const box = document.createElement("div");
                box.className = "visualization-box";
                box.innerHTML = `
                    <h2>Capture ${data.sessionId}</h2>
                    <div id="heatmap2D-${data.sessionId}" class="heatmap"></div>
                    <div class="ratios-container">
                        <div id="leftFootRatio-${data.sessionId}" class="ratio-text">Left Foot: ${data.leftFootRatio}%</div>
                        <div id="rightFootRatio-${data.sessionId}" class="ratio-text">Right Foot: ${data.rightFootRatio}%</div>
                    </div>
                    <div class="ratios-container">
                        <div id="leftFootTopRatio-${data.sessionId}" class="ratio-text">Left Foot Top: ${data.leftFootTopRatio}%</div>
                        <div id="leftFootBottomRatio-${data.sessionId}" class="ratio-text">Left Foot Bottom: ${data.leftFootBottomRatio}%</div>
                        <div id="rightFootTopRatio-${data.sessionId}" class="ratio-text">Right Foot Top: ${data.rightFootTopRatio}%</div>
                        <div id="rightFootBottomRatio-${data.sessionId}" class="ratio-text">Right Foot Bottom: ${data.rightFootBottomRatio}%</div>
                    </div>
                    <div id="threeDPlot-${data.sessionId}" class="three-d-plot"></div>
                    <a href="{{ route('note.create') }}">
                        <button type="button" class="note-btn">Create Note</button>
                    </a>
                `;
    
                container.appendChild(box);
    
                render2DHeatmap(data.sessionId, data.footMatrix);
                render3DPlot(data.sessionId, data.footMatrix);
            }
    
            function render2DHeatmap(sessionId, footMatrix) {
                const data = [{
                    z: footMatrix,
                    type: 'heatmap',
                    hoverongaps: false,
                    colorscale: 'RdBu'
                }];
    
                Plotly.newPlot(`heatmap2D-${sessionId}`, data);
            }
    
            function render3DPlot(sessionId, footMatrix) {
                const data = [{
                    z: footMatrix,
                    type: 'surface',
                    colorscale: 'YIGnBu'
                }];
    
                const layout = {
                    title: `3D Heatmap for Capture ${sessionId}`,
                    autosize: false,
                    height: 300,
                    width: 300,
                    margin: {
                        l: 65,
                        r: 50,
                        b: 65,
                        t: 90,
                    },
                    scene: {
                        xaxis: { title: 'X' },
                        yaxis: { title: 'Y' },
                        zaxis: { title: 'Z' },
                    }
                };
    
                Plotly.newPlot(`threeDPlot-${sessionId}`, data, layout);
            }
        </script>
    </body>
    </x-app-layout>
    