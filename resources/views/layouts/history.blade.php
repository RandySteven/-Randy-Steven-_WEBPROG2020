@extends('layouts.app')

@section('title', 'History')

@section('style')

@endsection

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Transaction date</th>
                    <th>Transaction items</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->created_at->format("d M, Y") }}</td>
                        <td>
                            @php
                                $details = App\OrderDetail::where('order_id', $order->id)->get();
                            @endphp
                            @foreach ($details as $detail)
                                <img src="{{ '/storage/'.$detail->product->thumbnail }}" class="img-fluid" width="50" alt="">
                                {{ $detail->product->name }}
                                <br>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('history.detail', $order->id) }}" class="btn btn-primary">See detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
