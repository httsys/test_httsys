@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Currency Listings</h1>
    <p class="text-muted">Every listing posted by any user.</p>

    @if ($message = Session::get('currency_admin_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <form method="GET" class="form-inline mb-3">
        <select name="status" class="form-control form-control-sm mr-2" onchange="this.form.submit()">
            <option value="">All statuses</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="paused" {{ request('status') == 'paused' ? 'selected' : '' }}>Paused</option>
            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
        </select>
    </form>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Seller</th>
                            <th>Currency</th>
                            <th>Rate</th>
                            <th>Available</th>
                            <th>Reserved</th>
                            <th>Sold</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($listings as $listing)
                            <tr>
                                <td>{{ $listing->seller->name ?? '—' }}</td>
                                <td>{{ $listing->currency }}</td>
                                <td>৳{{ number_format($listing->rate, 2) }}</td>
                                <td>{{ number_format($listing->amount_available, 2) }}</td>
                                <td>{{ number_format($listing->amount_reserved, 2) }}</td>
                                <td>{{ number_format($listing->amount_sold, 2) }}</td>
                                <td>
                                    @if ($listing->status === 'active')
                                        <span class="badge badge-success">Active</span>
                                    @elseif ($listing->status === 'paused')
                                        <span class="badge badge-warning">Paused</span>
                                    @else
                                        <span class="badge badge-secondary">Closed</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('currency.show', $listing->id) }}" target="_blank" class="btn btn-sm btn-primary">View</a>
                                    @if ($listing->status !== 'closed')
                                        <form method="POST" action="{{ route('currency.admin.close', $listing->id) }}" class="d-inline" onsubmit="return confirm('Close this listing?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Close</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center text-muted">No listings yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {!! $listings->render() !!}
            </div>
        </div>
    </div>

</div>
@stop
