@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Product Categories</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Product Categories</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <div class="row">
                    <div class="col-lg-6">
                        <a href="{{ route('products.index') }}?language={{ request()->input('language') }}" class="btn btn-primary btn-back">Back to Products</a>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-right">
                            @if (!empty($langs))
                                <select name="language" class="form-control language-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                                    <option value="" selected disabled>{{clean( trans('niva-backend.select_language') , array('Attr.EnableID' => true))}}</option>
                                    @foreach ($langs as $lang)
                                        <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                </div>

                @if ($message = Session::get('category_success'))
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
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td data-label="ID">{{ $category->id }}</td>
                                        <td data-label="Name">{{ $category->name }}</td>
                                        <td data-label="Actions">
                                            <a href="{{ route('product-categories.edit', $category->id) }}">Edit</a>
                                            &nbsp;|&nbsp;
                                            <form action="{{ route('product-categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted">No categories yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        {!! $categories->render() !!}
                    </div>

                    <div class="col-md-6">
                        @include('includes.form-errors')

                        <form action="{{ route('product-categories.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <strong>Category Name</strong>
                                <input type="text" name="name" class="form-control" required>
                                <input type="hidden" name="language_id" value="{{ $lang_id }}">
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
