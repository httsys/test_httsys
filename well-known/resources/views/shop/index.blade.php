@extends('layouts.front')

@section('title') Shop @endsection
@section('meta') Explore all products @endsection

@section('content')

<style>
    .shop-title { font-size: 30px; font-weight: 700; margin: 4px 0 20px; }
    .shop-title small { font-size: 15px; font-weight: 400; color: #888; }
    .shop-sidebar { background: #fff; }
    .shop-sidebar h6 { font-weight: 700; margin: 22px 0 12px; }
    .shop-sidebar h6:first-child { margin-top: 0; }
    .shop-sidebar label { display: block; font-size: 14px; color: #444; margin-bottom: 8px; cursor: pointer; }
    .shop-sidebar input[type="radio"], .shop-sidebar input[type="checkbox"] { margin-right: 8px; }
    .shop-price-inputs { display: flex; gap: 10px; margin-bottom: 10px; }
    .shop-price-inputs input { width: 100%; padding: 6px 10px; border: 1px solid #ddd; border-radius: 6px; }
    .product-card { border: 1px solid #eee; border-radius: 10px; overflow: hidden; margin-bottom: 24px; background: #fff; position: relative; transition: box-shadow .2s; }
    .product-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.08); }
    .product-card .thumb { position: relative; height: 200px; overflow: hidden; background: #f7f7f7; }
    .product-card .thumb img { width: 100%; height: 100%; object-fit: cover; }
    .product-card .flash-badge { position: absolute; top: 10px; left: 10px; background: #1a1a2e; color: #fff; font-size: 11px; font-weight: 600; padding: 4px 10px; border-radius: 20px; z-index: 2; }
    .product-card .body { padding: 14px 16px; }
    .product-card .name { font-weight: 600; font-size: 15px; margin: 0 0 6px; color: #222; }
    .product-card .price { font-weight: 700; font-size: 16px; color: #222; }
    .product-card .price del { color: #e74c3c; font-weight: 400; font-size: 13px; margin-left: 6px; }
</style>

<div class="breadcrumb-area">
    <div class="container">
        <ul class="page-list">
            <li class="item-home"><a class="bread-link" href="{{ route('home') }}" title="Home">Home</a></li>
            <li class="separator separator-home"></li>
            <li class="item-current">Shop</li>
        </ul>
        <h1 class="breadcrumb-title">Shop</h1>
        <ul class="shape-group-code">
            <li class="shape shape-1"><img src="/public/img/bubble-9.png" alt="circle"></li>
            <li class="shape shape-2"><img src="/public/img/bubble-17.png" alt="circle"></li>
            <li class="shape shape-3"><img src="/public/img/line-4.png" alt="circle"></li>
        </ul>
    </div>
</div>

<style>
    .p2p-tabbar { max-width: 1140px; margin: 18px auto 0; padding: 0 16px; display: flex; flex-wrap: wrap; gap: 10px; }
    .p2p-tab {
        display: inline-block; padding: 9px 18px; border-radius: 24px; font-weight: 700; font-size: 13.5px;
        text-decoration: none; border: 1.5px solid #e3e6ec; color: #6c7488; background: #fff;
    }
    .p2p-tab:hover { color: #0097ff; text-decoration: none; border-color: #0097ff; }
    .p2p-tab.active { background: #0097ff; border-color: #0097ff; color: #fff; }
</style>
<div class="p2p-tabbar">
    <a href="{{ route('shop.index') }}" class="p2p-tab active">Shop</a>
    <a href="{{ route('currency.index') }}" class="p2p-tab">Currency Exchange</a>
    <a href="{{ route('marketplace.index') }}" class="p2p-tab">Marketplace</a>
    <a href="{{ route('marketplace.index', ['type' => 'auction']) }}" class="p2p-tab">Auctions</a>
</div>

<div class="blog-page-section">
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="shop-sidebar">
                <h6>Sort By</h6>
                <form method="GET" action="{{ route('shop.index') }}" id="shopFilterForm">
                    @foreach(request()->except(['sort','page']) as $k => $v)
                        @if(is_array($v))
                            @foreach($v as $vv)
                                <input type="hidden" name="{{ $k }}[]" value="{{ $vv }}">
                            @endforeach
                        @else
                            <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                        @endif
                    @endforeach

                    <label><input type="radio" name="sort" value="newest" onchange="this.form.submit()" {{ request('sort', 'newest') == 'newest' ? 'checked' : '' }}> Newest</label>
                    <label><input type="radio" name="sort" value="price_low" onchange="this.form.submit()" {{ request('sort') == 'price_low' ? 'checked' : '' }}> Price Low To High</label>
                    <label><input type="radio" name="sort" value="price_high" onchange="this.form.submit()" {{ request('sort') == 'price_high' ? 'checked' : '' }}> Price High To Low</label>
                </form>

                <h6>Price</h6>
                <form method="GET" action="{{ route('shop.index') }}">
                    @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif
                    @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                    @foreach((array) request('brand', []) as $b) <input type="hidden" name="brand[]" value="{{ $b }}"> @endforeach
                    <div class="shop-price-inputs">
                        <input type="number" name="min_price" min="0" placeholder="0" value="{{ request('min_price') }}">
                        <input type="number" name="max_price" min="0" placeholder="{{ (int) $priceMax }}" value="{{ request('max_price') }}">
                    </div>
                    <button type="submit" class="btn btn-sm btn-outline-dark btn-block">Apply</button>
                </form>

                @if($categories->count())
                <h6>Category</h6>
                <form method="GET" action="{{ route('shop.index') }}">
                    @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif
                    @foreach($categories as $cat)
                        <label>
                            <input type="radio" name="category" value="{{ $cat->slug }}" onchange="this.form.submit()" {{ request('category') == $cat->slug ? 'checked' : '' }}>
                            {{ $cat->name }}
                        </label>
                    @endforeach
                    @if(request('category'))
                        <a href="{{ route('shop.index') }}" class="small">Clear category</a>
                    @endif
                </form>
                @endif

                @if($brands->count())
                <h6>Brand</h6>
                <form method="GET" action="{{ route('shop.index') }}">
                    @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif
                    @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                    @foreach($brands as $brand)
                        <label>
                            <input type="checkbox" name="brand[]" value="{{ $brand->id }}" onchange="this.form.submit()" {{ in_array($brand->id, (array) request('brand', [])) ? 'checked' : '' }}>
                            {{ $brand->name }}
                        </label>
                    @endforeach
                </form>
                @endif
            </div>
        </div>

        <div class="col-lg-9 col-md-8">
            <div class="shop-title">Explore All Products <small>({{ $products->total() }} Products Found)</small></div>

            <div class="row">
                @forelse($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <a href="{{ route('shop.show', $product->slug) }}" class="text-decoration-none">
                            <div class="product-card">
                                <div class="thumb">
                                    @if($product->is_flash_sale)
                                        <span class="flash-badge">Flash Sale</span>
                                    @endif
                                    <img src="{{ $product->photo ? '/public/images/media/' . $product->photo->file : '/public/img/200x200.png' }}" alt="{{ $product->title }}">
                                </div>
                                <div class="body">
                                    <p class="name">{{ $product->title }}</p>
                                    <div class="price">
                                        {{ number_format($product->effective_price, 2) }}
                                        @if($product->sale_price && $product->sale_price < $product->price)
                                            <del>{{ number_format($product->price, 2) }}</del>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">এই মুহূর্তে কোনো প্রোডাক্ট পাওয়া যায়নি।</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-3">
                {!! $products->onEachSide(1)->links() !!}
            </div>
        </div>
    </div>
</div>
</div>

@endsection
