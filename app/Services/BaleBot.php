<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BaleBot
{
    public function getUpdates()
    {
        return 'updates';
    }

    public function sendMessage($chat_id, $text): void
    {
       Http::post('https://tapi.bale.ai/2082724310:dLjGsp9qoJi85PEWr3vc9zL3xG9c1aofrFVrTD6F/sendMessage',[
           'chat_id'=>$chat_id,
           'text'=>$text,
       ]);
    }
}
