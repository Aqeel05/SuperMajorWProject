<?php
namespace App\Jobs;

use App\Services\MqttService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MqttSubscribeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $topic;
    protected $tags;
    protected $mqttService;

    public function __construct($topic, $tags)
    {
        $this->topic = $topic;
        $this->tags = $tags;

        $this->mqttService = app(MqttService::class);
    }

    public function handle()
    {
        $this->mqttService->subscribe($this->topic, $this->tags);
    }
}
