<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'stock', 'thumbnail', 'user_id', 'category_id', 'description', 'slug'
    ];

    public function getTakeImageAttribute(){
        return "/storage/".$this->thumbnail;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
