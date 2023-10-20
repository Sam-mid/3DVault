@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ $product->title }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/images/'.$product->image) }}" alt="Product Image" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <h2>{{ $product->title }}</h2>
                                <p>{{ $product->description }}</p>
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th scope="row">Price</th>
                                        <td>€{{ $product->price }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Poly Count</th>
                                        <td>{{ $product->poly_count }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Software</th>
                                        <td>{{ $product->software }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">File Format</th>
                                        <td>{{ $product->file_format }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <a href="{{ route('home') }}" class="btn btn-primary me-2">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
