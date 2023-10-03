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

                    {{ __('You are locked in!') }}
                </div>
            </div>
        </div>
    </div>
    <div class = "row">
        @foreach($products as $product)
            <div class = "col-4">
                <div class = "card">
                    <div class = "card-body">
                        <img src = "card-image">{{$product->image}}
                        <h5 class = "card-title">{{$product->name}}</h5>
                        <p class = "card-text">{{$product->description}}</p>
                    </div>
                </div>
            </div>
    </div>
</div>
@endforeach
@endsection
