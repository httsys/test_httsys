@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Edit Brand</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Brand</h6>
        </div>
        <div class="card-body">

            <a href="{{ route('brands.index') }}" class="btn btn-primary btn-back mb-3">Back to Brands</a>

            @include('includes.form-errors')

            <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <strong>Brand Name</strong>
                    <input type="text" name="name" class="form-control" value="{{ $brand->name }}" required>
                </div>
                <div class="form-group">
                    <strong>Logo</strong>
                    <br>
                    <img src="{{ $brand->photo ? '/public/images/media/' . $brand->photo->file : '/public/img/200x200.png' }}" width="60" class="mb-2">
                    <input type="file" name="photo_id" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>

        </div>
    </div>

</div>

@stop
