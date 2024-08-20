<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSession;
use App\Services\InfluxDBService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HistoryController extends Controller
{
    protected $influxDBService;

    public function __construct(InfluxDBService $influxDBService)
    {
        $this->influxDBService = $influxDBService;
    }

    public function index()
    {
        $user = Auth::user();
        $userSessions = $user->account_type_id === 1
            ? UserSession::where('user_id', $user->id)->orderBy('id', 'asc')->paginate(10)
            : UserSession::orderBy('id', 'asc')->paginate(10);

        return view('history.index', ['UserSessions' => $userSessions]);
    }

    public function session()
    {
        return view('history.session');
    }


    public function show($id)
    {
        $user = Auth::user();
        $UserSession = UserSession::find($id);
    
        if (!$UserSession || ($UserSession->user_id !== $user->id && $user->account_type_id === 1)) {
            abort(403);
        }
    
        $datetimes1 = $UserSession->datetimes1;
    
        if (is_null($datetimes1) || empty($datetimes1)) {
            $sensorData = [];
        } else {
            $sensorData = [];
            foreach ($datetimes1 as $timestamp) {
                $data = $this->influxDBService->queryData($UserSession->id, $timestamp);
                $sensorData[] = [
                    'timestamp' => $timestamp,
                    'data' => $data
                ];
            }
        }
    
        return view('history.show', [
            'UserSession' => $UserSession,
            'sensorData' => $sensorData,
            'noCaptures' => is_null($datetimes1) || empty($datetimes1) // Added this flag for the view
        ]);
    }
}
