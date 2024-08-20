<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Services\InfluxDBService;

class SessionController extends Controller
{
    protected $influxDBService;

    public function __construct(InfluxDBService $influxDBService)
    {
        $this->influxDBService = $influxDBService;
    }

    public function show(UserSession $UserSession)
    {
        $user = Auth::user();
        if ($UserSession->user_id !== $user->id && $user->account_type_id === 1) {
            abort(403);
        }
        return view('history.show', ['UserSession' => $UserSession]);
    }

    public function startSession(Request $request)
    {
        $timestamp = $request->input('timestamp');
        $userId = auth()->id();

        try {
            // Retrieve the latest session ID from InfluxDB
            $latestSessionId = $this->influxDBService->getLatestSessionId();
            $currentSessionId = $latestSessionId !== null ? $latestSessionId + 1 : 1;

            // Create a new session in MySQL
            $session = UserSession::create([
                'datetimes' => [$timestamp],
                'user_id' => $userId
            ]);

            return response()->json([
                'success' => true,
                'session_id' => $currentSessionId,
                'datetimes' => $session->datetimes
            ]);
        } catch (\Exception $e) {
            Log::error('Error starting session: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error starting session: ' . $e->getMessage()
            ], 500);
        }
    }

    public function stopSession(Request $request)
    {
        $user = Auth::user();
        $timestamp = $request->input('timestamp');

        // Find the latest session for the user
        $UserSession = UserSession::where('user_id', $user->id)->latest()->first();

        if ($UserSession) {
            // Append the stop timestamp to the existing datetimes array
            $datetimes = $UserSession->datetimes;
            $datetimes[] = $timestamp;
            $UserSession->datetimes = $datetimes;
            $UserSession->save();

            return response()->json(['success' => true, 'session_id' => $UserSession->id, 'datetimes' => $UserSession->datetimes]);
        }

        return response()->json(['success' => false, 'message' => 'No session found to stop']);
    }

    public function destroy($id)
    {
        $session = UserSession::find($id);
        if ($session) {
            // Delete the session from MySQL
            $session->delete();

            // Delete corresponding data from InfluxDB
            try {
                $measurement = 'sensor_data'; 
                $this->influxDBService->deleteData($measurement, $id);
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                \Log::error('Error deleting session data from InfluxDB: ' . $e->getMessage());
                return response()->json(['success' => false, 'message' => 'Error deleting session data from InfluxDB'], 500);
            }
        }

        return response()->json(['success' => false, 'message' => 'Session not found'], 404);
    }

    public function saveCapture(Request $request)
    {
        try {
            $session = UserSession::findOrFail($request->session_id);
            $datetimes1 = $session->datetimes1 ?? [];
            $datetimes1[] = $request->timestamp;
            $session->update(['datetimes1' => $datetimes1]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Error saving capture: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error saving capture'], 500);
        }
    }

    public function captureTimestamp(Request $request)
    {
        $sessionId = $request->input('session_id');
        $timestamp = $request->input('timestamp');
    
        $session = UserSession::find($sessionId);
    
        if (!$session) {
            return response()->json(['success' => false, 'message' => 'Session not found'], 404);
        }
    
        $session->datetimes[] = $timestamp;
        $session->save();
    
        return response()->json(['success' => true, 'datetimes' => $session->datetimes]);
    }
}
