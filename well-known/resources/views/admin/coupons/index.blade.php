@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Coupons</h1>
    <p class="text-muted">Customers can enter these codes at checkout under "Apply Coupon Code".</p>

    <div class="card shadow mb-4">
        <div class="card-body">

            @if ($message = Session::get('coupon_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <div class="row">
                <div class="col-md-7">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Discount</th>
                                <th>Used</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($coupons as $coupon)
                                <tr>
                                    <td><code>{{ $coupon->code }}</code></td>
                                    <td>{{ $coupon->type == 'percent' ? $coupon->value . '%' : config('shop.currency_symbol') . number_format($coupon->value, 2) }}</td>
                                    <td>{{ $coupon->used_count }}{{ $coupon->usage_limit ? ' / ' . $coupon->usage_limit : '' }}</td>
                                    <td>{!! $coupon->is_active ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-secondary">No</span>' !!}</td>
                                    <td>
                                        <a href="{{ route('coupons.edit', $coupon->id) }}">Edit</a>
                                        &nbsp;|&nbsp;
                                        <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this coupon?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center text-muted">No coupons yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="col-md-5">
                    @include('includes.form-errors')
                    @include('admin.coupons._form', ['coupon' => null, 'action' => route('coupons.store'), 'submitLabel' => 'Create'])
                </div>
            </div>

        </div>
    </div>

</div>

@stop
