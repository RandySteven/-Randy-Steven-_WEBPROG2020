<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function store(Request $request){
        $attr = $request->all();
        $attr['product_id'] = $request->get('product_id');
        $attr['photo'] = $request->file('photo')->store("images/photo");
        return back();
    }

    public function delete(Album $album){
        $album->delete($album);
        \Storage::delete($album->photo);
        return back();
    }
}
