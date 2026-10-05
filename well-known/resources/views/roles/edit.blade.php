@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit role</h1>
            <p class="text-muted mb-0">Tick what this role is allowed to do.</p>
        </div>
        <a href="{{ route('roles.index') }}" class="btn btn-sm btn-secondary">Back to roles</a>
    </div>

    <form method="POST" action="{{ route('roles.update', $role->id) }}">
        @csrf
        @method('PUT')
        @include('roles._form', ['role' => $role, 'grouped' => $grouped, 'selected' => $selected])

        <div class="mb-5">
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>

</div>
@stop
