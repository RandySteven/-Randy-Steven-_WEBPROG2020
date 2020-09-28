<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    @php
        $total = 0;
    @endphp
    <div class="container text-center">
        <h1>Anda telah melakukan pesanan</h1>
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
</body>
</html>
