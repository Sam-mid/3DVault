@extends('layouts.app')
@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
        <a href="/products/create" class="btn btn-primary my-3">Upload Product</a>

        <form action="{{ route('products.search') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" name="query" class="form-control" placeholder="Search for products" aria-label="Search" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>


    @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div style="max-height: 200px; min-height: 200px; overflow: hidden;">
                            <img src="{{ asset('storage/images/'.$product->image) }}" class="card-img-top" alt="Product Image">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$product->title}}</h5>
                            <p class="card-text">{{$product->description}}</p>
                            <p class="card-text"><strong>Price: €{{$product->price}}</strong></p>
                            <div class="d-flex">
                                <a href="{{ route('products.show', $product) }}" class="btn btn-primary me-2">Details</a>
                                <form method="POST" action="{{ route('products.destroy', $product) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger me-2">Delete</button>
                                </form>
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">Edit Product</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
