<?php

namespace App\Http\Controllers\Admin;


use App\Facades\BaleBot;
use App\Http\Controllers\Controller;
use App\Livewire\Auth\Login;
use App\Models\BaleUser;
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
                '/start' => $this->showStoreMenu($data ['message']['chat']['id']),
            };
        }

    }

    public function showStoreMenu($chat_id)
    {
        Http::post('https://tapi.bale.ai/2082724310:dLjGsp9qoJi85PEWr3vc9zL3xG9c1aofrFVrTD6F/sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>'لطفا یکی از گزینه ها را انتخاب کنید',
            'reply_markup'=> json_encode([
                'inline_keyboard'=>[
                    [
                        ['text'=>'لیست محصولات', 'callback_data'=>'products'],
                        ['text'=>'سبد خرید', 'callback_data'=>'cart'],
                    ]
                ]
            ])
        ]);
    }



    public function sendMessage(Request $request)
    {
        BaleBot::sendMessage($request->chat_id, $request->text);
    }
}
