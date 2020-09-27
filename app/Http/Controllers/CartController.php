<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'qty' => 'required|numeric|'
        ]);
        $duplicate = Cart::where('product_id', $request->product_id)->first();

        if($duplicate){
            return redirect('/cart')->with('error', 'Item sudah ada');
        }

        $attr = $request->all();
        $attr['product_id'] = $request->get('product_id');

        auth()->user()->carts()->create($attr);
        return redirect('/cart')->with('success', 'Item berhasil masuk ke keranjang');
    }

    public function index(){
        $carts = Cart::all();
        return view('cart.index', compact('carts'));
    }

    public function delete(Cart $cart){
        $cart->delete($cart);
        return back();
    }
}
