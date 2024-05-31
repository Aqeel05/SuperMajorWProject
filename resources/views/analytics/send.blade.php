<x-app-layout>
    <head>
        <title>Send Sensor Data to InfluxDB</title>
        <style>
            /* Add CSS styles for the button and input fields */
            .btn {
                display: inline-block;
                padding: 10px 20px;
                background-color: #4CAF50;
                color: white;
                text-align: center;
                text-decoration: none;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .btn:hover {
                background-color: #45a049;
            }

            .input-field, .select-field {
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                margin-bottom: 10px;
                width: 100%;
                box-sizing: border-box;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-container {
                max-width: 400px;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-color: #fff;
            }

            .form-title {
                text-align: center;
                margin-bottom: 20px;
            }

            .centered-wrapper {
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 75vh;
                background-color: #f5f5f5;
            }
        </style>
    </head>
    <body>
        <div class="centered-wrapper">
            <div class="form-container">
                <h1 class="form-title">Send Sensor Data to InfluxDB</h1>

                @if (session('success'))
                    <p>{{ session('success') }}</p>
                @endif

                <form action="{{ route('analytics.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="sensorValue">Sensor Value (0-4095)</label>
                        <input type="number" id="sensorValue" name="sensorValue" class="input-field" min="0" max="4095" required>
                    </div>
                    <div class="form-group">
                        <label for="sensorID">Sensor ID (1-9)</label>
                        <select id="sensorID" name="sensorID" class="select-field" required>
                            @for ($i = 1; $i <= 9; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <input type="hidden" name="userID" value="{{ auth()->user()->id }}">
                    <button type="submit" class="btn">Send Data</button>
                </form>
            </div>
        </div>
    </body>
</x-app-layout>
