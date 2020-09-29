@extends('layouts.app')

@section('title', 'Produk Toko')

@section('style')

@endsection

@section('content')
    <div class="container">
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
        </div>
        <div class="container">
            <div class="row mx-1">
                @foreach ($categories as $category)
                <div class="card text-white {{ $category->slug ? "bg-success" : "" }}  my-3 mx-3" style="max-width: 18rem;">
                    <a href="{{ route('category', $category->slug) }}" style="color: white">
                        <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <div class="container text-center">
            Item(s) total {{ $product_counts }}
        </div>

        <div class="container">
            <div class="row mx-1 my-2">
                @forelse ($products as $product)
                <div class="col col-4">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ $product->takeImage }}" class="card-img-top" alt="..." height=200>
                        <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Price : <strong class="text text-danger">Rp {{ number_format($product->price) }}.00</strong></p>
                        <p class="card-text">{{ Str::limit($product->description, 120, '...') }}</p>
                        <a href="{{ route('product.show', $product->slug) }}" class="btn btn-primary">See detail</a>

                        </div>
                    </div>
                </div>
                @empty
                    <div>
                        No Products
                    </div>
                @endforelse
            </div>
        </div>
        {{ $products->links() }}
    </div>
@endsection

@section('script')

@endsection
