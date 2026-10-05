@extends('layouts.front')

@section('title') Currency Exchange @endsection

@section('content')

<style>
    .cx-wrap { max-width: 1140px; margin: 0 auto; padding: 110px 16px 60px; }
    .cx-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
    .cx-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 16px; }
    .cx-card { background: #fff; border-radius: 14px; box-shadow: 0 4px 18px rgba(20,30,60,0.06); padding: 20px; }
    .cx-currency { font-weight: 800; font-size: 20px; color: #0097ff; }
    .cx-rate { font-size: 22px; font-weight: 800; color: #1a1a1a; margin: 6px 0; }
    .cx-rate small { font-size: 13px; font-weight: 600; color: #8a93a3; }
    .cx-meta { font-size: 12.5px; color: #8a93a3; margin-bottom: 14px; }
    .cx-empty { text-align: center; color: #9aa3b5; padding: 60px 10px; }
    .btn-theme { background: #0097ff; border-color: #0097ff; color: #fff; }
    .btn-theme:hover, .btn-theme:focus { background: #0080e0; border-color: #0080e0; color: #fff; }
    .btn-theme-outline { background: #fff; border: 1.5px solid #0097ff; color: #0097ff; }
    .btn-theme-outline:hover, .btn-theme-outline:focus { background: #eaf4ff; color: #0097ff; }
    @media (max-width: 860px) { .cx-wrap { padding-top: 90px; } }
    .p2p-tabbar { max-width: 1140px; margin: 0 auto 18px; display: flex; flex-wrap: wrap; gap: 10px; }
    .p2p-tab {
        display: inline-block; padding: 9px 18px; border-radius: 24px; font-weight: 700; font-size: 13.5px;
        text-decoration: none; border: 1.5px solid #e3e6ec; color: #6c7488; background: #fff;
    }
    .p2p-tab:hover { color: #0097ff; text-decoration: none; border-color: #0097ff; }
    .p2p-tab.active { background: #0097ff; border-color: #0097ff; color: #fff; }
</style>

<div class="cx-wrap">
    <div class="p2p-tabbar">
        <a href="{{ route('shop.index') }}" class="p2p-tab">Shop</a>
        <a href="{{ route('currency.index') }}" class="p2p-tab active">Currency Exchange</a>
        <a href="{{ route('marketplace.index') }}" class="p2p-tab">Marketplace</a>
        <a href="{{ route('marketplace.index', ['type' => 'auction']) }}" class="p2p-tab">Auctions</a>
    </div>

    <div class="cx-header">
        <div>
            <h2 style="margin-bottom:2px;">Currency Exchange</h2>
            <p class="text-muted mb-0">Buy or sell dollars directly with other users. Payments are held by admin until confirmed.</p>
        </div>
        @auth
            <a href="{{ route('currency.create') }}" class="btn btn-theme">+ Post a Listing</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-theme">Login to Sell</a>
        @endauth
    </div>

    @if ($listings->isEmpty())
        <div class="cx-empty">No active listings right now.</div>
    @else
        <div class="cx-grid">
            @foreach ($listings as $listing)
                <a href="{{ route('currency.show', $listing->id) }}" class="cx-card" style="text-decoration:none; color:inherit; display:block;">
                    <div class="cx-currency">{{ $listing->currency }}</div>
                    <div class="cx-rate">৳{{ number_format($listing->rate, 2) }} <small>/ {{ $listing->currency }}</small></div>
                    <div class="cx-meta">
                        {{ number_format($listing->remaining(), 2) }} {{ $listing->currency }} available<br>
                        Seller: {{ $listing->seller->name ?? '—' }}
                    </div>
                    <span class="btn btn-theme-outline btn-sm">View & Buy</span>
                </a>
            @endforeach
        </div>
        <div class="mt-4">{!! $listings->render() !!}</div>
    @endif

</div>

@endsection
