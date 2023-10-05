@extends('layouts.app')
@section('content')
    <div class="container">
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

        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{$product->image}}" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">{{$product->title}}</h5>
                            <p class="card-text">{{$product->description}}</p>
                            <p class="card-text"><strong>Price: €{{$product->price}}</strong></p>
                            <a href="#" class="btn btn-primary">View Product</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
