<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class MqttServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(MqttClient::class, function ($app) {
            $server   = env('MQTT_SERVER', 'test.mosquitto.org');
            $port     = env('MQTT_PORT', 1883);
            $clientId = env('MQTT_CLIENT_ID', 'laravel_client');
            $username = env('MQTT_USERNAME', null);
            $password = env('MQTT_PASSWORD', null);

            $connectionSettings = new ConnectionSettings();
            if ($username !== null && $password !== null) {
                $connectionSettings->setUsername($username)
                                   ->setPassword($password);
            }

            $mqtt = new MqttClient($server, $port, $clientId);
            $mqtt->connect($connectionSettings);

            return $mqtt;
        });
    }

    public function boot()
    {
        //
    }
}
