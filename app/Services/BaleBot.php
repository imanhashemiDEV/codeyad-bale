<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BaleBot
{
    public function getUpdates(): void
    {
        Http::get('https://tapi.bale.ai/2082724310:dLjGsp9qoJi85PEWr3vc9zL3xG9c1aofrFVrTD6F/getUpdates');
    }

    public function sendMessage($chat_id, $text): void
    {
       Http::post('https://tapi.bale.ai/2082724310:dLjGsp9qoJi85PEWr3vc9zL3xG9c1aofrFVrTD6F/sendMessage',[
           'chat_id'=>$chat_id,
           'text'=>$text,
       ]);
    }

    public function forwardMessage($chat_id, $from_chat_id,$message_id): void
    {
        Http::post('https://tapi.bale.ai/2082724310:dLjGsp9qoJi85PEWr3vc9zL3xG9c1aofrFVrTD6F/forwardMessage',[
            'chat_id'=>$chat_id,
            'from_chat_id'=>$from_chat_id,
            'message_id'=>$message_id,
        ]);
    }

    public function sendPhoto($chat_id,$from_chat_id, $photo): void
    {
        Http::post('https://tapi.bale.ai/2082724310:dLjGsp9qoJi85PEWr3vc9zL3xG9c1aofrFVrTD6F/sendPhoto',[
            'chat_id'=>$chat_id,
            'from_chat_id'=>$from_chat_id,
            'photo'=>$photo,
        ]);
    }

    public function sendInlineButtonMessage($chat_id, $text): void
    {
        Http::post('https://tapi.bale.ai/2082724310:dLjGsp9qoJi85PEWr3vc9zL3xG9c1aofrFVrTD6F/sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>$text,
            'reply_markup'=> json_encode([
                'inline_keyboard'=>[
                    [
                        [
                            'text'=>'ذخیره',
                            'callback_data'=>'save',
                        ]
                    ]
                ]
            ])
        ]);
    }

    public function sendReplyButtonMessage($chat_id, $text): void
    {
        Http::post('https://tapi.bale.ai/2082724310:dLjGsp9qoJi85PEWr3vc9zL3xG9c1aofrFVrTD6F/sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>$text,
            'reply_markup'=> json_encode([
                'keyboard'=>[
                    [ 'سلام','حال شما چطوره'],
                    ['خداحافظ']
                ],
                'resize_keyboard'=>true,
            ])
        ]);
    }

}
