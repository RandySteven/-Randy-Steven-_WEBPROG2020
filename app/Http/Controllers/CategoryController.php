<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category){
        $products = $category->products()->latest()->paginate(12);
        $product_counts = $products->count();
        $categories = Category::all();
        return view('product.index', compact('products', 'categories', 'product_counts'));
    }
}
