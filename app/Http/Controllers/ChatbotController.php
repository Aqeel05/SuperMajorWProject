<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    //
    public function index()
    {
        return view('chatbot.index');
    }

    public function show()
    {
        return view('chatbot.show');
    }
}
