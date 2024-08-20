<?php

namespace App\Services;

use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Point;
use Illuminate\Support\Facades\Log;

class InfluxDBService
{
    protected $client;
    protected $bucket;
    protected $org;

    public function __construct()
    {
        $this->client = new Client([
            "url" => env('INFLUXDB_URL'),
            "token" => env('INFLUXDB_TOKEN')
        ]);

        $this->bucket = env('INFLUXDB_BUCKET');
        $this->org = env('INFLUXDB_ORG');
    }

    public function writeData(array $data)
    {
        $writeApi = $this->client->createWriteApi();

        foreach ($data as $record) {
            $point = new Point('mqtt_data');
            $point->addTag('sessionID', $record['sessionID']);
            $point->addTag('userID', $record['userID']);
            $point->addField('quadrantID', $record['quadrantID']);
            $point->addField('value', $record['value']);
            $point->time($record['timestamp'], WritePrecision::NS);

            $writeApi->write($point, WritePrecision::NS, $this->bucket, $this->org);
        }
    }

    public function getLatestSessionId()
    {
        try {
            $queryApi = $this->client->createQueryApi();
            $query = "from(bucket: \"{$this->bucket}\")
                      |> range(start: -30d)
                      |> filter(fn: (r) => r[\"_measurement\"] == \"mqtt_data\")
                      |> group(columns: [\"sessionID\"])
                      |> max(column: \"_time\")";

            $tables = $queryApi->query($query);

            if (count($tables) > 0) {
                $latestSessionId = null;
                foreach ($tables as $table) {
                    foreach ($table->records as $record) {
                        $sessionId = (int) $record->values['sessionID'];
                        if ($latestSessionId === null || $sessionId > $latestSessionId) {
                            $latestSessionId = $sessionId;
                        }
                    }
                }
                return $latestSessionId;
            }

            return null;
        } catch (\Exception $e) {
            Log::error('Error retrieving latest session ID: ' . $e->getMessage());
            return null;
        }
    }

    public function deleteData($measurement, $sessionId)
    {
        try {
            $deleteQuery = "from(bucket: \"{$this->bucket}\")
                            |> range(start: 1970-01-01T00:00:00Z, stop: now())
                            |> filter(fn: (r) => r[\"_measurement\"] == \"{$measurement}\" and r[\"sessionID\"] == \"{$sessionId}\")";

            $deleteApi = $this->client->createQueryApi();
            $deleteApi->query($deleteQuery, $this->org);

        } catch (\Exception $e) {
            Log::error('Error deleting data: ' . $e->getMessage());
        }
    }

    public function queryData($sessionId, $timestamp)
    {
        $query = "from(bucket: \"{$this->bucket}\")
                  |> range(start: {$timestamp})
                  |> filter(fn: (r) => r[\"_measurement\"] == \"mqtt_data\" and r[\"sessionID\"] == \"{$sessionId}\")
                  |> group(columns: [\"quadrantID\"])
                  |> mean()";
    
        $tables = $this->client->createQueryApi()->query($query, $this->org);
        $data = [];
        
        foreach ($tables as $table) {
            foreach ($table->records as $record) {
                $values = $record->values;
                $data[] = [
                    'quadrantID' => $values['quadrantID'],
                    'value' => $values['_value']
                ];
            }
        }
    
        return $data;
    }

    
}
