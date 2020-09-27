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
                  <button type="submit" class="btn btn-danger">Submit</button>
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
