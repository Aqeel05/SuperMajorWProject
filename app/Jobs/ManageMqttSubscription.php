<?php

namespace App\Jobs;

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use App\Events\MqttMessageReceived;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ManageMqttSubscription implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $action;
    protected $topic = 'sensor_data';

    public function __construct($action)
    {
        $this->action = $action;
    }

    public function handle()
    {
        try {
            $server = env('MQTT_SERVER', 'test.mosquitto.org');
            $port = env('MQTT_PORT', 1883);
            $clientId = env('MQTT_CLIENT_ID', 'laravel_client');
            $username = env('MQTT_USERNAME', null);
            $password = env('MQTT_PASSWORD', null);

            Log::info("MQTT Server: $server, Port: $port, Client ID: $clientId");

            $connectionSettings = new ConnectionSettings();
            if ($username !== null && $password !== null) {
                $connectionSettings->setUsername($username)
                                   ->setPassword($password);
            }

            $mqtt = new MqttClient($server, $port, $clientId);

            try {
                $mqtt->connect($connectionSettings, true);
            } catch (\Exception $e) {
                Log::error('Could not connect to the MQTT broker: ' . $e->getMessage());
                return;
            }

            Log::info('Connected to MQTT broker');

            if ($this->action == 'subscribe') {
                Cache::put('mqtt:running', true);
                $mqtt->subscribe($this->topic, function (string $topic, string $message) {
                    $data = json_decode($message, true);
                    broadcast(new MqttMessageReceived($topic, $message));
                });

                Log::info('Subscribed to topic: ' . $this->topic);

                while (Cache::get('mqtt:running', false)) {
                    try {
                        $mqtt->loop();
                    } catch (\Exception $e) {
                        Log::error('Error in MQTT loop: ' . $e->getMessage());
                        Cache::put('mqtt:running', false);
                    }
                }

                $mqtt->disconnect();
                Log::info('Disconnected from MQTT broker');
            } else if ($this->action == 'unsubscribe') {
                Cache::put('mqtt:running', false);
                Log::info('Unsubscribed from MQTT topic');
            }
        } catch (\Exception $e) {
            Log::error('Error in ManageMqttSubscription job: ' . $e->getMessage());
        }
    }
}
