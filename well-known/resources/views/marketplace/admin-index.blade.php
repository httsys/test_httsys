@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Marketplace Listings</h1>
    <p class="text-muted">Every fixed-price and auction listing posted by any user.</p>

    @if ($message = Session::get('marketplace_admin_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <form method="GET" class="form-inline mb-3">
        <select name="type" class="form-control form-control-sm mr-2" onchange="this.form.submit()">
            <option value="">All types</option>
            <option value="fixed" {{ request('type') == 'fixed' ? 'selected' : '' }}>Fixed Price</option>
            <option value="auction" {{ request('type') == 'auction' ? 'selected' : '' }}>Auction</option>
        </select>
        <select name="status" class="form-control form-control-sm mr-2" onchange="this.form.submit()">
            <option value="">All statuses</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Sold</option>
            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
            <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
        </select>
    </form>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Seller</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($listings as $listing)
                            <tr>
                                <td>{{ $listing->title }}</td>
                                <td>{{ $listing->seller->name ?? '—' }}</td>
                                <td>{{ ucfirst($listing->listing_type) }}</td>
                                <td>
                                    @if ($listing->listing_type === 'fixed')
                                        ৳{{ number_format($listing->price, 2) }}
                                    @else
                                        ৳{{ number_format($listing->current_bid ?: $listing->starting_price, 2) }}
                                    @endif
                                </td>
                                <td>
                                    @if ($listing->status === 'active')
                                        <span class="badge badge-success">Active</span>
                                    @elseif ($listing->status === 'sold')
                                        <span class="badge badge-primary">Sold</span>
                                    @elseif ($listing->status === 'expired')
                                        <span class="badge badge-warning">Expired</span>
                                    @else
                                        <span class="badge badge-secondary">Closed</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('marketplace.show', $listing->id) }}" target="_blank" class="btn btn-sm btn-primary">View</a>
                                    @if ($listing->status === 'active')
                                        <form method="POST" action="{{ route('marketplace.admin.close', $listing->id) }}" class="d-inline" onsubmit="return confirm('Close this listing?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Close</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted">No listings yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {!! $listings->render() !!}
            </div>
        </div>
    </div>

</div>
@stop
