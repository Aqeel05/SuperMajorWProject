<?php
/*
namespace App\Http\Controllers;

use App\Services\MqttService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class MqttController extends Controller
{
    protected $mqttService;

    public function __construct(MqttService $mqttService)
    {
        $this->mqttService = $mqttService;
    }

    public function subscribeToTopic()
    {
        $topic = 'sensor_data';
        $this->mqttService->subscribe($topic);

        return response()->json(['message' => 'Subscribed to topic.']);
    }

    public function unsubscribeFromTopic()
    {
        $topic = 'sensor_data';
        $this->mqttService->unsubscribe($topic);

        return response()->json(['message' => 'Unsubscribed from topic.']);
    }
}
