<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MqttMessageReceived implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $topic;
    public $message;

    /**
     * Create a new event instance.
     *
     * @param string $topic
     * @param string $message
     * @return void
     */
    public function __construct($topic, $message)
    {
        $this->topic = $topic;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn()
    {
        return new Channel('mqtt-messages');
    }

    /**
     * The data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return ['topic' => $this->topic, 'message' => $this->message];
    }
}
