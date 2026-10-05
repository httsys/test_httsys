@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Edit Category</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
        </div>
        <div class="card-body">

            <a href="{{ route('product-categories.index') }}" class="btn btn-primary btn-back mb-3">Back to Categories</a>

            @include('includes.form-errors')

            <form action="{{ route('product-categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <strong>Category Name</strong>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>

        </div>
    </div>

</div>

@stop
