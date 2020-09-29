@extends('layouts.app')

@section('title', 'Pak Gober Shop')

@section('style')

@endsection

@section('content')
<div class="container">
    <div class="container my-2">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{ asset('image/traveloka_logo.jpg') }}" height=500 class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{ asset('image/200503051913-15-ju.jpg') }}" height=500 class="d-block w-100" alt="...">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @foreach ($product_reviews as $product)
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{ asset('/storage/'.$product->thumbnail) }}" alt="Card image cap">
                        <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 120, '...') }}</p>
                        <a href="{{ route('product.show', $product->slug) }}" class="btn btn-primary">See product</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
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
        <a href="{{ route('product.index') }}" class="btn btn-primary">See other products</a>
    </div>


</div>
@endsection

@section('script')

@endsection
