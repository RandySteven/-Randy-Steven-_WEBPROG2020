@extends('layouts.app')

@section('title', 'History Detail')

@section('content')
    @php
        $total = 0;
    @endphp
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $detail)
                <tr>
                    <td>
                        <img src="{{ asset('/storage/'.$detail->product->thumbnail) }}" width="100" alt="">
                    </td>
                    <td>
                        {{ $detail->product->name }}
                    </td>
                    <td>
                        {{ number_format($detail->product->price) }}
                    </td>
                    <td>
                        {{ $detail->qty }}
                    </td>
                    <td>
                        {{ number_format($detail->product->price * $detail->qty) }}
                    </td>
                    @php
                        $total += $detail->product->price * $detail->qty;
                    @endphp
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="container text-right">
            Rp. <strong>{{ number_format($total) }}</strong>
        </div>
    </div>
@endsection
