<?php

namespace App\Services;

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\Exceptions\MqttClientException;

class MqttService
{
    protected $server;
    protected $port;
    protected $clientId;
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->server = env('MQTT_SERVER', 'test.mosquitto.org');
        $this->port = env('MQTT_PORT', 1883);
        $this->clientId = env('MQTT_CLIENT_ID', 'laravel_client');
        $this->username = env('MQTT_USERNAME', '');
        $this->password = env('MQTT_PASSWORD', '');
    }

    public function subscribe($topic, $callback)
    {
        try {
            $mqtt = new MqttClient($this->server, $this->port, $this->clientId);

            $mqtt->connect($this->username, $this->password);

            $mqtt->subscribe($topic, $callback, 0);

            // Keep the client connected to receive messages
            while ($mqtt->loop()) {
                // Loop to keep the connection open
            }

            $mqtt->disconnect();
        } catch (MqttClientException $e) {
            // Handle the exception
            logger()->error('MQTT Subscription Error: ' . $e->getMessage());
        }
    }
}
