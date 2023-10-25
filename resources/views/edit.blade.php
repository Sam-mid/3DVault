@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10"> <!-- Increase the column width -->
                <div class="card">
                    <div class="card-header">{{ __('Update Product') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Use PUT method by sending _method field -->

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required value="{{ $product->title }}">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4" required>{{ $product->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control-file" accept="image/*" required>
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price" class="form-control" step="0.01" required value="{{ $product->price }}">
                            </div>

                            <div class="form-group">
                                <label for="poly_count">Poly Count</label>
                                <input type="number" name="poly_count" id="poly_count" class="form-control" required value="{{ $product->poly_count }}">
                            </div>

                            <div class="form-group">
                                <label for="software">Software</label>
                                <select name="software" id="software" class="form-control" @error('software') aria-invalid="@enderror" >
                                    <option value="" disabled selected>Software</option>
                                    <option value="Blender" {{ $product->software == 'Blender' ? 'selected' : '' }}>Blender</option>
                                    <option value="Cinema4d" {{ $product->software == 'Cinema4d' ? 'selected' : '' }}>Cinema4D</option>
                                    <option value="Maya" {{ $product->software == 'Maya' ? 'selected' : '' }}>Maya</option>
                                    <option value="3dsmax" {{ $product->software == '3dsmax' ? 'selected' : '' }}>3dsMax</option>
                                    <option value="ZBrush" {{ $product->software == 'ZBrush' ? 'selected' : '' }}>ZBrush</option>
                                    <option value="Substance" {{ $product->software == 'Substance' ? 'selected' : '' }}>Substance</option>
                                    <option value="Unity" {{ $product->software == 'Unity' ? 'selected' : '' }}>Unity</option>
                                    <option value="Unreal" {{ $product->software == 'Unreal' ? 'selected' : '' }}>Unreal Engine</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="file_format">File Format</label>
                                <select name="file_format" id="file_format" class="form-control" @error('file_format') aria-invalid="@enderror">
                                    <option value="" disabled selected>File format</option>
                                    <option value=".fbx" {{ $product->file_format == '.fbx' ? 'selected' : '' }}>.fbx</option>
                                    <option value=".obj" {{ $product->file_format == '.obj' ? 'selected' : '' }}>.obj</option>
                                    <option value=".glb" {{ $product->file_format == '.glb' ? 'selected' : '' }}>.glb</option>
                                    <option value=".gltf"{{ $product->file_format == '.gltf' ? 'selected' : '' }}>.gltf</option>
                                    <option value=".stl" {{ $product->file_format == '.stl' ? 'selected' : '' }}>.stl</option>
                                    <option value=".dae" {{ $product->file_format == '.dea' ? 'selected' : '' }}>.dae</option>
                                    <option value=".blend"{{ $product->file_format == '.blend' ? 'selected' : '' }}>.blend</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
