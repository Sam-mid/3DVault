@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 pl-4">Admin Page</h1>
        <div class="d-flex justify-content-center">
            <table class="table table-striped table-bordered w-100">
                <thead class="table-dark">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>
                            @if(auth()->user()->role === 'admin')
                                @if ($product->status === 1)
                                    <form method="POST" action="{{ route('products.toggle', $product) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">Active</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('products.toggle', $product) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger">Hidden</button>
                                    </form>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- Button to go back to the home page -->
        <div class="mt-4 pl-4">
            <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
        </div>
    </div>
@endsection
