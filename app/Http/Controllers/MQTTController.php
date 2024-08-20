<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InfluxDBService;
use Illuminate\Support\Facades\Log;

class MQTTController extends Controller
{
    protected $influxDBService;

    public function __construct(InfluxDBService $influxDBService)
    {
        $this->influxDBService = $influxDBService;
    }

    public function saveMessage(Request $request)
    {
        $message = $request->getContent(); 
        $sessionId = $request->input('session_id');
        $userId = $request->input('user_id');
        $parsedMessage = json_decode($message, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            $data = [];
            foreach ($parsedMessage['data'] as $dataPoint) {
                $data[] = [
                    'measurement' => 'mqtt_data',
                    'tags' => [
                        'sessionID' => $sessionId,
                        'userID' => $userId,
                    ],
                    'fields' => [
                        'value' => (float) $dataPoint['value'],
                        'quadrantID' => $dataPoint['quadrantID']
                    ],
                    'time' => $parsedMessage['timestamp']
                ];
            }

            $this->influxDBService->writeData($data);

            return response()->json(['status' => 'success'], 200);
        } else {
            Log::error('Invalid JSON received: ' . json_last_error_msg());
            return response()->json(['status' => 'error', 'message' => 'Invalid JSON'], 400);
        }
    }

    public function getInfluxDBData(Request $request)
    {
        $sessionId = $request->query('session_id');
        $timestamp = $request->query('timestamp');

        try {
            // Query InfluxDB to get the data
            $data = $this->influxDBService->queryData($sessionId, $timestamp);

            return response()->json($data);
        } catch (\Exception $e) {
            \Log::error('Error fetching data from InfluxDB: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching data'], 500);
        }
    }

}
