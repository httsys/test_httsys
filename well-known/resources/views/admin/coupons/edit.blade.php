@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Edit Coupon</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @include('includes.form-errors')
            @include('admin.coupons._form', ['coupon' => $coupon, 'action' => route('coupons.update', $coupon->id), 'submitLabel' => 'Update'])
        </div>
    </div>

</div>

@stop
