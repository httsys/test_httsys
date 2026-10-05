@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Escrow Holds</h1>
            <p class="text-muted mb-0">Payments buyers say they've made, waiting to be confirmed and paid out.</p>
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
            <option value="held" {{ request('status', 'held') == 'held' ? 'selected' : '' }}>Held (needs review)</option>
            <option value="released" {{ request('status') == 'released' ? 'selected' : '' }}>Released</option>
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
                            <th>Type</th>
                            <th>Buyer → Seller</th>
                            <th>Amount</th>
                            <th>Fee</th>
                            <th>Payout</th>
                            <th>Payment ref.</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($holds as $hold)
                            <tr>
                                <td>{{ $hold->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    {{ $hold->listing_type ? ucfirst(str_replace('_', ' ', $hold->listing_type)) : '—' }}
                                    @if ($hold->listing_type === 'currency_exchange' && $hold->currencyOrder)
                                        <br><small class="text-muted">{{ number_format($hold->currencyOrder->currency_amount, 2) }} {{ $hold->currencyOrder->currency }} @ ৳{{ number_format($hold->currencyOrder->rate, 2) }}</small>
                                        <br><small class="text-muted">Ref: {{ $hold->currencyOrder->payment_reference }}</small>
                                        <br><small class="{{ $hold->currencyOrder->seller_status === 'released' ? 'text-success' : ($hold->currencyOrder->seller_status === 'rejected' ? 'text-danger' : 'text-muted') }}">
                                            Seller: {{ ucfirst($hold->currencyOrder->seller_status) }}{{ $hold->currencyOrder->seller_note ? ' — ' . $hold->currencyOrder->seller_note : '' }}
                                            @if ($hold->currencyOrder->buyer_confirmed_at) · Buyer confirmed @endif
                                        </small>
                                    @elseif (in_array($hold->listing_type, ['marketplace', 'auction']) && $hold->marketplaceOrder)
                                        <br><small class="text-muted">{{ $hold->marketplaceOrder->listing->title ?? 'Listing' }} × {{ $hold->marketplaceOrder->quantity }}</small>
                                        <br><small class="text-muted">Ref: {{ $hold->marketplaceOrder->payment_reference }}</small>
                                        <br><small class="{{ $hold->marketplaceOrder->seller_status === 'released' ? 'text-success' : ($hold->marketplaceOrder->seller_status === 'rejected' ? 'text-danger' : 'text-muted') }}">
                                            Seller: {{ ucfirst($hold->marketplaceOrder->seller_status) }}{{ $hold->marketplaceOrder->seller_note ? ' — ' . $hold->marketplaceOrder->seller_note : '' }}
                                            @if ($hold->marketplaceOrder->buyer_confirmed_at) · Buyer confirmed @endif
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    {{ $hold->payer->name ?? '—' }}
                                    <i class="fas fa-arrow-right text-muted mx-1"></i>
                                    {{ $hold->payee->name ?? '—' }}
                                </td>
                                <td>৳{{ number_format($hold->amount, 2) }}</td>
                                <td>৳{{ number_format($hold->fee_amount, 2) }}</td>
                                <td>৳{{ number_format($hold->payout_amount, 2) }}</td>
                                <td>{{ $hold->payment_reference ?: '—' }}</td>
                                <td>
                                    @if ($hold->status === 'held')
                                        <span class="badge badge-warning">Held</span>
                                    @elseif ($hold->status === 'released')
                                        <span class="badge badge-success">Released</span>
                                    @else
                                        <span class="badge badge-secondary">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($hold->status === 'held')
                                        @haspermission('wallet.escrow.manage')
                                            <form method="POST" action="{{ route('wallet.admin.escrow.release', $hold->id) }}" class="d-inline" onsubmit="return confirm('Release ৳{{ number_format($hold->payout_amount, 2) }} to {{ $hold->payee->name ?? 'the seller' }}?');">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">Release</button>
                                            </form>
                                            <form method="POST" action="{{ route('wallet.admin.escrow.reject', $hold->id) }}" class="d-inline" onsubmit="return confirm('Reject this hold? No funds will be credited.');">
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
                            <tr><td colspan="9" class="text-center text-muted">Nothing here.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {!! $holds->render() !!}
            </div>
        </div>
    </div>

</div>
@stop
