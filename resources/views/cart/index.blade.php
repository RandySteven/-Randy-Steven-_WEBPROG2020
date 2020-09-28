@extends('layouts.app')

@section('title', 'Cart')

@section('content')
@php
    $total = 0;
@endphp
    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
        @if ($carts->count()==0)
            <h3>There are no item in your cart</h3>
        @endif
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Desc</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                @if (Auth::user()->id == $cart->user->id)
                <tr>
                    <td><img src="{{ asset('/storage/'.$cart->product->thumbnail) }}" style="width: 55%; height: 55%" alt=""></td>
                    <td>{{ $cart->product->name }}</td>
                    <td>{{ Str::limit($cart->product->description, 130, '...') }}</td>
                    <td>Rp.{{ number_format($cart->product->price) }},00</td>
                    <td>{{ $cart->qty }}</td>
                    <td>Rp.{{ number_format($cart->product->price * $cart->qty) }},00</td>
                    <td>
                        <form action="{{ route('cart.delete', $cart->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                    </td>
                </tr>
                    @php
                         $total += $cart->product->price * $cart->qty ;
                    @endphp
                @endif
                @endforeach

            </tbody>
        </table>
        <div class="container text-left">
              @if ($carts->count()!=0)
              <form action="{{ route('transaction') }}" method="POST">
                  @csrf
                    <div class="form-group">
                        <label for="">Address</label>
                        <textarea name="address" id="" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Post Number</label>
                        <input type="text" name="post_number" id="">
                    </div>
                    <button type="submit" class="btn btn-danger">
                        Buy
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                            <path fill-rule="evenodd" d="M8.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                    </button>
              </form>
              @endif
        </div>
        <div class="container text-right">
               Total Price
               <strong>
                    Rp.{{ number_format($total) }},00
               </strong>
        </div>



        </div>

@endsection
