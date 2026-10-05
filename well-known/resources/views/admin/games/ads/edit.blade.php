@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0 text-gray-800">Edit Advertisement</h1>
        <a href="{{ route('game-ads.index') }}" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            @include('includes.form-errors')
            @include('admin.games.ads._form', ['ad' => $ad, 'action' => route('game-ads.update', $ad->id), 'submitLabel' => 'Update'])
        </div>
    </div>

</div>

@stop
