@extends('layouts.front')

@section('title') Order Submitted @endsection

@section('content')

<style>
    .btn-theme { background: #0097ff; border-color: #0097ff; color: #fff; }
    .btn-theme:hover, .btn-theme:focus { background: #0080e0; border-color: #0080e0; color: #fff; }
    .btn-theme-outline { background: #fff; border: 1.5px solid #0097ff; color: #0097ff; }
    .btn-theme-outline:hover, .btn-theme-outline:focus { background: #eaf4ff; color: #0097ff; }
</style>
<div class="breadcrumb-area">
    <div class="container">
        <ul class="page-list">
            <li class="item-home"><a class="bread-link" href="{{ route('home') }}" title="Home">Home</a></li>
            <li class="separator separator-home"></li>
            <li class="item-current">Order Submitted</li>
        </ul>
        <h1 class="breadcrumb-title">Order Submitted</h1>
        <ul class="shape-group-code">
            <li class="shape shape-1"><img src="/public/img/bubble-9.png" alt="circle"></li>
            <li class="shape shape-2"><img src="/public/img/bubble-17.png" alt="circle"></li>
            <li class="shape shape-3"><img src="/public/img/line-4.png" alt="circle"></li>
        </ul>
    </div>
</div>


<div class="blog-page-section">
<div class="container text-center">
    <div class="donate-box" style="max-width: 560px; margin: 0 auto; background: #fff; border-radius: 14px; padding: 40px; box-shadow: 0 4px 24px rgba(0,0,0,0.06);">

        @php
            $amountText = $order->currency . number_format($order->total, 2);
        @endphp

        @if ($order->payment_status === 'paid')
            <h2 class="text-success mb-3">Order Confirmed</h2>
            <p>We've received your payment of {{ $amountText }}. Your order is confirmed and will be processed shortly.</p>
        @else
            <h2 class="mb-3">Order Submitted</h2>
            <p>We've recorded your order of {{ $amountText }}. It will be confirmed shortly once we verify your payment.</p>
        @endif

        <p class="text-muted">Reference: {{ $order->order_number }}</p>

        <a href="{{ route('shop.index') }}" class="btn btn-theme-outline mr-2">Continue Shopping</a>
        <a href="{{ route('checkout.my-orders') }}" class="btn btn-theme mr-2">View My Orders</a>
        @include('checkout._whatsapp-order-button', ['order' => $order, 'setting' => $setting])
    </div>
</div>
</div>

@stop
