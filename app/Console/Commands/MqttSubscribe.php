<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use App\Events\MqttMessageReceived;
use Illuminate\Support\Facades\Cache;

class MqttSubscribe extends Command
{
    protected $signature = 'mqtt:subscribe';
    protected $description = 'Subscribe to MQTT topic and handle data';

    private $mqtt;
    private $topic = 'sensor_data';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $server = env('MQTT_SERVER', 'test.mosquitto.org');
        $port = env('MQTT_PORT', 1883);
        $clientId = env('MQTT_CLIENT_ID', 'laravel_client');
        $username = env('MQTT_USERNAME', null);
        $password = env('MQTT_PASSWORD', null);

        $connectionSettings = new ConnectionSettings();
        if ($username !== null && $password !== null) {
            $connectionSettings->setUsername($username)
                               ->setPassword($password);
        }

        $this->mqtt = new MqttClient($server, $port, $clientId);

        try {
            $this->mqtt->connect($connectionSettings, true);
        } catch (\Exception $e) {
            $this->error('Could not connect to the MQTT broker: ' . $e->getMessage());
            return;
        }

        $this->info('Connected to MQTT broker');

        $this->mqtt->subscribe($this->topic, function (string $topic, string $message) {
            $data = json_decode($message, true);
            broadcast(new MqttMessageReceived($topic, $message));
        });

        Cache::put('mqtt:running', true);

        $this->info('Subscribed to topic: ' . $this->topic);

        while (Cache::get('mqtt:running', false)) {
            try {
                $this->mqtt->loop();
            } catch (\Exception $e) {
                $this->error('Error in MQTT loop: ' . $e->getMessage());
                Cache::put('mqtt:running', false);
            }
        }

        $this->mqtt->disconnect();
        $this->info('Disconnected from MQTT broker');
    }
}
