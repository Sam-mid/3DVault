@extends('layouts.app')
@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
            </div>
        </div>

        <form method="GET" action="{{ route('products.search') }}">
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search for products" aria-label="Search" aria-describedby="button-addon2">
                <select name="software" class="form-select">
                    <option value="">Software</option>
                    <option value="Blender">Blender</option>
                    <option value="Cinema4D">Cinema4D</option>
                    <option value="Maya">Maya</option>
                    <option value="3dsMax">3dsMax</option>
                    <option value="ZBrush">ZBrush</option>
                    <option value="Substance">Substance</option>
                    <option value="Unity">Unity</option>
                    <option value="Unreal">Unreal Engine</option>
                </select>

                <select name="file_format" class="form-select">
                    <option value="">File format</option>
                    <option value=".fbx">.fbx</option>
                    <option value=".obj">.obj</option>
                    <option value=".glb">.glb</option>
                    <option value=".gltf">.gltf</option>
                    <option value=".stl">.stl</option>
                    <option value=".dae">.dae</option>
                    <option value=".blend">.blend</option>
                </select>

                <select name="price_range" class="form-select">
                    <option value="">Price Range</option>
                    <option value="0-50">0 - 50</option>
                    <option value="51-100">51 - 100</option>
                    <option value="101-150">101 - 999999</option>
                </select>
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
            </div>



        </form>



        <a href="/products/create" class="btn btn-primary my-3">Upload Product</a>

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
    </div>
@endsection
