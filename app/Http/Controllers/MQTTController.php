<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InfluxDBService;

class MQTTController extends Controller
{
    protected $influxDBService;

    public function __construct(InfluxDBService $influxDBService)
    {
        $this->influxDBService = $influxDBService;
    }

    public function saveMessage(Request $request)
    {
        $message = $request->input('message');
        $parsedMessage = json_decode($message, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            $measurement = 'mqtt_data';
            $tags = [
                'topic' => 'sensor_data', // or any relevant tag
            ];
            $fields = [
                'value' => (float) $parsedMessage['value'],
                'quadrantID' => $parsedMessage['quadrantID'],
            ];
            $time = strtotime($parsedMessage['timestamp']);

            $this->influxDBService->writeData($measurement, $tags, $fields, $time);

            return response()->json(['status' => 'success'], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Invalid JSON'], 400);
        }
    }
}

