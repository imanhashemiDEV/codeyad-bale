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
                '/start' => $this->showStoreMenu($data ['message']['chat']['id']),
            };
        }

        if (isset($data['callback_query'])) {
           // Log::info($data['callback_query']['data']);
            match ($data['callback_query']['data']) {
                '/products' => $this->getProductsList($data['callback_query']['chat_instance']),
                '/cart' => $this->getUserCart($data['callback_query']['chat_instance']),
                $data['callback_query']['data'] => $this->handleCallBack($data['callback_query']['chat_instance'], $data['callback_query']['data'])
                // $data['callback_query']['data'] => BaleBot::sendMessage($data['callback_query']['chat_instance'], $data['callback_query']['data']),
            };
        }

    }

    public function showStoreMenu($chat_id)
    {
        Http::post('https://tapi.bale.ai/2082724310:dLjGsp9qoJi85PEWr3vc9zL3xG9c1aofrFVrTD6F/sendMessage', [
            'chat_id' => $chat_id,
            'text' => 'لطفا یکی از گزینه ها را انتخاب کنید',
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => 'لیست محصولات', 'callback_data' => '/products'],
                        ['text' => 'سبد خرید', 'callback_data' => '/cart'],
                    ]
                ]
            ])
        ]);
    }

    public function getProductsList($chat_id)
    {

        $products = Product::query()->get();

        $buttons = [];
        foreach ($products as $product) {
            $buttons[][] = ['text' => $product->name . ' - ' . $product->price .' '.'تومان', 'callback_data' => "/product/$product->id"];
        }

        Http::post('https://tapi.bale.ai/2082724310:dLjGsp9qoJi85PEWr3vc9zL3xG9c1aofrFVrTD6F/sendMessage', [
            'chat_id' => $chat_id,
            'text' => 'یک محصول را انتخاب کنید',
            'reply_markup' => json_encode([
                'inline_keyboard' => $buttons
            ])
        ]);
    }

    public function handleCallBack($chat_id , $data)
    {
        $array = explode('/',$data);
        $key = $array[1];
        match ($key) {
            'product' =>  $this->addToCart($chat_id , $data),
            'add' =>  $this->addToCart($chat_id , $data),
            'remove' =>  $this->removeFromCart($chat_id , $data),
        };
    }

    public function addToCart($chat_id , $data)
{
    $array = explode('/',$data);
    $id = end($array) ;
    $cart = Cart::query()->where('product_id',$id)->where('bale_user_id',$chat_id)->first();
    if ($cart) {
        $cart->increment('count');
    }else{
        Cart::query()->create([
            'bale_user_id'=>$chat_id,
            'product_id'=>$id,
            'count'=>1,
        ]);
    }

    BaleBot::sendMessage($chat_id,'محصول به سبد خرید اضافه شد');

}

    public function removeFromCart($chat_id , $data)
    {
        BaleBot::sendMessage($chat_id,'محصول از سبد خرید کم شد');
   }

    public function getUserCart($chat_id)
    {

        $carts = Cart::query()->where('bale_user_id',$chat_id)->get();

        $total_price = 0;
        $buttons = [];
        foreach ($carts as $cart) {
            $buttons[][] = ['text' => $cart->product->name . ' - ' . ($cart->product->price * $cart->count ) .' '.'تومان'];
            $buttons[] = [['text' => 'اضافه', 'callback_data' => "/add/$cart->product->id"],['text' => 'کم', 'callback_data' => "/remove/$cart->product->id"]];
            $total_price += $cart->product->price * $cart->count;
        }

        $buttons[][] = ['text' => 'قیمت کل:' . $total_price .' '.'تومان'];
        $buttons[][] = ['text' => 'پرداخت', 'callback_data' => "/pay"];

        Http::post('https://tapi.bale.ai/2082724310:dLjGsp9qoJi85PEWr3vc9zL3xG9c1aofrFVrTD6F/sendMessage', [
            'chat_id' => $chat_id,
            'text' => 'لیست سبد خرید شما',
            'reply_markup' => json_encode([
                'inline_keyboard' => $buttons
            ])
        ]);
    }


    public function sendMessage(Request $request)
    {
        BaleBot::sendMessage($request->chat_id, $request->text);
    }
}
