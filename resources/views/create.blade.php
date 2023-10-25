@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10"> <!-- Increase the column width -->
                <div class="card">
                    <div class="card-header">{{ __('Create New Product') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control-file" accept="image/*" required>
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price" class="form-control" step="0.01" required>
                            </div>

                            <div class="form-group">
                                <label for="poly_count">Poly Count</label>
                                <input type="number" name="poly_count" id="poly_count" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="software">Software</label>
                                <select name="software" id="software" class="form-control" @error('software') aria-invalid="@enderror">
                                <option value="" disabled selected>Software</option>
                                    <option value="Blender">Blender</option>
                                    <option value="Cinema4d">Cinema4D</option>
                                    <option value="Maya">Maya</option>
                                    <option value="3dsmax">3dsMax</option>
                                    <option value="ZBrush">ZBrush</option>
                                    <option value="Substance">Substance</option>
                                    <option value="Unity">Unity</option>
                                    <option value="Unreal">Unreal Engine</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="file_format">File Format</label>
                                <input type="text" name="file_format" id="file_format" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="file_format">File Format</label>
                                <select name="file_format" id="file_format" class="form-control" @error('file_format') aria-invalid="@enderror">
                                    <option value="" disabled selected>File format</option>
                                    <option value=".fbx">.fbx</option>
                                    <option value=".obj">.obj</option>
                                    <option value=".glb">.glb</option>
                                    <option value=".gltf">.gltf</option>
                                    <option value=".stl">.stl</option>
                                    <option value=".dae">.dae</option>
                                    <option value=".blend">.blend</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Upload Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
