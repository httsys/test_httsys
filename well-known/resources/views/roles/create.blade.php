@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 mb-0 text-gray-800">New role</h1>
            <p class="text-muted mb-0">Pick the permissions this role grants.</p>
        </div>
        <a href="{{ route('roles.index') }}" class="btn btn-sm btn-secondary">Back to roles</a>
    </div>

    <form method="POST" action="{{ route('roles.store') }}">
        @csrf
        @include('roles._form', ['grouped' => $grouped, 'selected' => $selected])

        <div class="mb-5">
            <button type="submit" class="btn btn-primary">Create role</button>
        </div>
    </form>

</div>
@stop
