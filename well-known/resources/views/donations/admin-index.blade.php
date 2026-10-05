@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Donations</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Donations</h6>
        </div>
        <div class="card-body">

            <div class="mb-3">
                <a href="{{ route('funds.index') }}" class="btn btn-outline-primary btn-sm">Manage Funds</a>
                <a href="{{ route('payment-methods.index') }}" class="btn btn-outline-primary btn-sm">Manage Payment Methods</a>
            </div>

            @if ($message = Session::get('donation_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Reference</th>
                            <th>Donor</th>
                            <th>Fund</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Reference # (manual)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donations as $donation)
                            <tr>
                                <td>{{ $donation->created_at->format('d M Y H:i') }}</td>
                                <td>{{ $donation->reference }}</td>
                                <td>
                                    {{ $donation->user->name ?? $donation->donor_name ?? 'Guest' }}<br>
                                    <small class="text-muted">{{ $donation->donor_mobile ?: $donation->donor_email }}</small>
                                </td>
                                <td>{{ $donation->fund->title ?? '—' }}</td>
                                <td>৳{{ number_format($donation->amount, 2) }}</td>
                                <td>{{ $donation->paymentMethod->name ?? '—' }}</td>
                                <td>
                                    @if ($donation->status === 'completed')
                                        <span class="badge badge-success">Completed</span>
                                    @elseif ($donation->status === 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif ($donation->status === 'cancelled')
                                        <span class="badge badge-secondary">Cancelled</span>
                                    @else
                                        <span class="badge badge-danger">Failed</span>
                                    @endif
                                </td>
                                <td>{{ $donation->manual_reference ?: $donation->transaction_id }}</td>
                                <td>
                                    @if ($donation->status === 'pending')
                                        <form action="{{ route('donations.admin.verify', $donation->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-link text-success p-0">Mark Completed</button>
                                        </form>
                                        &nbsp;|&nbsp;
                                        <form action="{{ route('donations.admin.reject', $donation->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-link text-danger p-0">Mark Failed</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="text-center text-muted">No donations yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {!! $donations->render() !!}
            </div>

        </div>
    </div>

</div>

@stop
