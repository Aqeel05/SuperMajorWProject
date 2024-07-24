<?php
// app/Http/Controllers/HistoryController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSession;

class HistoryController extends Controller
{
    public function index()
    {
        $sessions = UserSession::all();
        return view('history.index', compact('sessions'));
    }
}
