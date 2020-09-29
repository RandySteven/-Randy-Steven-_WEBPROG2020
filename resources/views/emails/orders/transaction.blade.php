<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    @php
        $total = 0;
    @endphp
    <div class="container text-center">
        <h1>Anda telah melakukan pesanan</h1>
        <h2>{{ $order->invoice }}</h2>
        Pengiriman ke alamat :
        <h4>{!! nl2br($order->address) !!}</h4>
        Kode Post : <h3>{{ $order->post_number }}</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product's Name</th>
                    <th>Product's Price</th>
                    <th>Qty</th>
                    <th>subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cart->product->name }}</td>
                    <td>Rp{{ number_format($cart->product->price) }}.00</td>
                    <td><b>{{ $cart->qty }}</b></td>
                    <td>Rp{{ number_format($cart->product->price * $cart->qty) }}.00</td>
                </tr>
                @php
                    $total += $cart->product->price * $cart->qty;
                @endphp
                @endforeach
            </tbody>
        </table>
        <div class="container text-right">
            <h4>Total : Rp <strong class="text text-danger">{{ number_format($total) }} .00</strong></h4>
        </div>
    </div>


    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
