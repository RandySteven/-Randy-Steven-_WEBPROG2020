<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(){
        $product_thumbnails = Product::take(3)->get();
        $product_reviews = Product::take(6)->get();
        $categories = Category::all();
        return view('layouts.landing', compact('product_thumbnails', 'product_reviews', 'categories'));
    }
}
