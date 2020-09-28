<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request, User $user){
        $request->validate([
            'address' => 'required',
            'post_code' => 'required|numeric'
        ]);
        $user->update([
            'address' => $request->address,
            'post_code' => $request->post_code,
        ]);
        return back();
    }

    public function edit(User $user){
        return view('cart.index', compact('user'));
    }
}
