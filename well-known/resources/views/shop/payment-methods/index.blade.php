@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Shop Payment Methods</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">How customers can pay at checkout</h6>
        </div>
        <div class="card-body">

            <a href="{{ route('orders.admin.index') }}" class="btn btn-primary btn-back mb-3">View All Orders</a>

            @if ($message = Session::get('payment_method_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <p class="text-muted small">These are separate from the Donation module's payment methods — adding or activating one here only affects the Shop checkout page, never Donations.</p>

            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($methods as $method)
                                <tr>
                                    <td>{{ $method->name }}</td>
                                    <td><span class="badge badge-info">{{ $method->type }}</span></td>
                                    <td>{!! $method->is_active ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-secondary">No</span>' !!}</td>
                                    <td>
                                        <a href="{{ route('shop-payment-methods.edit', $method->id) }}">Edit</a>
                                        &nbsp;|&nbsp;
                                        <form action="{{ route('shop-payment-methods.destroy', $method->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this payment method?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center text-muted">No payment methods yet — add one on the right (e.g. bKash), mark it Active, and it'll show up on the checkout page next to Cash On Delivery.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    @include('includes.form-errors')
                    @include('shop.payment-methods._form', ['method' => null, 'action' => route('shop-payment-methods.store'), 'submitLabel' => 'Create'])
                </div>
            </div>

        </div>
    </div>

</div>

@stop
