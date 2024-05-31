<?php

namespace App\Http\Controllers;

use App\Services\MqttService;
use Illuminate\Http\Request;

class MqttController extends Controller
{
    protected $mqttService;

    public function __construct(MqttService $mqttService)
    {
        $this->mqttService = $mqttService;
    }

    public function subscribeToMqtt()
    {
        $topic = 'sensor/data';

        $this->mqttService->subscribe($topic, function ($topic, $message) {
            // Handle the incoming message
            logger()->info("Received message on topic {$topic}: {$message}");
        });
    }
}
