@extends('layouts.front')

@section('title') My Orders @endsection

@section('content')

<style>
    .mo-badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; }
    .mo-pending { background: #fef3d7; color: #b98900; }
    .mo-unpaid { background: #fde2e2; color: #c0392b; }
    .mo-paid { background: #d7f5e6; color: #12894e; }
    .mo-row { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; padding: 16px; border: 1px solid #eee; border-radius: 10px; margin-bottom: 12px; overflow-x: hidden; }
    .btn-theme-outline { background: #fff; border: 1.5px solid #0097ff; color: #0097ff; }
.btn-theme-outline:hover, .btn-theme-outline:focus { background: #eaf4ff; color: #0097ff; }
</style>

<div class="breadcrumb-area">
    <div class="container">
        <h1 class="breadcrumb-title">My Orders</h1>
    </div>
</div>

<div class="blog-page-section">
<div class="container">

    @if ($orders->isEmpty())
        <p class="text-muted">You haven't placed any orders yet. <a href="{{ route('shop.index') }}">Continue shopping</a>.</p>
    @else
        @foreach ($orders as $order)
            <div class="mo-row">
                <div>
                    <div><strong>#{{ $order->order_number }}</strong></div>
                    <div class="text-muted small">{{ $order->created_at->format('d M Y, h:i A') }}</div>
                </div>
                <div>{{ $order->currency }}{{ number_format($order->total, 2) }}</div>
                <div>
                    <span class="mo-badge {{ $order->payment_status === 'paid' ? 'mo-paid' : 'mo-unpaid' }}">{{ ucfirst($order->payment_status) }}</span>
                    <span class="mo-badge mo-pending">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span>
                </div>
                <div>
                    <a href="{{ route('checkout.confirmation', $order->id) }}" class="btn btn-sm btn-theme-outline">View</a>
                </div>
            </div>
        @endforeach
    @endif

</div>
</div>

@stop
