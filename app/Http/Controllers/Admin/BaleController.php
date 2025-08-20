<?php

namespace App\Http\Controllers\Admin;


use App\Facades\BaleBot;
use App\Http\Controllers\Controller;
use App\Livewire\Auth\Login;
use App\Models\BaleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
        // BaleBot::sendPhoto($data ['message']['chat']['id'], $data ['message']['from']['id'],'665975322:6630598287524830977:0:eb28410524568edad1b74b011b1141e4');
        // BaleBot::forwardMessage($data ['message']['chat']['id'], $data ['message']['from']['id'],$data ['message']['message_id']);
        // Log::info(json_encode($data));
        // BaleBot::sendMessage($data ['message']['chat']['id'], $data ['message']['text']);
        // BaleBot::sendReplyButtonMessage($data ['message']['chat']['id'], $data ['message']['text']);

//        if(isset($data['callback_query'])){
//            match ($data['callback_query']['data']) {
//                'save'=>  BaleBot::sendMessage($data['callback_query']['chat_instance'],'روی دکمه ذخیره کلیک شد'),
//            };
//        }
//
//        if(isset($data['message'])){
//         match ($data ['message']['text']) {
//             '/start'=> BaleBot::sendReplyButtonMessage($data ['message']['chat']['id'], 'به ربات ما خوش آمدید'),
//             '/pay'=>  BaleBot::sendMessage($data ['message']['chat']['id'], 'با تشکر از پرداخت شما'),
//             'inline'=>  BaleBot::sendInlineButtonMessage(665975322,'روی دکمه کلیک کن'),
//             default => BaleBot::sendMessage($data ['message']['chat']['id'],$data ['message']['text'] ),
//         };
//        }

//        if(isset($data ['message']['chat']['type']) && $data ['message']['chat']['type'] == 'private'){
//            if(!BaleUser::query()->where('bale_id', $data['message']['from']['id'])->exists()){
//                BaleUser::query()->create([
//                    'bale_id' => $data['message']['from']['id'],
//                    'first_name' => $data['message']['from']['first_name'],
//                ]);
//
//                BaleBot::sendMessage($data ['message']['chat']['id'], 'کاربر جدید ذخیره شد');
//            }
//        }


        if (isset($data['message'])) {
            match ($data ['message']['text']) {
                '/start' => BaleBot::sendMessage($data ['message']['chat']['id'], 'به ربات ما خوش آمدید'),
                '/pay' => BaleBot::sendMessage($data ['message']['chat']['id'], 'با تشکر از پرداخت شما'),
                '/crypto' => $this->getCryptoList($data ['message']['chat']['id'])
            };
        }

        if (isset($data['callback_query'])) {
            match ($data['callback_query']['data']) {
               // $data['callback_query']['data'] => BaleBot::sendMessage($data['callback_query']['chat_instance'], $data['callback_query']['data']),
                $data['callback_query']['data'] => $this->getCryptoPrice($data['callback_query']['chat_instance'],$data['callback_query']['data'])
            };
        }
    }

    public function getCryptoList($chat_id)
    {
        $response = Http::get('https://one-api.ir/DigitalCurrency', [
            'token' => '246358:66b6007544749'
        ]);

        $items = collect($response->json()['result'])->take(6);

        $buttons = [];
        foreach ($items as $item) {
            $buttons[][] = ['text' => $item['name'], 'callback_data' => $item['key']];
        }

        Http::post('https://tapi.bale.ai/2082724310:dLjGsp9qoJi85PEWr3vc9zL3xG9c1aofrFVrTD6F/sendMessage', [
            'chat_id' => $chat_id,
            'text' => 'یک ارز را انتخاب کنید',
            'reply_markup' => json_encode([
                'inline_keyboard' => $buttons
            ])
        ]);
    }

    public function getCryptoPrice($chat_id , $crypto)
    {
        $response = Http::get('https://one-api.ir/DigitalCurrency', [
            'token' => '246358:66b6007544749'
        ]);

        $item = collect($response->json()['result'])->where('key', $crypto)->first();

        BaleBot::sendMessage($chat_id,(string)$item['price']);

    }

    public function sendMessage(Request $request)
    {
        BaleBot::sendMessage($request->chat_id, $request->text);
    }
}
