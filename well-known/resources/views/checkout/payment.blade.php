@extends('layouts.front')

@section('title') Checkout — Payment @endsection

@section('content')
<style>
    .co-wrap { padding: 20px 0 40px; overflow-x: hidden; }
    .co-steps { display: flex; align-items: flex-start; justify-content: center; gap: 0; margin: 30px 0 40px; }
.co-step { display: flex; flex-direction: column; align-items: center; width: 90px; flex-shrink: 0; }
.co-step .dot { width: 32px; height: 32px; border-radius: 50%; background: #e2e6ee; color: #888; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0; font-size: 13px; }
.co-step.done .dot, .co-step.active .dot { background: #12b76a; color: #fff; }
.co-step .label { margin-top: 8px; font-size: 12px; color: #888; text-align: center; }
.co-step.active .label { color: #12b76a; font-weight: 700; }
.co-line { flex: 1 1 auto; height: 2px; background: #e2e6ee; margin-top: 16px; min-width: 14px; max-width: 80px; }
.co-line.done { background: #12b76a; }
@media (max-width: 480px) {
    .co-step { width: 62px; }
    .co-step .dot { width: 26px; height: 26px; font-size: 11px; }
    .co-step .label { font-size: 10px; }
    .co-line { max-width: 26px; }
}

    .co-card { background: #fff; border: 1.5px solid #d7dbe3; border-radius: 14px; box-shadow: 0 2px 14px rgba(20,20,43,0.08); padding: 24px 26px; margin-bottom: 20px; }
    .co-card h6 { font-size: 15px; font-weight: 700; color: #111; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px; }
    .co-card h6 .co-card-icon { width: 26px; height: 26px; border-radius: 8px; background: #eaf4ff; color: #0097ff; display: inline-flex; align-items: center; justify-content: center; font-size: 14px; }

    .pm-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
@media (min-width: 576px) {
    .pm-grid { grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 14px; }
}
    .pm-card { border: 1px solid #e2e6ee; border-radius: 12px; padding: 16px 10px; text-align: center; cursor: pointer; display: block; }
    .pm-card.active { border-color: #0097ff; background: #f2f9ff; }
    .pm-card.disabled { opacity: .45; cursor: not-allowed; }
    .pm-card .pm-name { margin-top: 8px; font-size: 13px; font-weight: 600; }

    .co-summary-row { display: flex; justify-content: space-between; padding: 6px 0; font-size: 14px; color: #555; }
    .co-summary-total { display: flex; justify-content: space-between; font-weight: 700; font-size: 18px; border-top: 1px solid #eee; padding-top: 12px; margin-top: 8px; color: #111; }
    .btn-theme { background: #0097ff; border-color: #0097ff; color: #fff; }
.btn-theme:hover, .btn-theme:focus { background: #0080e0; border-color: #0080e0; color: #fff; }
</style>
<div class="breadcrumb-area">
    <div class="container">
        <ul class="page-list">
            <li class="item-home"><a class="bread-link" href="{{ route('home') }}" title="Home">Home</a></li>
            <li class="separator separator-home"></li>
            <li class="item-current">Payment</li>
        </ul>
        <h1 class="breadcrumb-title">Payment</h1>
        <ul class="shape-group-code">
            <li class="shape shape-1"><img src="/public/img/bubble-9.png" alt="circle"></li>
            <li class="shape shape-2"><img src="/public/img/bubble-17.png" alt="circle"></li>
            <li class="shape shape-3"><img src="/public/img/line-4.png" alt="circle"></li>
        </ul>
    </div>
</div>


<div class="container co-wrap">
    <div class="co-steps">
        <div class="co-step done"><div class="dot">✓</div><div class="label">Cart</div></div>
        <div class="co-line done"></div>
        <div class="co-step done"><div class="dot">✓</div><div class="label">Checkout</div></div>
        <div class="co-line done"></div>
        <div class="co-step active"><div class="dot">3</div><div class="label">Payment</div></div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="co-card">
                <h6><span class="co-card-icon">💳</span> Select Payment Method</h6>

                @include('includes.form-errors')

                <form action="{{ route('checkout.place') }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_type" value="{{ $orderType }}">
                    @if($orderType === 'pickup')
                        <input type="hidden" name="pickup_location_id" value="{{ $pickupLocation->id }}">
                    @else
                        <input type="hidden" name="address_id" value="{{ $address->id }}">
                    @endif
                    <input type="hidden" name="payment_option" id="paymentOptionInput" value="cod">

                    <div class="pm-grid mb-3">
                        <label class="pm-card active" data-value="cod">
                            <div>💵</div>
                            <div class="pm-name">Cash On Delivery</div>
                        </label>

                        {{-- Payment methods the admin created and marked
                             Active from Shop > Payment Methods. These are
                             real, selectable options. --}}
                        @foreach($enabledMethods as $method)
                            <label class="pm-card" data-value="pm_{{ $method->id }}">
                                <div>📱</div>
                                <div class="pm-name">{{ $method->name }}</div>
                            </label>
                        @endforeach

                        {{-- Everything else stays exactly as it was before —
                             a locked "coming soon" placeholder. --}}
                        @foreach($lockedPlaceholders as $name)
                            <div class="pm-card disabled" title="Coming soon">
                                <div>🔒</div>
                                <div class="pm-name">{{ $name }}</div>
                            </div>
                        @endforeach
                    </div>

                    @if($orderType === 'pickup')
                        <p class="text-muted small">Pick up from: {{ $pickupLocation->name }}, {{ $pickupLocation->city }}</p>
                    @else
                        <p class="text-muted small">Shipping to: {{ $address->name }}, {{ $address->city }}, {{ $address->country }}</p>
                    @endif

                    <button type="submit" class="btn btn-theme rounded-pill px-4">Place Order</button>
                    <a href="{{ route('checkout.address') }}" class="btn btn-link">Back to Checkout</a>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="co-card">
                <h6><span class="co-card-icon">🧾</span> Order Summary</h6>
                <div class="co-summary-row"><span>Subtotal</span><span>{{ config('shop.currency_symbol') }}{{ number_format($totals['subtotal'], 2) }}</span></div>
                <div class="co-summary-row"><span>Tax</span><span>{{ config('shop.currency_symbol') }}{{ number_format($totals['tax'], 2) }}</span></div>
                <div class="co-summary-row"><span>Shipping Charge</span><span>{{ config('shop.currency_symbol') }}{{ number_format($totals['shipping_charge'], 2) }}</span></div>
                <div class="co-summary-row"><span>Discount</span><span>{{ config('shop.currency_symbol') }}{{ number_format($totals['discount'], 2) }}</span></div>
                <div class="co-summary-total"><span>Total</span><span>{{ config('shop.currency_symbol') }}{{ number_format($totals['total'], 2) }}</span></div>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    var input = document.getElementById('paymentOptionInput');
    var cards = document.querySelectorAll('.pm-card:not(.disabled)');

    cards.forEach(function (card) {
        card.addEventListener('click', function () {
            cards.forEach(function (c) { c.classList.remove('active'); });
            card.classList.add('active');
            input.value = card.getAttribute('data-value');
        });
    });
})();
</script>
@endsection
