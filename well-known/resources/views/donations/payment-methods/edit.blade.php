@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Edit Payment Method</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @include('includes.form-errors')
            @include('donations.payment-methods._form', ['method' => $paymentMethod, 'action' => route('payment-methods.update', $paymentMethod->id), 'submitLabel' => 'Update'])
        </div>
    </div>

</div>

@stop
