@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Withdrawal Requests</h1>
            <p class="text-muted mb-0">Approve only after you've actually sent the money to the customer.</p>
        </div>
        <a href="{{ route('wallet.admin.index') }}" class="btn btn-sm btn-secondary">Back to wallets</a>
    </div>

    @if ($message = Session::get('wallet_admin_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = Session::get('wallet_error'))
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
        </select>
    </form>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Account details</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($requests as $wr)
                            <tr>
                                <td>{{ $wr->created_at->format('d M Y H:i') }}</td>
                                <td>{{ $wr->user->name ?? '—' }}<br><small class="text-muted">{{ $wr->user->email ?? '' }}</small></td>
                                <td>৳{{ number_format($wr->amount, 2) }}</td>
                                <td>{{ strtoupper($wr->method) }}</td>
                                <td>{{ $wr->account_details }}</td>
                                <td>
                                    @if ($wr->status === 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif ($wr->status === 'approved')
                                        <span class="badge badge-success">Approved</span>
                                    @else
                                        <span class="badge badge-secondary">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($wr->status === 'pending')
                                        @haspermission('wallet.withdrawals.manage')
                                            <form method="POST" action="{{ route('wallet.admin.withdrawals.approve', $wr->id) }}" class="d-inline" onsubmit="return confirm('Only approve after you have actually sent ৳{{ number_format($wr->amount, 2) }} via {{ strtoupper($wr->method) }}. Continue?');">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                            </form>
                                            <form method="POST" action="{{ route('wallet.admin.withdrawals.reject', $wr->id) }}" class="d-inline" onsubmit="return confirm('Reject this request?');">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                            </form>
                                        @endhaspermission
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center text-muted">Nothing here.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {!! $requests->render() !!}
            </div>
        </div>
    </div>

</div>
@stop
