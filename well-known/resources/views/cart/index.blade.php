@extends('layouts.front')

@section('title') Shopping Cart @endsection

@section('content')
<style>
    .cart-wrap { padding: 20px 0 50px; max-width: 760px; margin: 0 auto; }
    .cart-wrap h2 { font-size: 22px; font-weight: 700; margin-bottom: 10px; }
    .cart-item { display: flex; gap: 16px; align-items: center; padding: 16px 0; border-bottom: 1px solid #eee; }
    .cart-item img { width: 76px; height: 76px; object-fit: cover; border-radius: 10px; background: #f7f7f7; }
    .cart-item .name { font-weight: 700; }
    .cart-item .variant { color: #888; font-size: 13px; }
    .cart-qty { display: inline-flex; align-items: center; gap: 6px; }
    .cart-qty button { width: 28px; height: 28px; border-radius: 50%; border: none; background: #111; color: #fff; font-weight: 700; }
    .cart-remove-btn { width: 34px; height: 34px; border-radius: 50%; border: none; background: #fdeaea; color: #e34a4a; display: inline-flex; align-items: center; justify-content: center; }
    .cart-summary-row { display: flex; justify-content: space-between; align-items: center; padding: 18px 0; font-weight: 700; font-size: 17px; }
    .cart-checkout-btn { display: block; width: 100%; text-align: center; padding: 14px; border-radius: 30px; background: #0097ff; color: #fff; font-weight: 700; text-decoration: none; }
    .cart-checkout-btn:hover { background: #0078ff; color: #fff; }
    .cart-note { text-align: center; font-size: 12px; color: #999; margin-top: 10px; }
</style>
<div class="breadcrumb-area">
    <div class="container">
        <ul class="page-list">
            <li class="item-home"><a class="bread-link" href="{{ route('home') }}" title="Home">Home</a></li>
            <li class="separator separator-home"></li>
            <li class="item-current">Shopping Cart</li>
        </ul>
        <h1 class="breadcrumb-title">Shopping Cart</h1>
        <ul class="shape-group-code">
            <li class="shape shape-1"><img src="/public/img/bubble-9.png" alt="circle"></li>
            <li class="shape shape-2"><img src="/public/img/bubble-17.png" alt="circle"></li>
            <li class="shape shape-3"><img src="/public/img/line-4.png" alt="circle"></li>
        </ul>
    </div>
</div>


<div class="container cart-wrap">
    <h2>Shopping Cart</h2>

    @if(session('cart_success'))
        <div class="alert alert-success">{{ session('cart_success') }}</div>
    @endif
    @if(session('cart_error'))
        <div class="alert alert-danger">{{ session('cart_error') }}</div>
    @endif

    @if($items->isEmpty())
        <p class="text-muted">Your cart is empty. <a href="{{ route('shop.index') }}">Continue shopping</a></p>
    @else
        @foreach($items as $line)
            <div class="cart-item">
                <img src="{{ $line->product->photo ? '/public/images/media/' . $line->product->photo->file : '/public/img/200x200.png' }}" alt="{{ $line->product->title }}">
                <div class="flex-grow-1">
                    <div class="name">{{ $line->product->title }}</div>
                    @if($line->variant_summary)
                        <div class="variant">{{ $line->variant_summary }}</div>
                    @endif
                    <div class="mt-1">{{ config('shop.currency_symbol') }}{{ number_format($line->unit_price, 2) }}</div>
                </div>

                <form action="{{ route('cart.update') }}" method="POST" class="cart-qty">
                    @csrf
                    <input type="hidden" name="key" value="{{ $line->key }}">
                    <button type="submit" name="quantity" value="{{ $line->quantity - 1 }}">-</button>
                    <span class="px-1">{{ $line->quantity }}</span>
                    <button type="submit" name="quantity" value="{{ $line->quantity + 1 }}">+</button>
                </form>

                <form action="{{ route('cart.remove') }}" method="POST">
                    @csrf
                    <input type="hidden" name="key" value="{{ $line->key }}">
                    <button type="submit" class="cart-remove-btn" title="Remove">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path><path d="M10 11v6"></path><path d="M14 11v6"></path><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path></svg>
                    </button>
                </form>
            </div>
        @endforeach

        <div class="cart-summary-row">
            <span>Subtotal</span>
            <span>{{ config('shop.currency_symbol') }}{{ number_format($subtotal, 2) }}</span>
        </div>

        @auth
            <a href="{{ route('checkout.address') }}" class="cart-checkout-btn">Process to Checkout</a>
        @else
            <a href="{{ route('login') }}" class="cart-checkout-btn">Login to Checkout</a>
        @endauth
        <div class="cart-note">Shipping, Taxes &amp; Discount Calculate At Checkout</div>
    @endif
</div>
@endsection
