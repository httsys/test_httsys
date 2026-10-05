@extends('layouts.front')

@section('title') Checkout — Shipping Address @endsection

@section('content')
<style>
    .co-wrap { padding: 20px 0 50px; max-width: 980px; margin: 0 auto; overflow-x: hidden; }
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
    .co-card h4 { font-size: 20px; font-weight: 700; color: #111; margin: 0 0 18px 0; }

    .co-toggle { display: inline-flex; background: #f1f3f8; border-radius: 30px; padding: 4px; margin-bottom: 24px; }
    .co-toggle button { border: none; background: transparent; padding: 8px 22px; border-radius: 30px; font-weight: 600; color: #555; }
    .co-toggle button.active { background: #0097ff; color: #fff; }

    .co-section-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; }
    .co-addnew-btn { border: none; background: transparent; color: #0097ff; font-weight: 700; padding: 8px 18px; border-radius: 30px; }
.btn-theme { background: #0097ff; border-color: #0097ff; color: #fff; }
.btn-theme:hover, .btn-theme:focus { background: #0080e0; border-color: #0080e0; color: #fff; }
.btn-theme-outline { background: #fff; border: 1.5px solid #0097ff; color: #0097ff; }
.btn-theme-outline:hover, .btn-theme-outline:focus { background: #eaf4ff; color: #0097ff; }

    .addr-card { border: 1px solid #e2e6ee; border-radius: 12px; padding: 16px; margin-bottom: 14px; cursor: pointer; }
    .addr-card.selected { border-color: #0097ff; background: #eaf4ff; }

    .co-coupon-row { display: flex; align-items: center; justify-content: space-between; cursor: pointer; color: #0097ff; font-weight: 700; }
    .co-coupon-applied { display: flex; align-items: center; justify-content: space-between; }
    .co-coupon-form { display: none; gap: 10px; margin-top: 12px; }

    .co-summary-row { display: flex; justify-content: space-between; padding: 6px 0; font-size: 14px; color: #555; }
    .co-summary-total { display: flex; justify-content: space-between; font-weight: 700; font-size: 18px; border-top: 1px solid #eee; padding-top: 12px; margin-top: 8px; color: #111; }

    #addNewAddressForm { display: {{ $addresses->isEmpty() ? 'block' : 'none' }}; }
    #pickupPanel { display: none; }
</style>
<div class="breadcrumb-area">
    <div class="container">
        <ul class="page-list">
            <li class="item-home"><a class="bread-link" href="{{ route('home') }}" title="Home">Home</a></li>
            <li class="separator separator-home"></li>
            <li class="item-current">Shipping Address</li>
        </ul>
        <h1 class="breadcrumb-title">Shipping Address</h1>
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
        <div class="co-step active"><div class="dot">2</div><div class="label">Checkout</div></div>
        <div class="co-line"></div>
        <div class="co-step"><div class="dot">3</div><div class="label">Payment</div></div>
    </div>

    <h4 class="mb-3">Provide Your Shipping Information</h4>

    <div class="co-toggle">
        <button type="button" id="toggleDelivery" class="active" onclick="setOrderType('delivery')">Delivery</button>
        <button type="button" id="togglePickup" onclick="setOrderType('pickup')">Pick Up</button>
    </div>

    @if(session('cart_success'))
        <div class="alert alert-success">{{ session('cart_success') }}</div>
    @endif
    @if(session('cart_error'))
        <div class="alert alert-danger">{{ session('cart_error') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">

            <div id="deliveryPanel">
                <div class="co-card">
                    <div class="co-section-head">
                        <h6 class="mb-0" style="margin-bottom:0 !important;"><span class="co-card-icon">📍</span> Shipping Address</h6>
                        <button type="button" class="co-addnew-btn" onclick="document.getElementById('addNewAddressForm').style.display='block'; this.style.display='none';">+ Add New</button>
                    </div>

                    <form action="{{ route('checkout.payment') }}" method="GET" id="addrSelectForm">
                        <input type="hidden" name="type" value="delivery">
                        @if($addresses->isEmpty())
                            <p class="text-muted">You don't have a saved address yet. Add one below.</p>
                        @else
                            @foreach($addresses as $address)
                                <label class="addr-card d-block {{ $loop->first ? 'selected' : '' }}">
                                    <input type="radio" name="id" value="{{ $address->id }}" {{ $loop->first ? 'checked' : '' }} style="margin-right:8px;" onchange="document.querySelectorAll('#deliveryPanel .addr-card').forEach(c=>c.classList.remove('selected'));this.closest('.addr-card').classList.add('selected');">
                                    <strong>{{ $address->name }}</strong><br>
                                    {{ $address->phone }}@if($address->email), {{ $address->email }}@endif<br>
                                    {{ $address->city }}, {{ $address->state }}, {{ $address->country }}<br>
                                    {{ $address->address_line }}@if($address->postal_code), {{ $address->postal_code }}@endif
                                </label>
                            @endforeach

                            <button type="submit" class="btn btn-theme rounded-pill px-4 mt-2">Continue to Payment</button>
                        @endif
                    </form>

                    <div id="addNewAddressForm" class="mt-4">
                        <h6 class="mb-3">Add New Address</h6>
                        <form action="{{ route('checkout.address.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group"><label>Full Name</label><input name="name" class="form-control" required value="{{ old('name', auth()->user()->name) }}"></div>
                                <div class="col-md-6 form-group"><label>Phone</label><input name="phone" class="form-control" required value="{{ old('phone', auth()->user()->phone) }}"></div>
                                <div class="col-md-6 form-group"><label>Email (optional)</label><input name="email" type="email" class="form-control" value="{{ old('email', auth()->user()->email) }}"></div>
                                <div class="col-md-6 form-group"><label>Country</label><input name="country" class="form-control" required value="{{ old('country', 'Bangladesh') }}"></div>
                                <div class="col-md-6 form-group"><label>State / Division</label><input name="state" class="form-control" required value="{{ old('state') }}"></div>
                                <div class="col-md-6 form-group"><label>City</label><input name="city" class="form-control" required value="{{ old('city') }}"></div>
                                <div class="col-md-8 form-group"><label>Address (House/Road/Block)</label><input name="address_line" class="form-control" required value="{{ old('address_line') }}"></div>
                                <div class="col-md-4 form-group"><label>Postal Code</label><input name="postal_code" class="form-control" value="{{ old('postal_code') }}"></div>
                            </div>
                            <button type="submit" class="btn btn-theme-outline rounded-pill px-4">Save Address</button>
                        </form>
                    </div>
                </div>
            </div>

            <div id="pickupPanel">
                <div class="co-card">
                    <h6><span class="co-card-icon">🏬</span> Store Location</h6>
                    <form action="{{ route('checkout.payment') }}" method="GET">
                        <input type="hidden" name="type" value="pickup">
                        @if($pickupLocations->isEmpty())
                            <p class="text-muted">No pickup locations are set up yet — please choose Delivery instead.</p>
                        @else
                            @foreach($pickupLocations as $location)
                                <label class="addr-card d-block {{ $loop->first ? 'selected' : '' }}">
                                    <input type="radio" name="id" value="{{ $location->id }}" {{ $loop->first ? 'checked' : '' }} style="margin-right:8px;" onchange="document.querySelectorAll('#pickupPanel .addr-card').forEach(c=>c.classList.remove('selected'));this.closest('.addr-card').classList.add('selected');">
                                    <strong>{{ $location->name }}</strong> — {{ $location->full_address }}
                                </label>
                            @endforeach
                            <button type="submit" class="btn btn-theme rounded-pill px-4 mt-2">Continue to Payment</button>
                        @endif
                    </form>
                </div>
            </div>

            <div class="co-card">
                @if($appliedCoupon)
                    <div class="co-coupon-applied">
                        <span>🏷️ Coupon <strong>{{ $appliedCoupon->code }}</strong> applied — {{ $appliedCoupon->type == 'percent' ? $appliedCoupon->value . '% off' : config('shop.currency_symbol') . number_format($appliedCoupon->value, 2) . ' off' }}</span>
                        <form action="{{ route('checkout.coupon.remove') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link text-danger p-0">Remove</button>
                        </form>
                    </div>
                @else
                    <div class="co-coupon-row" onclick="document.getElementById('couponForm').style.display='flex';">
                        <span>🏷️ Apply Coupon Code — Get discount with your order</span>
                        <span>›</span>
                    </div>
                    <form id="couponForm" class="co-coupon-form" action="{{ route('checkout.coupon.apply') }}" method="POST">
                        @csrf
                        <input type="text" name="code" placeholder="Enter coupon code" class="form-control" style="text-transform:uppercase;" required>
                        <button type="submit" class="btn btn-theme rounded-pill px-3">Apply</button>
                    </form>
                @endif
            </div>

        </div>

        <div class="col-lg-4">
            <div class="co-card">
                <h6><span class="co-card-icon">🧾</span> Order Summary</h6>
                <div class="co-summary-row"><span>Subtotal</span><span>{{ config('shop.currency_symbol') }}{{ number_format($totals['subtotal'], 2) }}</span></div>
                <div class="co-summary-row"><span>Tax</span><span>{{ config('shop.currency_symbol') }}{{ number_format($totals['tax'], 2) }}</span></div>
                <div class="co-summary-row"><span>Shipping Charge</span><span>{{ config('shop.currency_symbol') }}{{ number_format($totals['shipping_charge'], 2) }}</span></div>
                <div class="co-summary-row"><span>Discount</span><span>-{{ config('shop.currency_symbol') }}{{ number_format($totals['discount'], 2) }}</span></div>
                <div class="co-summary-total"><span>Total</span><span>{{ config('shop.currency_symbol') }}{{ number_format($totals['total'], 2) }}</span></div>
            </div>
        </div>
    </div>
</div>

<script>
    function setOrderType(type) {
        var deliveryBtn = document.getElementById('toggleDelivery');
        var pickupBtn = document.getElementById('togglePickup');
        var deliveryPanel = document.getElementById('deliveryPanel');
        var pickupPanel = document.getElementById('pickupPanel');

        if (type === 'pickup') {
            pickupBtn.classList.add('active');
            deliveryBtn.classList.remove('active');
            pickupPanel.style.display = 'block';
            deliveryPanel.style.display = 'none';
        } else {
            deliveryBtn.classList.add('active');
            pickupBtn.classList.remove('active');
            deliveryPanel.style.display = 'block';
            pickupPanel.style.display = 'none';
        }
    }
</script>
@endsection
