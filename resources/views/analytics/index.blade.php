<x-app-layout>
    <head>
        <title>InfluxDB Data</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0px;
                background-color: #f5f5f5;
            }
            h1 {
                text-align: center;
                margin-bottom: 20px;
                color: #333;
            }
            table {
                width: 80%;
                margin: 0 auto;
                border-collapse: collapse;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                background-color: #fff;
            }
            th, td {
                padding: 15px;
                border: 1px solid #ddd;
                text-align: left;
                transition: background-color 0.3s;
            }
            th {
                background-color: #4CAF50;
                color: white;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            tr:hover {
                background-color: #e0e0e0;
            }
            td {
                color: #555;
            }
            th.sortable:hover {
                cursor: pointer;
                background-color: #45a049;
            }
            @media (max-width: 768px) {
                table {
                    width: 100%;
                }
                th, td {
                    padding: 10px;
                }
            }
        </style>
    </head>
    <body>
        <br>
        <h1>InfluxDB Data</h1>
        <table>
            <thead>
                <tr>
                    <th class="sortable">Time</th>
                    <th class="sortable">Sensor ID</th>
                    <th class="sortable">Pressure</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $record)
                    <tr>
                        <td>{{ $record['time'] }}</td>
                        <td>{{ $record['sensorID'] }}</td>
                        <td>{{ $record['pressure'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No data found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </body>
    <br>
    <br>
</x-app-layout>
