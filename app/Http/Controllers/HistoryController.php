<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(){
        $orders = Order::where('user_id', auth()->user()->id)->latest()->get();
        return view('layouts.history', compact('orders'));
    }

    public function show(Order $order){
        $details = OrderDetail::where('order_id', $order->id)->get();
        return view('layouts.history-detail', compact('details'));
    }
}
