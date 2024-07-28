<?php
// app/Http/Controllers/HistoryController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PressureSession;
use Illuminate\Support\Facades\Auth;

// This controller has been renamed from HistoryController because having 2 controllers for 1 group of pages is cumbersome
class PressureSessionController extends Controller
{
    public function index()
    {
        if (request()->user()->account_type_id === 1) {
            $pressureSessions = PressureSession::query()
            ->where('user_id', request()->user()->id)
            ->orderBy('id', 'asc')
            ->paginate(10);
        }
        elseif (request()->user()->account_type_id === 2) {
            $pressureSessions = PressureSession::query()
            ->orderBy('id', 'asc')
            ->paginate(10);
        }
        return view('pressureSessions.index', ['pressureSessions' => $pressureSessions]);
    }

    /**
     * Show the user's pressure session.
     * Patients and staff may perform this action.
     */
    public function show(PressureSession $pressureSession)
    {
        if ($pressureSession->user_id !== request()->user()->id && request()->user()->account_type_id === 1) {
            abort(403);
        }
        return view('pressureSessions.show', ['pressureSession' => $pressureSession]);
    }

    /**
     * Remove the specified pressure session from storage.
     * Patients and staff may perform this action.
     */
    public function destroy(PressureSession $pressureSession)
    {
        if ($pressureSession->user_id !== request()->user()->id && request()->user()->account_type_id === 1) {
            abort(403);
        }
        $pressureSession->delete();
        return to_route('pressureSessions.index')->with('message', 'Pressure session was deleted');
    }   
    
    /**
     * Start a user's pressure session.
     */
    public function startSession(Request $request)
    {
        $user = Auth::user();

        // Check if there's an ongoing session that has not been stopped
        $pressureSession = PressureSession::where('user_id', $user->id)->latest()->first();

        if ($pressureSession && count($pressureSession->datetimes) < 2) {
            // Update the existing session
            $datetimes = $pressureSession->datetimes;
            if (count($datetimes) < 1) {
                $datetimes[] = now()->toISOString();
                $pressureSession->datetimes = $datetimes;
                $pressureSession->save();
            }
        } else {
            // Create a new session
            $pressureSession = PressureSession::create([
                'user_id' => $user->id,
                'datetimes' => [now()->toISOString()]
            ]);
        }

        return response()->json(['success' => true, 'datetimes' => $pressureSession->datetimes]);
    }

    /**
     * Stop a user's pressure session.
     */
    public function stopSession(Request $request)
    {
        $user = Auth::user();
        $pressureSession = PressureSession::where('user_id', $user->id)->latest()->first();

        if ($pressureSession) {
            $datetimes = $pressureSession->datetimes;

            if (count($datetimes) == 1) {
                $datetimes[] = now()->toISOString();
                $pressureSession->datetimes = $datetimes;
                $pressureSession->save();
            }

            return response()->json(['success' => true, 'datetimes' => $datetimes]);
        }

        return response()->json(['success' => false, 'message' => 'Session not started']);
    }
}
