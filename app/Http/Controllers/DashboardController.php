<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $orders = Order::all();
        $details = OrderDetail::all();
        $products = Product::all();
        $users = User::all();
        $categories = Category::all();
        return view('layouts.dashboard', compact('orders', 'details', 'products', 'users', 'categories'));
    }
}
