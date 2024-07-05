<?php

namespace App\Http\Controllers;

use App\Jobs\ManageMqttSubscription;

class MqttController extends Controller
{
    public function index()
    {
        return view('mqtt.index');
    }

    public function subscribe()
    {
        ManageMqttSubscription::dispatch('subscribe');
        return response()->json(['message' => 'Subscribed to MQTT topic']);
    }

    public function unsubscribe()
    {
        ManageMqttSubscription::dispatch('unsubscribe');
        return response()->json(['message' => 'Unsubscribed from MQTT topic']);
    }
}
