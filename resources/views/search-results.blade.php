@extends('layouts.app')
@section('content')
    <h2>Search Results</h2>
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
            </div>
        </div>

        <form method="GET" action="{{ route('products.search') }}">
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search for products" aria-label="Search" aria-describedby="button-addon2">
                <select name="category" class="form-select">
                    <option value="">Software</option>
                    <option value="1">Blender</option>
                    <option value="2">Cinema4D</option>
                    <option value="3">Maya</option>
                    <option value="4">3dsMax</option>
                    <option value="5">ZBrush</option>
                    <option value="6">Substance</option>
                    <option value="7">Unity</option>
                    <option value="8">Unreal Engine</option>

                </select>
                <select name="price_range" class="form-select">
                    <option value="">All Price Ranges</option>
                    <option value="0-50">0 - 50</option>
                    <option value="51-100">51 - 100</option>
                    <option value="101-150">101 - 999999</option>
                </select>
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>

        <a href="/products/create" class="btn btn-primary my-3">Upload Product</a>

    @if($products->count() === 0)
            <p>No products found.</p>
        @else
            <ul>
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
                                    <div class="d-flex justify-content-center mb-3">
                                        <a href="{{ route('products.show', $product) }}" class="btn btn-primary me-2">Details</a>
                                        @auth
                                            @if(auth()->user()->id === $product->user_id || auth()->user()->role === 'admin')
                                                <form method="POST" action="{{ route('products.destroy', $product) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger me-2">Delete</button>
                                                </form>
                                                <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">Edit Product</a>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </ul>
        @endif
    </div>
@endsection

