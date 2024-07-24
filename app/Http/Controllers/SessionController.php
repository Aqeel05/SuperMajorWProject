<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSession;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function show($id)
    {
        $session = UserSession::where('user_id', Auth::id())->findOrFail($id);
        return view('session-details', compact('session'));
    }

    public function destroy($id)
    {
        $session = UserSession::where('user_id', Auth::id())->find($id);
        if ($session) {
            $session->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }    

    public function startSession(Request $request)
    {
        $user = Auth::user();

        // Check if there's an ongoing session that has not been stopped
        $userSession = UserSession::where('user_id', $user->id)->latest()->first();

        if ($userSession && count($userSession->datetimes) < 2) {
            // Update the existing session
            $datetimes = $userSession->datetimes;
            if (count($datetimes) < 1) {
                $datetimes[] = now()->toISOString();
                $userSession->datetimes = $datetimes;
                $userSession->save();
            }
        } else {
            // Create a new session
            $userSession = UserSession::create([
                'user_id' => $user->id,
                'datetimes' => [now()->toISOString()]
            ]);
        }

        return response()->json(['success' => true, 'datetimes' => $userSession->datetimes]);
    }

    public function stopSession(Request $request)
    {
        $user = Auth::user();
        $userSession = UserSession::where('user_id', $user->id)->latest()->first();

        if ($userSession) {
            $datetimes = $userSession->datetimes;

            if (count($datetimes) == 1) {
                $datetimes[] = now()->toISOString();
                $userSession->datetimes = $datetimes;
                $userSession->save();
            }

            return response()->json(['success' => true, 'datetimes' => $datetimes]);
        }

        return response()->json(['success' => false, 'message' => 'Session not started']);
    }
}
