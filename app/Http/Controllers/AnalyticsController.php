<?php

namespace App\Http\Controllers;

use App\Services\InfluxDBService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    protected $influxDBService;

    public function __construct(InfluxDBService $influxDBService)
    {
        $this->influxDBService = $influxDBService;
    }

    public function showData()
    {
        $userID = auth()->user()->id; // Get the authenticated user's ID
        $query = 'from(bucket: "' . env('INFLUXDB_BUCKET') . '") 
                |> range(start: -100m)
                |> filter(fn: (r) => r._measurement == "sensor_data" and r.userID == "' . $userID . '")
                |> pivot(rowKey: ["_time"], columnKey: ["_field"], valueColumn: "_value")';
    
        $result = $this->influxDBService->queryData($query);
    
        $data = [];
        foreach ($result as $table) {
            foreach ($table->records as $record) {
                $utcTime = $record->values['_time'];
                $sgtTime = Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $utcTime, 'UTC')->setTimezone('Asia/Singapore');
    
                $data[] = [
                    'time' => $sgtTime->toDateTimeString(), // Convert to string
                    'sensorID' => $record->values['sensorID'],
                    'pressure' => $record->values['pressure']
                ];
            }
        }
    
        return view('analytics.index', compact('data'));
    }

    public function mqttSend()
    {
        return view('analytics.sending');
    }


    public function send()
    {
        return view('analytics.send');
    }

    public function display()
    {
        return view('analytics.dashboard');
    }

    public function storeData(Request $request)
    {
        $request->validate([
            'sensorValue' => 'required|integer|min:0|max:4095',
            'sensorID' => 'required|integer|min:1|max:10',
            'userID' => 'required|integer|exists:users,id'
        ]);

        $measurement = 'sensor_data';
        $tags = [
            'userID' => $request->input('userID')
        ];
        $fields = [
            'pressure' => $request->input('sensorValue'),
            'sensorID' => $request->input('sensorID')
        ];

        $this->influxDBService->writeData($measurement, $tags, $fields);

        return to_route('analytics.index')->with('message', 'Data was sent');
    }
}
