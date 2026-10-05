@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0 text-gray-800">Add Advertisement</h1>
        <a href="{{ route('game-ads.index') }}" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            @include('includes.form-errors')
            @include('admin.games.ads._form', ['ad' => null, 'action' => route('game-ads.store'), 'submitLabel' => 'Submit'])
        </div>
    </div>

</div>

@stop
