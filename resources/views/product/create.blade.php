@extends('layouts.app')

@section('title', 'Create Product')

@section('style')

@endsection

@section('content')
    <div class="container">
        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Product thumbnail</label>
                <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" placeholder="Input must in text">
                @error('thumbnail')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Product name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Input must in text">
                @error('name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Product price</label>
                <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Input must in number">
                @error('price')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Product qunatity</label>
                <input type="text" name="stock" class="form-control @error('stock') is-invalid @enderror" placeholder="Input must in number">
                @error('stock')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Category</label>
                <select name="category" id="" class="form-control">
                    <option disabled selected>Choose one</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" id="" rows="10" class="form-control @error('description') is-invalid @enderror" placeholder="Input must in text"></textarea>
                @error('description')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success position-absolute">Submit</button>
            </div>
        </form>
    </div>
@endsection

@section('script')

@endsection
