@extends('layouts.front')

@section('title') Marketplace @endsection

@section('content')

<style>
    .mk-wrap { max-width: 1140px; margin: 0 auto; padding: 110px 16px 60px; }
    .mk-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
    .mk-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 16px; }
    .mk-card { background: #fff; border-radius: 14px; box-shadow: 0 4px 18px rgba(20,30,60,0.06); overflow: hidden; text-decoration: none; color: inherit; display: block; }
    .mk-card:hover { color: inherit; text-decoration: none; }
    .mk-img { width: 100%; height: 160px; object-fit: cover; background: #f4f7fc; }
    .mk-body { padding: 14px 16px; }
    .mk-title { font-weight: 700; font-size: 14.5px; color: #1a1a1a; margin-bottom: 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .mk-price { font-weight: 800; font-size: 17px; color: #0097ff; }
    .mk-badge { display: inline-block; font-size: 10.5px; font-weight: 700; border-radius: 20px; padding: 2px 9px; margin-bottom: 6px; }
    .mk-badge-fixed { background: #e5f8ee; color: #0f9d58; }
    .mk-badge-auction { background: #fef3d7; color: #b98900; }
    .mk-empty { text-align: center; color: #9aa3b5; padding: 60px 10px; }
    .btn-theme { background: #0097ff; border-color: #0097ff; color: #fff; }
    .btn-theme:hover, .btn-theme:focus { background: #0080e0; border-color: #0080e0; color: #fff; }
    @media (max-width: 860px) { .mk-wrap { padding-top: 90px; } }
    .p2p-tabbar { max-width: 1140px; margin: 0 auto 18px; display: flex; flex-wrap: wrap; gap: 10px; }
    .p2p-tab {
        display: inline-block; padding: 9px 18px; border-radius: 24px; font-weight: 700; font-size: 13.5px;
        text-decoration: none; border: 1.5px solid #e3e6ec; color: #6c7488; background: #fff;
    }
    .p2p-tab:hover { color: #0097ff; text-decoration: none; border-color: #0097ff; }
    .p2p-tab.active { background: #0097ff; border-color: #0097ff; color: #fff; }
</style>

<div class="mk-wrap">
    <div class="p2p-tabbar">
        <a href="{{ route('shop.index') }}" class="p2p-tab">Shop</a>
        <a href="{{ route('currency.index') }}" class="p2p-tab">Currency Exchange</a>
        <a href="{{ route('marketplace.index') }}" class="p2p-tab {{ request('type') !== 'auction' ? 'active' : '' }}">Marketplace</a>
        <a href="{{ route('marketplace.index', ['type' => 'auction']) }}" class="p2p-tab {{ request('type') === 'auction' ? 'active' : '' }}">Auctions</a>
    </div>

    <div class="mk-header">
        <div>
            <h2 style="margin-bottom:2px;">Marketplace</h2>
            <p class="text-muted mb-0">Physical and digital products, sold fixed-price or by auction.</p>
        </div>
        @auth
            <a href="{{ route('marketplace.create') }}" class="btn btn-theme">+ Post a Listing</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-theme">Login to Sell</a>
        @endauth
    </div>

    <div class="mb-3">
        <a href="{{ route('marketplace.index') }}" class="btn btn-sm {{ request('type') ? 'btn-outline-secondary' : 'btn-secondary' }}">All</a>
        <a href="{{ route('marketplace.index', ['type' => 'fixed']) }}" class="btn btn-sm {{ request('type') == 'fixed' ? 'btn-secondary' : 'btn-outline-secondary' }}">Fixed Price</a>
        <a href="{{ route('marketplace.index', ['type' => 'auction']) }}" class="btn btn-sm {{ request('type') == 'auction' ? 'btn-secondary' : 'btn-outline-secondary' }}">Auctions</a>
    </div>

    @if ($listings->isEmpty())
        <div class="mk-empty">No listings right now.</div>
    @else
        <div class="mk-grid">
            @foreach ($listings as $listing)
                <a href="{{ route('marketplace.show', $listing->id) }}" class="mk-card">
                    <img class="mk-img" src="{{ $listing->photo ? '/public/images/media/' . $listing->photo->file : 'https://placehold.co/400x300?text=No+Image' }}" alt="{{ $listing->title }}">
                    <div class="mk-body">
                        <span class="mk-badge {{ $listing->listing_type === 'auction' ? 'mk-badge-auction' : 'mk-badge-fixed' }}">
                            {{ $listing->listing_type === 'auction' ? 'Auction' : 'Fixed Price' }}
                        </span>
                        <div class="mk-title">{{ $listing->title }}</div>
                        @if ($listing->listing_type === 'fixed')
                            <div class="mk-price">৳{{ number_format($listing->price, 2) }}</div>
                        @else
                            <div class="mk-price">৳{{ number_format($listing->current_bid ?: $listing->starting_price, 2) }}</div>
                            <div class="small text-muted">{{ $listing->bids->count() }} bids · <span class="mk-countdown" data-ends-at="{{ $listing->ends_at->toIso8601String() }}">…</span></div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-4">{!! $listings->render() !!}</div>
    @endif

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function render(el) {
        var end = new Date(el.getAttribute('data-ends-at')).getTime();
        var now = Date.now();
        var diff = end - now;

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
