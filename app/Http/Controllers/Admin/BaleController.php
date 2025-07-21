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
       // Log::info($data ['message']['text']);
       // Log::info($data ['message']['chat']['id']);
       // BaleBot::sendMessage($data ['message']['chat']['id'], $data ['message']['text']);
       // Log::info($data['callback_query']['data']);

        if(isset($data['callback_query'])){
            match ($data['callback_query']['data']) {
                'save'=>  BaleBot::sendMessage(665975322,'روی دکمه ذخیره کلیک شد'),
            };
        }

        if(isset($data['message'])){
         match ($data ['message']['text']) {
             '/start'=> BaleBot::sendMessage($data ['message']['chat']['id'], 'به ربات ما خوش آمدید'),
             '/pay'=>  BaleBot::sendMessage($data ['message']['chat']['id'], 'با تشکر از پرداخت شما'),
             'inline'=>  BaleBot::sendInlineButtonMessage(665975322,'روی دکمه کلیک کن'),
         };
        }


    }

    public function sendMessage(Request $request)
    {
        BaleBot::sendMessage($request->chat_id, $request->text);
    }
}
