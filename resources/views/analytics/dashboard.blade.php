<x-app-layout>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <link rel="stylesheet" type="text/css" href="dashboard.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/dashboard.css', 'resources/js/app.js'])
</head>

<body>
    <div id="navbar" class="navbar"><span> FWDIS Dashboard </span></div>

    <!-- Start Session and End Session buttons -->
    <div class="button-container">
        <form method="POST" action="{{ route('mqtt.subscribe') }}" style="display:inline;">
            @csrf
            <input type="hidden" name="userID" value="{{ auth()->user()->id }}">
            <button type="submit">Start Session</button>
        </form>

        <form method="POST" action="{{ route('mqtt.unsubscribe') }}" style="display:inline;">
            @csrf
            <button type="submit">End Session</button>
        </form>
    </div>
    

    <div id='myDiv'><!-- Plotly chart will be drawn inside this DIV --></div>
    <script>
        var data = [
        {
            z: [[50, 40, null, 40, 50],
                [40, 0, null, 0, 40], // LR2 and LR4 pressure sensors don't exist so they're regarded as having 0 pressure
                [45, 8, null, 15, 45],
                [50, 25, null, 30, 50],
                [40, 37, null, 40, 40]],
            x: ['LL','LR','Unused','RL','RR'],
            y: ['1','2','3','4','5'],
            type: 'heatmap',
            hoverongaps: false,
            zsmooth: 'best',
            colorscale: 'RdBu'
        }
        ];

        Plotly.newPlot('myDiv', data);

    </script>

    <div class="wrapper">
        <svg id="chart2d" version="1.0" xmlns="http://www.w3.org/2000/svg"
            width="540.000000pt" height="640.000000pt" viewBox="0 0 1079.000000 1280.000000"
            preserveAspectRatio="xMidYMid meet">
        <g transform="translate(0.000000,1280.000000) scale(0.100000,-0.100000)"
        fill="#000000" stroke="none">
        <path id="left-foot" d="M3832 12784 c-160 -43 -304 -173 -401 -364 -92 -178 -125 -328 -125
        -555 1 -287 72 -486 229 -641 272 -270 700 -217 916 113 93 142 139 323 139
        543 0 578 -363 1011 -758 904z"/>
        <path id="right-foot" d="M6721 12785 c-171 -48 -311 -180 -411 -385 -76 -158 -110 -319 -110
        -520 0 -289 72 -494 231 -653 147 -148 333 -204 534 -162 250 52 432 259 502
        569 20 88 23 362 5 456 -37 186 -119 374 -217 493 -63 76 -171 157 -254 188
        -74 28 -206 35 -280 14z"/>
        <path d="M2515 12296 c-176 -45 -318 -217 -361 -436 -52 -262 64 -534 266
        -629 47 -22 69 -26 150 -26 88 0 100 2 163 34 127 64 229 202 274 371 22 86
        22 243 -1 330 -68 253 -284 410 -491 356z"/>
        <path d="M8098 12296 c-149 -43 -275 -191 -319 -376 -17 -76 -15 -231 5 -310
        96 -381 464 -534 705 -293 222 223 211 650 -24 872 -104 98 -250 141 -367 107z"/>
        <path d="M1564 11702 c-221 -77 -322 -410 -202 -669 34 -73 131 -166 196 -188
        147 -48 298 28 380 191 40 80 55 152 54 254 -1 106 -28 196 -82 278 -87 130
        -214 179 -346 134z"/>
        <path d="M9048 11705 c-30 -10 -69 -35 -106 -69 -96 -89 -142 -204 -142 -356
        0 -196 83 -351 225 -421 59 -29 72 -31 132 -27 113 8 204 72 265 185 78 143
        78 363 1 506 -85 155 -233 227 -375 182z"/>
        <path d="M796 11066 c-93 -35 -157 -122 -178 -244 -23 -133 20 -278 111 -375
        63 -67 118 -98 191 -104 201 -19 332 227 251 469 -64 192 -233 306 -375 254z"/>
        <path d="M9880 11071 c-159 -32 -280 -210 -280 -412 0 -132 58 -247 150 -297
        38 -20 55 -23 115 -19 39 2 84 11 100 19 91 48 177 168 205 286 28 120 -3 265
        -74 349 -47 56 -142 88 -216 74z"/>
        <path d="M3105 10849 c-603 -49 -1276 -333 -1915 -807 -294 -218 -570 -469
        -704 -640 -231 -293 -356 -581 -413 -943 -24 -154 -24 -494 0 -669 54 -391
        152 -734 477 -1664 202 -581 277 -808 349 -1056 164 -569 344 -1421 425 -2012
        68 -494 82 -751 56 -1013 -20 -187 -18 -448 3 -562 123 -658 582 -1190 1207
        -1397 512 -170 1020 -86 1470 242 105 76 312 289 392 402 73 104 169 281 217
        402 35 88 83 266 103 378 20 114 16 431 -6 555 -73 405 -280 775 -678 1215
        -52 58 -198 213 -325 345 -487 508 -704 774 -888 1088 -289 495 -377 1036
        -239 1479 38 122 134 310 211 413 137 183 307 337 685 618 294 219 505 433
        720 727 532 731 709 1509 475 2084 -235 576 -838 879 -1622 815z"/>
        <path d="M7278 10849 c-274 -24 -541 -111 -740 -242 -390 -254 -598 -686 -575
        -1192 26 -548 285 -1132 748 -1685 150 -179 326 -343 547 -507 347 -258 494
        -386 616 -532 208 -250 309 -491 338 -808 43 -473 -134 -987 -515 -1496 -173
        -230 -302 -377 -671 -762 -122 -127 -266 -280 -320 -340 -403 -446 -608 -813
        -682 -1220 -22 -125 -26 -442 -5 -555 21 -124 60 -269 97 -364 209 -541 664
        -961 1184 -1095 304 -78 594 -66 900 35 670 222 1150 822 1222 1526 11 108 9
        170 -22 573 -11 141 -9 200 21 495 59 594 186 1281 379 2050 98 391 172 625
        440 1396 325 931 423 1275 476 1664 24 176 24 516 1 669 -96 615 -387 1034
        -1082 1556 -808 607 -1632 899 -2357 834z"/>
        <path d="M172 10489 c-50 -15 -116 -87 -143 -155 -34 -88 -33 -241 3 -341 98
        -272 343 -323 455 -95 23 48 28 72 31 159 6 151 -31 265 -117 356 -64 69 -155
        99 -229 76z"/>
        <path d="M10510 10491 c-47 -15 -85 -39 -121 -78 -50 -53 -74 -96 -99 -181
        -18 -61 -22 -90 -18 -175 5 -123 29 -187 93 -246 133 -123 316 -38 392 182 64
        184 24 388 -92 469 -43 30 -113 43 -155 29z"/>
        </g>
        </svg>
        <!--<button onclick="changeColor('left-foot', -1)">Left Foot - Decrease</button>
        <button onclick="changeColor('left-foot', 1)">Left Foot - Increase</button>
        <button onclick="changeColor('right-foot', -1)">Right Foot - Decrease</button>
        <button onclick="changeColor('right-foot', 1)">Right Foot - Increase</button>
        -->
        <script>
            let leftFootValue = 0;
            let rightFootValue = 0;

            function changeColor(id, change) {
                const colorScale = d3.scaleLinear()
                    .domain([0, 10])
                    .range(["blue", "yellow"]);

                let value = 0;
                if (id === "left-foot") {
                    value = leftFootValue;
                    leftFootValue += change;
                    if (leftFootValue < 0) {
                        leftFootValue = 0;
                    }
                    if (leftFootValue> 10) {
                        leftFootValue = 10;
                    }
                } else if (id === "right-foot") {
                    value = rightFootValue;
                    rightFootValue += change;
                    if (rightFootValue < 0) {
                        rightFootValue = 0;
                    }
                    if (rightFootValue > 10) {
                        rightFootValue = 10;
                    }
                }

                const color = colorScale(value);
                const element = document.getElementById(id);
                element.setAttribute("fill", color);
            }
        </script>
    </div>

    <div class="wrapper">
        <div class="charts-container3d">
            <div id="chart3d1"></div>
            <div id="chart3d2"></div>
        </div>

        <script>
            const CSV1 = "https://raw.githubusercontent.com/chris3edwards3/exampledata/master/plotlyJS/3d.csv";
            const CSV2 = "https://raw.githubusercontent.com/chris3edwards3/exampledata/master/plotlyJS/3d.csv";
            Plotly.d3.csv(CSV1, function(err, rows){
                function unpack(rows, key) {
                    return rows.map(function(row) { return row[key]; });
                }

                let z_data=[];

                let i = 0;
                while (i < 21) {
                    z_data.push(unpack(rows, i));
                    i += 1;
                }

                let data = [{
                    z: z_data,
                    type: 'surface',
                    // colorscale: "YIGnBu" //https://plot.ly/javascript/colorscales/
                }];

                let layout = {
                    title: "Left Foot in 3D",
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

                Plotly.newPlot('chart3d1', data, layout);
            });
            Plotly.d3.csv(CSV2, function(err, rows){
                function unpack(rows, key) {
                    return rows.map(function(row) { return row[key]; });
                }

                let z_data=[];

                let i = 0;
                while (i < 21) {
                    z_data.push(unpack(rows, i));
                    i += 1;
                }

                let data = [{
                    z: z_data,
                    type: 'surface',
                    colorscale: "YIGnBu" //https://plot.ly/javascript/colorscales/
                }];

                let layout = {
                    title: "Right Foot in 3D",
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

                Plotly.newPlot('chart3d2', data, layout);
            });
        </script>

    </div>

    <div class="wrapper">
        <span id="span" class="positioned"> Left Foot + Right Foot (Total Weight) </span>
        <div id="chart"></div>
        <script>
            function getData() {
                return Math.random();
            } 

            var num = getData();
            var num1 = 1-num;

            // Initialize data for both lines
            var data = [{
                y: [num],
                type: 'line',
                name: 'Left' // Optional name for the first line
            }, {
                y: [num1],
                type: 'line',
                name: 'Right' // Optional name for the second line
            }];

            Plotly.newPlot('chart', data);

            var cnt = 0;

            setInterval(function() {
                // Generate random data for both lines
                var num = getData();
                var num1 = 1-num;
                var newData = [
                    [num],
                    [num1]
                ];

                // Extend both lines
                Plotly.extendTraces('chart', { y: newData }, [0, 1]);
                cnt++;

                if (cnt > 500) {
                    Plotly.relayout('chart', {
                        xaxis: {
                            range: [cnt - 500, cnt]
                        }
                    });
                }
            }, 100);
        </script>
    </div>
</body>
</x-app-layout>