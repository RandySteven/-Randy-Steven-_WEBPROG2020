<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Jobs\ProcessMail;
use App\Mail\OrderTransaction;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{
    public function store(){
        $carts = Cart::where('user_id', auth()->user()->id);
        $cartUser = $carts->get();
        $order = Order::create([
            'user_id' => Auth::user()->id,
        ]);
        foreach($cartUser as $cart){
            $order->details()->create([
                'product_id' => $cart->product->id,
                'qty' => $cart->qty
            ]);
            $product = Product::where('id', $cart->product->id);

            if($product->first()->id == $cart->product->id){
                $product->decrement('stock', $cart->qty);
            }
        }

        $carts->delete();
        Mail::to(Auth::user()->email)->send(new OrderTransaction($cartUser));
        // ProcessMail::dispatch($mails)->onQueue('processing')->delay(now()->addSeconds(3));
        return redirect('/');
    }
}
