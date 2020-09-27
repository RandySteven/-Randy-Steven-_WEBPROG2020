<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user()->associate($request->user());
        $product = Product::find($request->product_id);
        $product->comments()->save($comment);
        return back();
    }

    public function storeReply(Request $request){
        $reply = new Comment();
        $reply->comment = $request->get('comment');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $product = Product::find($request->get('product_id'));
        $product->comments()->save($reply);
        return back();
    }
}
