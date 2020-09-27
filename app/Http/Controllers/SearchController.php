<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(){
        $query = request('query');
        $categories = Category::all();
        $products = Product::where('name', 'LIKE', '%'.$query.'%')->latest()->paginate(12);
        $product_counts = $products->count();
        return view('product.index', compact('products', 'categories', 'product_counts'));
    }
}
