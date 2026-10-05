@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Pickup Locations</h1>
    <p class="text-muted">These show up as "Pick Up" options on the checkout page.</p>

    <div class="card shadow mb-4">
        <div class="card-body">

            @if ($message = Session::get('pickup_location_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>City</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($locations as $location)
                                <tr>
                                    <td>{{ $location->name }}</td>
                                    <td>{{ $location->city }}</td>
                                    <td>{!! $location->is_active ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-secondary">No</span>' !!}</td>
                                    <td>
                                        <a href="{{ route('pickup-locations.edit', $location->id) }}">Edit</a>
                                        &nbsp;|&nbsp;
                                        <form action="{{ route('pickup-locations.destroy', $location->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this pickup location?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center text-muted">No pickup locations yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    @include('includes.form-errors')
                    @include('admin.pickup-locations._form', ['location' => null, 'action' => route('pickup-locations.store'), 'submitLabel' => 'Create'])
                </div>
            </div>

        </div>
    </div>

</div>

@stop
