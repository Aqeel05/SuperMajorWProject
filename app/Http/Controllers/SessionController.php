<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SessionRecord;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function show($id)
    {
        $session = SessionRecord::where('user_id', Auth::id())->findOrFail($id);
        return view('session-details', compact('session'));
    }

    public function destroy($id)
    {
        $session = SessionRecord::where('user_id', Auth::id())->find($id);
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
        $SessionRecord = SessionRecord::where('user_id', $user->id)->latest()->first();

        if ($SessionRecord && count($SessionRecord->datetimes) < 2) {
            // Update the existing session
            $datetimes = $SessionRecord->datetimes;
            if (count($datetimes) < 1) {
                $datetimes[] = now()->toISOString();
                $SessionRecord->datetimes = $datetimes;
                $SessionRecord->save();
            }
        } else {
            // Create a new session
            $SessionRecord = SessionRecord::create([
                'user_id' => $user->id,
                'datetimes' => [now()->toISOString()]
            ]);
        }

        return response()->json(['success' => true, 'datetimes' => $SessionRecord->datetimes]);
    }

    public function stopSession(Request $request)
    {
        $user = Auth::user();
        $SessionRecord = SessionRecord::where('user_id', $user->id)->latest()->first();

        if ($SessionRecord) {
            $datetimes = $SessionRecord->datetimes;

            if (count($datetimes) == 1) {
                $datetimes[] = now()->toISOString();
                $SessionRecord->datetimes = $datetimes;
                $SessionRecord->save();
            }

            return response()->json(['success' => true, 'datetimes' => $datetimes]);
        }

        return response()->json(['success' => false, 'message' => 'Session not started']);
    }
}
