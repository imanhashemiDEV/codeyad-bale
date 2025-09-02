<?php

namespace App\Http\Controllers\Admin;


use App\Facades\BaleBot;
use App\Http\Controllers\Controller;
use App\Livewire\Auth\Login;
use App\Models\BaleUser;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BaleController extends Controller
{
    public function bale(Request $request)
    {
        $data = $request->all();

        if (isset($data['message'])) {
            match ($data ['message']['text']) {
                '/start' => $this->sayHello($data ['message']['chat']['id']),
            };
        }

//        if (isset($data['callback_query'])) {
//           // Log::info($data['callback_query']['data']);
//            match ($data['callback_query']['data']) {
//                '/products' => $this->getProductsList($data['callback_query']['chat_instance']),
//                '/cart' => $this->getUserCart($data['callback_query']['chat_instance']),
//                $data['callback_query']['data'] => $this->handleCallBack($data['callback_query']['chat_instance'], $data['callback_query']['data'])
//                // $data['callback_query']['data'] => BaleBot::sendMessage($data['callback_query']['chat_instance'], $data['callback_query']['data']),
//            };
//        }

    }

    public function sayHello($chat_id)
    {
        BaleBot::sendMessage($chat_id,'به ربات چت ناشناس خوش آمدید');
    }



    public function sendMessage(Request $request)
    {
        BaleBot::sendMessage($request->chat_id, $request->text);
    }
}
