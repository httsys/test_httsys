@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Roles</h1>
            <p class="text-muted mb-0">What each kind of user is allowed to do.</p>
        </div>
        <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm">+ New role</a>
    </div>

    @if ($message = Session::get('role_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @if ($message = Session::get('role_error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th>Users</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr>
                                <td>
                                    <strong>{{ $role->name }}</strong>
                                    @if ($role->is_locked)
                                        <span class="badge badge-info">built-in</span>
                                    @endif
                                    @if ($role->description)
                                        <br><small class="text-muted">{{ $role->description }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if ($role->is_locked)
                                        <span class="badge badge-success">Full access</span>
                                    @else
                                        {{ count($role->permissionKeys()) }} granted
                                    @endif
                                </td>
                                <td>{{ $role->users_count }}</td>
                                <td>
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    @unless ($role->is_locked)
                                        <form method="POST" action="{{ route('roles.destroy', $role->id) }}" class="d-inline"
                                              onsubmit="return confirm('Delete this role?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    @endunless
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted">No roles yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@stop
