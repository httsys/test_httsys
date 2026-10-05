@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Profile Change Requests</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Customer-submitted changes awaiting review</h6>
        </div>
        <div class="card-body">

            @if ($message = Session::get('profile_request_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if ($message = Session::get('profile_request_error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <form method="GET" class="form-inline mb-3">
                <select name="status" class="form-control form-control-sm mr-2" onchange="this.form.submit()">
                    <option value="pending" {{ request('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                </select>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Requested changes</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $req)
                            <tr>
                                <td>{{ $req->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    {{ $req->user->name }}<br>
                                    <small class="text-muted">{{ $req->user->email }}</small>
                                </td>
                                <td>
                                    @if ($req->photo)
                                        <div class="mb-2">
                                            <img src="/public/images/media/{{ $req->photo->file }}" alt="Requested photo" style="width:44px;height:44px;object-fit:cover;border-radius:50%;border:1px solid #ddd;">
                                            <span class="text-muted small">New profile photo</span>
                                        </div>
                                    @endif
                                    <table class="table table-sm table-borderless mb-0">
                                        @if ($req->name)
                                            <tr><td class="text-muted">Name</td><td>{{ $req->user->name }} → <strong>{{ $req->name }}</strong></td></tr>
                                        @endif
                                        @if ($req->phone)
                                            <tr><td class="text-muted">Phone</td><td>{{ $req->user->phone }} → <strong>{{ $req->phone }}</strong></td></tr>
                                        @endif
                                        @if ($req->city)
                                            <tr><td class="text-muted">City</td><td>{{ $req->user->city }} → <strong>{{ $req->city }}</strong></td></tr>
                                        @endif
                                        @if ($req->address)
                                            <tr><td class="text-muted">Address</td><td>{{ $req->user->address }} → <strong>{{ $req->address }}</strong></td></tr>
                                        @endif
                                    </table>
                                </td>
                                <td>
                                    @if ($req->status === 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif ($req->status === 'approved')
                                        <span class="badge badge-success">Approved</span>
                                    @else
                                        <span class="badge badge-secondary">Rejected</span>
                                    @endif
                                    @if ($req->reviewed_at)
                                        <br><small class="text-muted">{{ $req->reviewed_at->format('d M Y H:i') }} by {{ $req->reviewer->name ?? '—' }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if ($req->status === 'pending')
                                        <form method="POST" action="{{ route('profile-requests.admin.approve', $req->id) }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Accept</button>
                                        </form>
                                        <form method="POST" action="{{ route('profile-requests.admin.reject', $req->id) }}" class="d-inline" onsubmit="return confirm('Reject this request? The customer\'s current details will stay unchanged.');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                        </form>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted">No requests here.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {!! $requests->render() !!}
            </div>

        </div>
    </div>

</div>

@stop
