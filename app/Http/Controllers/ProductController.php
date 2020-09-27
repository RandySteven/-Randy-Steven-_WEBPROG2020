<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::latest()->paginate(12);
        $product_counts = Product::count();
        $categories = Category::all();
        return view('product.index', compact('products', 'categories', 'product_counts'));
    }

    public function create(){
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'thumbnail' => 'image|mimes:png,jpg,jpeg|max:2048',
            'name' => 'required|min:5|max:80',
            'price' => 'required|integer',
            'description' => 'required',
            'stock' => 'required|integer'
        ]);

        $attr = $request->all();
        $thumbnail = $request->file('thumbnail')->store("images/product");
        $attr['slug'] = \Str::slug($request->name);
        $attr['thumbnail'] = $thumbnail;
        $attr['category_id'] = $request->get('category');

        auth()->user()->products()->create($attr);

        return redirect('/');
    }

    public function show(Product $product){
        return view('product.show', compact('product'));
    }

    public function edit(Product $product){
        $categories = Category::all();
        return view('product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product){
        $this->authorize('update', $product);
        $attr = $request->all();
        if($request->thumbnail){
            \Storage::delete($product->thumbnail);
            $thumbnail = $request->file('thumbnail')->store("images/product");
        }else{
            $thumbnail = $product->thumbnail;
        }
        $attr['slug'] = \Str::slug($request->name);
        $attr['thumbnail'] = $thumbnail;
        $attr['category_id'] = $request->get('category');
        $product->update($attr);
        return redirect('/');
    }

    public function delete(Product $product){
        $this->authorize('delete', $product);
        $product->delete($product);
        \Storage::delete($product->thumbnail);
        return redirect('/');
    }
}
