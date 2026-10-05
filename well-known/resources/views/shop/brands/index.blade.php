@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Brands</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Brands</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <a href="{{ route('products.index') }}" class="btn btn-primary btn-back mb-3">Back to Products</a>

                @if ($message = Session::get('brand_success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($brands as $brand)
                                    <tr>
                                        <td data-label="Logo"><img src="{{ $brand->photo ? '/public/images/media/' . $brand->photo->file : '/public/img/200x200.png' }}" width="40"></td>
                                        <td data-label="Name">{{ $brand->name }}</td>
                                        <td data-label="Actions">
                                            <a href="{{ route('brands.edit', $brand->id) }}">Edit</a>
                                            &nbsp;|&nbsp;
                                            <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this brand?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted">No brands yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        {!! $brands->render() !!}
                    </div>

                    <div class="col-md-6">
                        @include('includes.form-errors')

                        <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <strong>Brand Name</strong>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <strong>Logo (optional)</strong>
                                <input type="file" name="photo_id" class="form-control-file">
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@stop
