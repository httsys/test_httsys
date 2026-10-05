@extends('layouts.front')

@section('title') {{ $listing->title }} @endsection

@section('content')

<style>
    .mk-wrap { max-width: 720px; margin: 0 auto; padding: 110px 16px 60px; }
    .mk-card { background: #fff; border-radius: 14px; box-shadow: 0 4px 18px rgba(20,30,60,0.06); padding: 28px 30px; }
    .mk-img-big { width: 100%; max-height: 360px; object-fit: cover; border-radius: 10px; background: #f4f7fc; margin-bottom: 16px; }
    .mk-price-big { font-size: 28px; font-weight: 800; color: #0097ff; }
    .mk-info-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f0f2f6; font-size: 14px; }
    .mk-info-row:last-child { border-bottom: none; }
    .bid-row { display: flex; justify-content: space-between; padding: 6px 0; font-size: 13.5px; border-bottom: 1px solid #f5f6fa; }
    .btn-theme { background: #0097ff; border-color: #0097ff; color: #fff; }
    .btn-theme:hover, .btn-theme:focus { background: #0080e0; border-color: #0080e0; color: #fff; }
    .p2p-warning { background: #fff6e5; border: 1px solid #f0d99a; color: #7a5b00; border-radius: 10px; padding: 12px 16px; font-size: 12.5px; margin: 16px 0; line-height: 1.6; }
    @media (max-width: 860px) { .mk-wrap { padding-top: 90px; } }
</style>

<div class="mk-wrap">
    <div class="mk-card">

        @if (session('marketplace_error'))
            <div class="alert alert-danger">{{ session('marketplace_error') }}</div>
        @endif
        @if (session('marketplace_success'))
            <div class="alert alert-success">{{ session('marketplace_success') }}</div>
        @endif

        <img class="mk-img-big" src="{{ $listing->photo ? '/public/images/media/' . $listing->photo->file : 'https://placehold.co/700x400?text=No+Image' }}" alt="{{ $listing->title }}">

        <h3>{{ $listing->title }}</h3>
        @if ($listing->description)
            <p class="text-muted" style="white-space: pre-line;">{{ $listing->description }}</p>
        @endif

        @if ($listing->listing_type === 'fixed')
            <div class="mk-price-big">৳{{ number_format($listing->price, 2) }}</div>
        @else
            <div class="mk-price-big">৳{{ number_format($listing->current_bid ?: $listing->starting_price, 2) }}</div>
            <p class="text-muted small mb-3">{{ $listing->current_bid ? 'Current highest bid' : 'Starting bid, no bids yet' }}</p>
        @endif

        <div class="my-3">
            <div class="mk-info-row"><span>Seller</span><strong>{{ $listing->seller->name ?? '—' }}</strong></div>
            @if ($listing->listing_type === 'fixed')
                <div class="mk-info-row"><span>Available</span><strong>{{ $listing->remainingQuantity() }}</strong></div>
            @else
                <div class="mk-info-row"><span>Ends</span><strong>{{ $listing->ends_at ? $listing->ends_at->format('d M Y, h:i A') : '—' }}</strong></div>
                @if ($listing->ends_at)
                    <div class="mk-info-row"><span>Time left</span><strong class="mk-countdown" data-ends-at="{{ $listing->ends_at->toIso8601String() }}">…</strong></div>
                @endif
                <div class="mk-info-row"><span>Status</span><strong>{{ ucfirst($listing->status) }}</strong></div>
            @endif
            @if ($listing->isDigital())
                <div class="mk-info-row"><span>Delivery</span><strong>Digital</strong></div>
            @endif
        </div>

        <div class="p2p-warning">
            <strong>সতর্কবাণী:</strong> এডমিনের পেমেন্ট সিস্টেমের বাইরে কোনো ধরনের আর্থিক লেনদেন করবেন না — যদি করে থাকেন, সেক্ষেত্রে কর্তৃপক্ষ দায়ী থাকবে না।
            <br>
            <strong>Warning:</strong> Do not make any financial transaction outside the admin's payment system — if you do, the authority will not be held responsible.
        </div>

        <hr>

        @if ($listing->listing_type === 'fixed')
            @auth
                @if ($listing->isBuyable() && auth()->id() !== $listing->user_id)
                    <form method="POST" action="{{ route('marketplace.buy', $listing->id) }}">
                        @csrf
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" min="1" max="{{ $listing->remainingQuantity() }}" name="quantity" value="1" class="form-control" style="max-width:120px;">
                        </div>
                        <button type="submit" class="btn btn-theme">Buy Now</button>
                    </form>
                @elseif (auth()->id() === $listing->user_id)
                    <p class="text-muted">This is your own listing.</p>
                @else
                    <p class="text-muted">This listing is no longer available.</p>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-theme">Login to Buy</a>
            @endauth
        @else
            @auth
                @if ($listing->isBuyable() && auth()->id() !== $listing->user_id)
                    <form method="POST" action="{{ route('marketplace.bid', $listing->id) }}">
                        @csrf
                        <div class="form-group">
                            <label>Your bid (minimum ৳{{ number_format($listing->minimumNextBid(), 2) }})</label>
                            <input type="number" step="0.01" min="{{ $listing->minimumNextBid() }}" name="amount" class="form-control" style="max-width:220px;" required>
                        </div>
                        <button type="submit" class="btn btn-theme">Place Bid</button>
                    </form>
                @elseif (auth()->id() === $listing->user_id)
                    <p class="text-muted">This is your own auction.</p>
                @else
                    <p class="text-muted">This auction has ended.</p>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-theme">Login to Bid</a>
            @endauth

            {{-- Visible to everyone, logged in or not — not just the bidder. --}}
            @if ($listing->bids->isNotEmpty())
                <h6 class="mt-4">Bid history</h6>
                @foreach ($listing->bids as $bid)
                    <div class="bid-row">
                        <span>{{ $bid->bidder->name ?? 'Deleted user' }}</span>
                        <span>
                            <strong>৳{{ number_format($bid->amount, 2) }}</strong>
                            <span class="text-muted" style="font-size:11.5px;"> · {{ $bid->created_at->format('d M Y, h:i A') }}</span>
                        </span>
                    </div>
                @endforeach
            @endif
        @endif

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function render(el) {
        var end = new Date(el.getAttribute('data-ends-at')).getTime();
        var diff = end - Date.now();

        if (diff <= 0) { el.textContent = 'Auction ended'; return false; }

        var d = Math.floor(diff / 86400000);
        var h = Math.floor((diff % 86400000) / 3600000);
        var m = Math.floor((diff % 3600000) / 60000);
        var s = Math.floor((diff % 60000) / 1000);

        var parts = [];
        if (d > 0) { parts.push(d + 'd'); }
        parts.push((h < 10 ? '0' : '') + h + 'h');
        parts.push((m < 10 ? '0' : '') + m + 'm');
        if (d === 0) { parts.push((s < 10 ? '0' : '') + s + 's'); }

        el.textContent = parts.join(' ') + ' left';
        return true;
    }

    var timers = Array.prototype.slice.call(document.querySelectorAll('.mk-countdown'));
    timers.forEach(render);
    setInterval(function () {
        timers.forEach(function (el) {
            if (!render(el)) { el.classList.add('text-danger'); }
        });
    }, 1000);
});
</script>

@endsection
