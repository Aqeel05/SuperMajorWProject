<?php

namespace App\Services;

use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Point;

class InfluxDBService
{
    protected $client;
    protected $bucket;
    protected $org;

    public function __construct()
    {
        $this->bucket = env('INFLUXDB_BUCKET');
        $this->org = env('INFLUXDB_ORG');
        $token = env('INFLUXDB_TOKEN');
        $url = env('INFLUXDB_URL');

        $this->client = new Client([
            "url" => $url,
            "token" => $token,
            'precision' => WritePrecision::S
        ]);
    }

    public function writeData($measurement, $tags, $fields, $time = null)
    {
        $point = new Point($measurement);

        foreach ($tags as $key => $value) {
            $point->addTag($key, $value);
        }

        foreach ($fields as $key => $value) {
            $point->addField($key, $value);
        }

        if ($time) {
            $point->time($time, WritePrecision::S);
        } else {
            $point->time((new \DateTime())->getTimestamp(), WritePrecision::S);
        }

        $writeApi = $this->client->createWriteApi();
        $writeApi->write($point, WritePrecision::S, $this->bucket, $this->org);
    }

    public function queryData($query)
    {
        $queryApi = $this->client->createQueryApi();
        return $queryApi->query($query, $this->org);
    }
}
