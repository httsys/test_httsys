@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Edit Pickup Location</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @include('includes.form-errors')
            @include('admin.pickup-locations._form', ['location' => $pickupLocation, 'action' => route('pickup-locations.update', $pickupLocation->id), 'submitLabel' => 'Update'])
        </div>
    </div>

</div>

@stop
