<?php

namespace App\Http\Controllers;

use App\Services\InfluxDBService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    protected $influxDBService;

    public function __construct(InfluxDBService $influxDBService)
    {
        $this->influxDBService = $influxDBService;
    }

    public function index()
    {
        return view('analytics.index');
    }

    public function mqttSend()
    {
        return view('analytics.sending');
    }


    public function send()
    {
        return view('analytics.send');
    }

}
