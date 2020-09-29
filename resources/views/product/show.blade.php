@extends('layouts.app')

@section('title', $product->name)

@section('style')
<style>
div.scrollmenu {
    background-color: #000;
    overflow: auto;
    white-space: nowrap;
  }

  div.scrollmenu a {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px;
    text-decoration: none;
  }

  div.scrollmenu a:hover {
    background-color: #777;
  }

</style>
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
        <div class="row mx-0">
            <div class="col">
                <img src="{{ asset('/storage/'.$product->thumbnail) }}" class="" alt="">
            </div>
            <div class="col">
                <h4>{{ $product->name }}</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Data</td>
                            <td>Value</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>name : </td>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <td>price : </td>
                            <td><strong>Rp {{ number_format($product->price) }}.00</strong></td>
                        </tr>
                        <tr>
                            <td>category : </td>
                            <td><a href="{{ route('category', $product->category->slug) }}" class="btn btn-success">{{ $product->category->name }}</a></td>
                        </tr>
                        <tr>
                            <td>stock : </td>
                            <td>{{ $product->stock }}</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div class="container">
        <table class="table">
            <tr>
                <td>
                    @can('update', $product)
                        <a href="{{ route('product.edit', $product->slug) }}" class="btn btn-success">Edit</a>
                    @endcan
                </td>
                <td>
                    @can('delete', $product)
                        <form action="{{ route('product.delete', $product->slug) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endcan
                </td>
            </tr>
        </table>
        @can('update', $product)
        <form action="{{ route('album.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="photo" id="">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="btn btn-primary">Add photo</button>
        </form>
        @endcan

    </div>

    <div class="container my-2">
        @if ($product->stock==0)
            <div class="alert alert-danger">
                Saat ini stock barang sedang habis
            </div>
        @else
            <form action="{{ route('cart.store') }}" method="post">
                @csrf
                <input type="text" name="qty" id="" class="@error('qty') is-invalid @enderror" placeholder="Qty minimal 1">
                <button type="submit" class="btn btn-success">Add to cart
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                        <path fill-rule="evenodd" d="M8.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
                    </svg>
                </button>
                <div class="text text-danger">
                    @error('qty')
                        {{ $message }}
                    @enderror
                </div>
                <input type="hidden" name="product_id" value={{ $product->id }}>
            </form>
        @endif
    </div>

    <div class="container">
        <p>{!! nl2br($product->description) !!}</p>
    </div>

    <div class="container scrollmenu">
        @foreach ($product->albums as $album)
        <a href="{{ asset('/storage/'.$album->photo) }}" target="_blank">
            <img src="{{ asset('/storage/'.$album->photo) }}" class="rounded" style="width: 10rem; height: 10rem" alt="">
        </a>
        @endforeach
    </div>

    <div class="container">
        @include('product.comment.comment', ['comments'=>$product->comments, 'product_id'=>$product->id])
        <form action="{{ route('comment') }}" method="POST">
            @csrf
            <textarea id="" name="comment" rows="10" class="form-control" placeholder="Write your comment ..."></textarea>
            <input type="hidden" name="product_id" value={{ $product->id }}>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection

@section('script')

@endsection
