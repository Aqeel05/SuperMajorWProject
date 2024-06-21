<?php

namespace App\Services;

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\Exceptions\MqttClientException;
use Illuminate\Support\Facades\Log;
use App\Events\MqttMessageReceived;

class MqttService
{
    protected $server;
    protected $port;
    protected $clientId;
    protected $mqttClient;
    protected $influxDBService;
    protected $receivedMessages = [];
    protected $running = false;

    public function __construct(InfluxDBService $influxDBService)
    {
        $this->server = env('MQTT_SERVER', 'test.mosquitto.org');
        $this->port = env('MQTT_PORT', 1883);
        $this->clientId = env('MQTT_CLIENT_ID', uniqid());
        $this->influxDBService = $influxDBService;
    }

    public function subscribe($topic)
    {
        try {
            $this->mqttClient = new MqttClient($this->server, $this->port, $this->clientId);
            $this->mqttClient->connect();
            $this->running = true;

            $this->mqttClient->subscribe($topic, function ($topic, $message) {
                $data = json_decode($message, true);
                $this->receivedMessages[] = [
                    'topic' => $topic,
                    'message' => $message,
                ];

                // Write data to InfluxDB
                $tags = ['topic' => $topic];
                $fields = $data;
                $this->influxDBService->writeData('sensor_data', $tags, $fields);

                // Broadcast the message
                broadcast(new MqttMessageReceived($data));
            }, 0);

            // Loop to keep the subscription active
            while ($this->running) {
                $this->mqttClient->loop(true);
            }
        } catch (MqttClientException $e) {
            Log::error('MQTT Subscription Error: ' . $e->getMessage(), ['exception' => $e]);
        } catch (\Exception $e) {
            Log::error('General Error: ' . $e->getMessage(), ['exception' => $e]);
        }
    }

    public function unsubscribe($topic)
    {
        try {
            $this->running = false;
            if ($this->mqttClient) {
                $this->mqttClient->unsubscribe($topic);
                $this->mqttClient->disconnect();
            }
        } catch (MqttClientException $e) {
            Log::error('MQTT Unsubscribe Error: ' . $e->getMessage(), ['exception' => $e]);
        } catch (\Exception $e) {
            Log::error('General Error: ' . $e->getMessage(), ['exception' => $e]);
        }
    }

    public function disconnect()
    {
        try {
            if ($this->mqttClient) {
                $this->mqttClient->disconnect();
                $this->mqttClient = null;
            }
        } catch (MqttClientException $e) {
            Log::error('MQTT Disconnect Error: ' . $e->getMessage(), ['exception' => $e]);
        } catch (\Exception $e) {
            Log::error('General Error: ' . $e->getMessage(), ['exception' => $e]);
        }
    }

    public function getMessages()
    {
        return $this->receivedMessages;
    }
}
