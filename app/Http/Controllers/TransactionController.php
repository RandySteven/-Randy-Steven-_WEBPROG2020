<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Jobs\ProcessMail;
use App\Mail\OrderTransaction;
use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{
    public function store(Request $request){
        $carts = Cart::where('user_id', auth()->user()->id);
        $cartUser = $carts->get();
        $request->validate([
            'address' => 'required|min:10|max:100',
            'post_number' => 'required|numeric|min:5|'
        ]);

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'address' => $request->address,
            'post_number' => $request->post_number,
            'invoice' => strtoupper('PG'.date('Y').random_int(0,9).random_int(0,9).random_int(0,9).$request->address[strlen($request->address)-1])
        ]);

        foreach($cartUser as $cart){
            $order->details()->create([
                'product_id' => $cart->product->id,
                'qty' => $cart->qty,
            ]);
            $product = Product::where('id', $cart->product->id);

            if($product->first()->id == $cart->product->id){
                if($product->first()->stock < $cart->qty){
                    return back()->with('error', 'Quantiti harus kurang dari stok barang');
                }else{
                    $product->decrement('stock', $cart->qty);
                }
            }
        }
        $carts->delete();
        Mail::to(Auth::user()->email)->send(new OrderTransaction($cartUser, $order));
        // ProcessMail::dispatch($mails)->onQueue('processing')->delay(now()->addSeconds(3));
        return redirect('/products')->with('success', 'Transaksi berhasil dilakukan');
    }
}
