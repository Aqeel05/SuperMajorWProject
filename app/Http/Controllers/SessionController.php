<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSession;
use Illuminate\Support\Facades\Auth;

// This is the pressure sessions controller, not the HTTP sessions controller. Please do not mistake the two.
class SessionController extends Controller
{
    /**
     * Show the user's pressure session.
     */
    public function show($id)
    {
        $session = UserSession::where('user_id', Auth::id())->findOrFail($id);
        return view('session-details', compact('session'));
    }

    /**
     * Delete a user's pressure session.
     */
    public function destroy($id)
    {
        $session = UserSession::where('user_id', Auth::id())->find($id);
        if ($session) {
            $session->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
    
    /**
     * Start a user's pressure session.
     */
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

    /**
     * Stop a user's pressure session.
     */
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
