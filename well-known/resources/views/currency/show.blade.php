@extends('layouts.front')

@section('title') {{ $listing->currency }} Listing @endsection

@section('content')

<style>
    .cx-wrap { max-width: 640px; margin: 0 auto; padding: 110px 16px 60px; }
    .cx-card { background: #fff; border-radius: 14px; box-shadow: 0 4px 18px rgba(20,30,60,0.06); padding: 28px 30px; }
    .cx-rate-big { font-size: 30px; font-weight: 800; color: #0097ff; }
    .cx-rate-big small { font-size: 14px; font-weight: 600; color: #8a93a3; }
    .cx-info-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f0f2f6; font-size: 14px; }
    .cx-info-row:last-child { border-bottom: none; }
    .btn-theme { background: #0097ff; border-color: #0097ff; color: #fff; }
    .btn-theme:hover, .btn-theme:focus { background: #0080e0; border-color: #0080e0; color: #fff; }
    .p2p-warning { background: #fff6e5; border: 1px solid #f0d99a; color: #7a5b00; border-radius: 10px; padding: 12px 16px; font-size: 12.5px; margin: 16px 0; line-height: 1.6; }
    @media (max-width: 860px) { .cx-wrap { padding-top: 90px; } }
</style>

<div class="cx-wrap">
    <div class="cx-card">

        @if (session('currency_error'))
            <div class="alert alert-danger">{{ session('currency_error') }}</div>
        @endif
        @if (session('currency_success'))
            <div class="alert alert-success">{{ session('currency_success') }}</div>
        @endif

        <div class="cx-rate-big">৳{{ number_format($listing->rate, 2) }} <small>per {{ $listing->currency }}</small></div>

        <div class="my-3">
            <div class="cx-info-row"><span>Seller</span><strong>{{ $listing->seller->name ?? '—' }}</strong></div>
            <div class="cx-info-row"><span>Available</span><strong>{{ number_format($listing->remaining(), 2) }} {{ $listing->currency }}</strong></div>
            @if ($listing->min_order)<div class="cx-info-row"><span>Minimum order</span><strong>{{ number_format($listing->min_order, 2) }} {{ $listing->currency }}</strong></div>@endif
            @if ($listing->max_order)<div class="cx-info-row"><span>Maximum order</span><strong>{{ number_format($listing->max_order, 2) }} {{ $listing->currency }}</strong></div>@endif
        </div>

        @if ($listing->delivery_note)
            <div class="mb-3">
                <strong>Delivery method</strong>
                <p class="text-muted mb-0" style="white-space:pre-line;">{{ $listing->delivery_note }}</p>
            </div>
        @endif

        <div class="p2p-warning">
            <strong>সতর্কবাণী:</strong> এডমিনের পেমেন্ট সিস্টেমের বাইরে কোনো ধরনের আর্থিক লেনদেন করবেন না — যদি করে থাকেন, সেক্ষেত্রে কর্তৃপক্ষ দায়ী থাকবে না।
            <br>
            <strong>Warning:</strong> Do not make any financial transaction outside the admin's payment system — if you do, the authority will not be held responsible.
        </div>

        <hr>

        @auth
            @if ($listing->isBuyable() && auth()->id() !== $listing->user_id)
                <form method="POST" action="{{ route('currency.buy', $listing->id) }}">
                    @csrf
                    <div class="form-group">
                        <label>How much {{ $listing->currency }} do you want to buy?</label>
                        <input type="number" step="0.01" min="0.01" max="{{ $listing->remaining() }}"
                               name="currency_amount" id="cxAmount" class="form-control" required>
                    </div>
                    <p class="text-muted small">You'll pay: ৳<span id="cxTotal">0.00</span></p>
                    <button type="submit" class="btn btn-theme">Buy Now</button>
                </form>
                <script>
                    document.getElementById('cxAmount').addEventListener('input', function () {
                        var rate = {{ (float) $listing->rate }};
                        var amt = parseFloat(this.value) || 0;
                        document.getElementById('cxTotal').textContent = (amt * rate).toFixed(2);
                    });
                </script>
            @elseif (auth()->id() === $listing->user_id)
                <p class="text-muted">This is your own listing.</p>
            @else
                <p class="text-muted">This listing is no longer available.</p>
            @endif
        @else
            <a href="{{ route('login') }}" class="btn btn-theme">Login to Buy</a>
        @endauth

    </div>
</div>

@endsection
