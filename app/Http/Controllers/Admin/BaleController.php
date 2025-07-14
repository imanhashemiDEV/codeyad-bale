<?php

namespace App\Http\Controllers\Admin;


use App\Facades\BaleBot;
use App\Http\Controllers\Controller;
use App\Livewire\Auth\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BaleController extends Controller
{
    public function bale(Request $request)
    {
        $data = $request->all();
        Log::info($data ['message']['text']);
        Log::info($data ['message']['chat']['id']);

        BaleBot::sendMessage($data ['message']['chat']['id'], $data ['message']['text']);
    }

    public function sendMessage(Request $request)
    {
        BaleBot::sendMessage($request->chat_id, $request->text);
    }
}
