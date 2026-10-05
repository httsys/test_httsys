@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Return Requests</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Customer Return Requests</h6>
        </div>
        <div class="card-body">

            @if ($message = Session::get('order_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <form method="GET" class="form-inline mb-3">
                <select name="status" class="form-control form-control-sm mr-2" onchange="this.form.submit()">
                    <option value="">All statuses</option>
                    @foreach(['pending', 'accepted', 'rejected'] as $s)
                        <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th>Reason</th>
                            <th>Requested</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($returns as $return)
                            <tr>
                                <td>
                                    @if($return->order)
                                        <a href="{{ route('orders.admin.show', $return->order->id) }}">#{{ $return->order->order_number }}</a>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td>{{ optional($return->user)->name }}</td>
                                <td>
                                    @foreach($return->items as $ri)
                                        <div class="small">{{ optional($ri->orderItem)->product_title }} &times; {{ $ri->quantity }}</div>
                                    @endforeach
                                </td>
                                <td>{{ $return->reason }}</td>
                                <td>{{ $return->created_at->format('h:i A, d-m-Y') }}</td>
                                <td>
                                    @php
                                        $badge = ['pending' => 'warning', 'accepted' => 'success', 'rejected' => 'danger'][$return->status] ?? 'secondary';
                                    @endphp
                                    <span class="badge badge-{{ $badge }}">{{ ucfirst($return->status) }}</span>
                                    @if($return->admin_note)
                                        <div class="small text-muted mt-1">{{ $return->admin_note }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if($return->status === 'pending')
                                        <form action="{{ route('order-returns.admin.accept', $return->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Accept this return request?');">Accept</button>
                                        </form>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#rejectModal{{ $return->id }}">Reject</button>

                                        <div class="modal fade" id="rejectModal{{ $return->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('order-returns.admin.reject', $return->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Reject Return Request</h5>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label>Reason for the customer</label>
                                                            <textarea name="admin_note" class="form-control" rows="3" required></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger">Reject</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted small">Reviewed {{ optional($return->reviewed_at)->format('d-m-Y') }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center text-muted">No return requests.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {!! $returns->appends(request()->query())->render() !!}
            </div>

        </div>
    </div>

</div>

@endsection
