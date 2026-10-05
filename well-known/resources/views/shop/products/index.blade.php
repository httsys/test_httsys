@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">All Products</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Products</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <div class="row mb-3">
                    <div class="col-lg-8">
                        <a href="{{ route('products.create') }}?language={{ request()->input('language') }}" class="btn btn-primary">Add Product</a>
                        <a href="{{ route('product-categories.index') }}?language={{ request()->input('language') }}" class="btn btn-secondary">Categories</a>
                        <a href="{{ route('brands.index') }}" class="btn btn-secondary">Brands</a>
                    </div>
                    <div class="col-lg-4 text-right">
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

                @if ($message = Session::get('product_success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>SKU</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td data-label="Image"><img src="{{ $product->photo ? '/public/images/media/' . $product->photo->file : '/public/img/200x200.png' }}" width="50"></td>
                                <td data-label="Title">{{ $product->title }}</td>
                                <td data-label="SKU"><code>{{ $product->sku ?: '—' }}</code></td>
                                <td data-label="Type">{{ ucfirst($product->type) }}</td>
                                <td data-label="Category">{{ $product->category->name ?? '-' }}</td>
                                <td data-label="Price">
                                    {{ number_format($product->effective_price, 2) }}
                                    @if($product->sale_price && $product->sale_price < $product->price)
                                        <br><del class="text-muted small">{{ number_format($product->price, 2) }}</del>
                                    @endif
                                </td>
                                <td data-label="Status">
                                    @if($product->is_active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-secondary">Hidden</span>
                                    @endif
                                    @if($product->is_flash_sale)
                                        <span class="badge badge-danger">Flash Sale</span>
                                    @endif
                                </td>
                                <td data-label="Actions">
                                    <a href="{{ route('products.edit', $product->id) }}">Edit</a>
                                    &nbsp;|&nbsp;
                                    <a href="{{ url('/product/' . $product->slug) }}" target="_blank">View</a>
                                    &nbsp;|&nbsp;
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center text-muted">No products yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                {!! $products->render() !!}

            </div>
        </div>
    </div>

</div>

@stop
