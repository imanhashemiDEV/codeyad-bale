<?php

namespace App\Http\Controllers\Admin;


use App\Enums\ChatStatus;
use App\Facades\BaleBot;
use App\Http\Controllers\Controller;
use App\Livewire\Auth\Login;
use App\Models\BaleUser;
use App\Models\Cart;
use App\Models\Chat;
use App\Models\Product;
use App\Models\UserRequest;
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
                '/chat' =>$this->requestChat($data ['message']['chat']['id']),
                '/closeChat' =>$this->closeChat($data ['message']['chat']['id']),
                default =>$this->chat($data ['message']['chat']['id'], $data ['message']['text']),           };
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

    public function requestChat($chat_id)
    {
        $request = UserRequest::query()->where('bale_user_id','!=',$chat_id)->where('status',ChatStatus::Pending->value)->first();
        if($request){
//            $request->update([
//                'status'=>ChatStatus::Closed->value
//            ]);
            $active_chat = Chat::query()
                ->where('host_id',$request->bale_user_id)
                ->where('guest_id',$chat_id)
                ->where('status',ChatStatus::Started->value)
                ->first();
            if($active_chat){
                BaleBot::sendMessage($chat_id,'شما یک چت ناتمام دارید');
                BaleBot::sendMessage($chat_id,'لطفا دکمه اتمام چت را بزنید');
            }else{
                Chat::query()->create([
                    'host_id'=>$request->bale_user_id,
                    'guest_id'=>$chat_id,
                    'status'=>ChatStatus::Started->value
                ]);
                BaleBot::sendMessage($request->bale_user_id,'چت شما آغاز شد');
                BaleBot::sendMessage($chat_id,'چت شما آغاز شد');
            }

        }else{
            $exist = UserRequest::query()->where('bale_user_id',$chat_id)->where('status',ChatStatus::Pending->value)->exists();
            if($exist){
                BaleBot::sendMessage($chat_id,'شما یک چت در حال انتظار دارید');
            }else{
                UserRequest::query()->create([
                    'bale_user_id' => $chat_id,
                    'status' => ChatStatus::Pending->value,
                ]);
                BaleBot::sendMessage($chat_id,'یک درخواست چت ناشناس برای شما ایجاد شد');
                BaleBot::sendMessage($chat_id,'لطفا برای اتصال به دیگران منتظر بمانید');
            }
        }
    }

    public function chat($chat_id , $message)
    {
        $active_chat = Chat::query()
            ->where(function ($q)use($chat_id){
                $q->where('host_id',$chat_id)
                    ->orwhere('guest_id',$chat_id);
            })
            ->where('status',ChatStatus::Started->value)
            ->first();
        if($active_chat){
            if($active_chat->host_id == $chat_id){
                BaleBot::sendMessage($active_chat->guest_id,$message);
            }else{
                BaleBot::sendMessage($active_chat->host_id,$message);
            }

        }
    }

    public function closeChat($chat_id)
    {

        $active_chat = Chat::query()
            ->where(function ($q)use($chat_id){
                $q->where('host_id',$chat_id)
                    ->orwhere('guest_id',$chat_id);
            })
            ->where('status',ChatStatus::Started->value)
            ->first();

        if($active_chat){
            $active_chat->update([
                'status'=>ChatStatus::Closed->value
            ]);
        }


        $request = UserRequest::query()
            ->where(function ($q) use($active_chat){
                $q->where('bale_user_id',$active_chat->host_id)
                    ->orwhere('bale_user_id',$active_chat->guest_id);
            })
            ->where('status',ChatStatus::Pending->value)
            ->first();
        if($request){
            $request->update([
                'status'=>ChatStatus::Closed->value
            ]);
        }

        BaleBot::sendMessage($active_chat->host_id, 'چت شما به پایان رسید');
        BaleBot::sendMessage($active_chat->guest_id, 'چت شما به پایان رسید');


    }

    public function sendMessage(Request $request)
    {
        BaleBot::sendMessage($request->chat_id, $request->text);
    }
}
