<?php
//
//use App\Facades\BaleBot;
//use Illuminate\Support\Facades\Http;
//
//if (isset($data['message'])) {
//            match ($data ['message']['text']) {
//                '/start' => BaleBot::sendMessage($data ['message']['chat']['id'], 'به ربات ما خوش آمدید'),
//                '/pay' => BaleBot::sendMessage($data ['message']['chat']['id'], 'با تشکر از پرداخت شما'),
//                '/crypto' => $this->getCryptoList($data ['message']['chat']['id'])
//            };
//        }
//
//        if (isset($data['callback_query'])) {
//            match ($data['callback_query']['data']) {
//               // $data['callback_query']['data'] => BaleBot::sendMessage($data['callback_query']['chat_instance'], $data['callback_query']['data']),
//                $data['callback_query']['data'] => $this->getCryptoPrice($data['callback_query']['chat_instance'],$data['callback_query']['data'])
//            };
//        }
//
//
//public function getCryptoList($chat_id)
//{
//    $response = Http::get('https://one-api.ir/DigitalCurrency', [
//        'token' => '246358:66b6007544749'
//    ]);
//
//    $items = collect($response->json()['result'])->take(6);
//
//    $buttons = [];
//    foreach ($items as $item) {
//        $buttons[][] = ['text' => $item['name'], 'callback_data' => $item['key']];
//    }
//
//    Http::post('https://tapi.bale.ai/2082724310:dLjGsp9qoJi85PEWr3vc9zL3xG9c1aofrFVrTD6F/sendMessage', [
//        'chat_id' => $chat_id,
//        'text' => 'یک ارز را انتخاب کنید',
//        'reply_markup' => json_encode([
//            'inline_keyboard' => $buttons
//        ])
//    ]);
//}
//
//public function getCryptoPrice($chat_id , $crypto)
//{
//    $response = Http::get('https://one-api.ir/DigitalCurrency', [
//        'token' => '246358:66b6007544749'
//    ]);
//
//    $item = collect($response->json()['result'])->where('key', $crypto)->first();
//
//    BaleBot::sendMessage($chat_id,(string)$item['price']);
//
//}
