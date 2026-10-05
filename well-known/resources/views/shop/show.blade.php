@extends('layouts.front')

@section('title') {{ $product->meta_title ?: $product->title }} @endsection
@section('meta') {{ $product->meta_description ?: $product->short_description }} @endsection

@section('content')

@php
    // Try to turn a pasted YouTube / Facebook link into an embeddable URL.
    $embedUrl = null;
    if ($product->video_url) {
        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([A-Za-z0-9_-]{6,})/', $product->video_url, $m)) {
            $embedUrl = 'https://www.youtube.com/embed/' . $m[1];
        } elseif (strpos($product->video_url, 'facebook.com') !== false) {
            $embedUrl = 'https://www.facebook.com/plugins/video.php?href=' . urlencode($product->video_url);
        }
    }
    $avgRating = $product->average_rating;
    $fullStars = (int) round($avgRating);
@endphp

<style>
    .pd-main-img { width: 100%; height: 420px; object-fit: cover; border-radius: 12px; background: #f7f7f7; }
    .pd-thumbs { display: flex; gap: 10px; margin-top: 12px; }
    .pd-thumbs img { width: 80px; height: 80px; object-fit: cover; border-radius: 8px; cursor: pointer; border: 2px solid transparent; }
    .pd-thumbs img.active { border-color: #0097ff; }
    .pd-title { font-size: 28px; font-weight: 700; margin-bottom: 6px; }
    .pd-price { font-size: 22px; font-weight: 700; }
    .pd-price del { color: #e74c3c; font-weight: 400; font-size: 16px; margin-left: 10px; }
    .pd-badge { display: inline-block; background: #eef6ff; color: #0097ff; font-size: 12px; font-weight: 700; padding: 5px 12px; border-radius: 20px; margin-bottom: 12px; }
    .pd-warranty { background: #f7f9fc; border-radius: 10px; padding: 14px 18px; margin: 18px 0; font-size: 14px; }
    .pd-qty { display: inline-flex; align-items: center; border: 1px solid #ddd; border-radius: 30px; padding: 4px 6px; }
    .pd-qty button { width: 30px; height: 30px; border-radius: 50%; border: none; background: #f1f1f1; font-size: 16px; }
    .pd-qty input { width: 40px; text-align: center; border: none; }

    /* Variant (Color / Ram / Storage / Region...) selectors */
    .pd-variant-group { margin-bottom: 16px; }
    .pd-variant-options { display: flex; flex-wrap: wrap; gap: 8px; }
    .pd-variant-btn { display: inline-flex; align-items: center; gap: 7px; border: 1px solid #ddd; background: #fff; border-radius: 20px; padding: 7px 16px; font-size: 13px; cursor: pointer; transition: .15s ease; }
    .pd-variant-btn:hover { border-color: #0097ff; }
    .pd-variant-btn.active { border-color: #0097ff; background: #0097ff; color: #fff; }
    .pd-color-dot { width: 14px; height: 14px; border-radius: 50%; display: inline-block; border: 1px solid rgba(0,0,0,.15); }

    /* Tabs: real, spaced-out pills instead of run-together text */
    .pd-tabs { margin-top: 30px; }
    .pd-tabs .nav-pills { display: flex; flex-wrap: wrap; gap: 10px; border-bottom: 1px solid #eee; padding-bottom: 16px; }
    .pd-tabs .nav-link { border: 1px solid #e5e5e5; border-radius: 30px; color: #444; padding: 9px 22px; background: #f7f9fc; font-weight: 600; font-size: 14px; }
    .pd-tabs .nav-link.active { background: #0097ff; color: #fff; border-color: #0097ff; }
    .pd-tabs .tab-content { padding-top: 24px; }

    .pd-video-wrap { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 10px; background: #000; }
    .pd-video-wrap iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0; }
    .btn-theme { background: #0097ff; border-color: #0097ff; color: #fff; }
.btn-theme:hover, .btn-theme:focus { background: #0080e0; border-color: #0080e0; color: #fff; }

    .pd-stars { color: #ffb400; letter-spacing: 2px; }
    .pd-review-item { border-bottom: 1px solid #eee; padding: 14px 0; }
    .pd-review-item:last-child { border-bottom: none; }

    .pd-star-input { display: inline-flex; flex-direction: row-reverse; }
    .pd-star-input input { display: none; }
    .pd-star-input label span { font-size: 26px; line-height: 1; color: #ddd; cursor: pointer; padding: 0 2px; }
    .pd-star-input input:checked ~ label span,
    .pd-star-input label:hover span,
    .pd-star-input label:hover ~ label span { color: #ffb400; }
</style>

<div class="breadcrumb-area">
    <div class="container">
        <ul class="page-list">
            <li class="item-home"><a class="bread-link" href="{{ route('home') }}" title="Home">Home</a></li>
            <li class="separator separator-home"></li>
            <li class="item-home"><a class="bread-link" href="{{ route('shop.index') }}">Shop</a></li>
            <li class="separator separator-home"></li>
            <li class="item-current">{{ $product->title }}</li>
        </ul>
        <h1 class="breadcrumb-title">{{ $product->title }}</h1>
    </div>
</div>

<div class="blog-page-section">
<div class="container">

    <div class="row">
        <div class="col-lg-6">
            <img id="pdMainImage" class="pd-main-img" src="{{ $product->photo ? '/public/images/media/' . $product->photo->file : '/public/img/200x200.png' }}" alt="{{ $product->title }}">
            @if($product->gallery->count())
                <div class="pd-thumbs">
                    <img src="{{ $product->photo ? '/public/images/media/' . $product->photo->file : '/public/img/200x200.png' }}" class="active" onclick="pdSwap(this)">
                    @foreach($product->gallery as $img)
                        <img src="{{ $img }}" onclick="pdSwap(this)">
                    @endforeach
                </div>
            @endif
        </div>

        <div class="col-lg-6">
            @if($product->is_flash_sale)
                <span class="pd-badge">Flash Sale</span>
            @endif
            <div class="pd-price">
                <span id="pdBasePrice" data-base="{{ $product->effective_price }}">{{ number_format($product->effective_price, 2) }}</span>
                @if($product->sale_price && $product->sale_price < $product->price)
                    <del>{{ number_format($product->price, 2) }}</del>
                @endif
            </div>

            @if($product->short_description)
                <p class="mt-3 text-muted">{{ $product->short_description }}</p>
            @endif

            @if($product->variantGroups->count())
                <div class="pd-variants mt-3" id="pdVariants">
                    @foreach($product->variantGroups as $group)
                        <div class="pd-variant-group" data-group="{{ $group->name }}">
                            <strong class="d-block mb-2">{{ $group->name }}:</strong>
                            <div class="pd-variant-options">
                                @foreach($group->options as $i => $option)
                                    <button type="button"
                                            class="pd-variant-btn {{ $i === 0 ? 'active' : '' }}"
                                            data-price="{{ $option->price_modifier }}"
                                            data-option-id="{{ $option->id }}"
                                            onclick="pdSelectVariant(this)">
                                        @if($option->color_code)
                                            <span class="pd-color-dot" style="background: {{ $option->color_code }};"></span>
                                        @endif
                                        {{ $option->value }}
                                    </button>
                                @endforeach
                            </div>
                            <input type="hidden" name="variant[{{ $group->name }}]" class="pd-variant-hidden" value="{{ $group->options->first()->value ?? '' }}">
                        </div>
                    @endforeach
                </div>
            @endif

            @if($product->type == 'physical')
                <div class="mt-3">
                    <strong>Quantity:</strong>
                    <div class="pd-qty mt-2">
                        <button type="button" onclick="pdQty(-1)">-</button>
                        <input type="text" id="pdQtyInput" value="1" readonly>
                        <button type="button" onclick="pdQty(1)">+</button>
                    </div>
                    @if(!is_null($product->stock))
                        <p class="text-muted small mt-2">Stock: {{ $product->stock }}</p>
                    @endif
                </div>
            @else
                <p class="text-muted small mt-3">এটি একটি ডিজিটাল প্রোডাক্ট — কেনার সাথে সাথেই আপনার প্যানেল থেকে ডাউনলোড/অ্যাক্সেস করতে পারবেন।</p>
            @endif

            @if($product->warranty_duration && $product->warranty_unit)
                <div class="pd-warranty">
                    <strong>Warranty:</strong> {{ $product->warranty_duration }} {{ $product->warranty_unit }}
                </div>
            @endif

            <div class="mt-4">
                <form action="{{ route('cart.add') }}" method="POST" id="pdAddToCartForm" class="js-add-to-cart-form">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" id="pdQtyHidden" value="1">
                    <div id="pdOptionIdsHolder"></div>
                    <button type="submit" class="btn btn-theme rounded-pill px-4 py-2">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>

    @if(session('cart_success'))
        <div class="alert alert-success mt-3">{{ session('cart_success') }}</div>
    @endif
    @if(session('cart_error'))
        <div class="alert alert-danger mt-3">{{ session('cart_error') }}</div>
    @endif

    <div class="pd-tabs">
        <ul class="nav nav-pills" id="pdTabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#pdDetails">Details</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pdVideos">Videos</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pdReviews">Reviews ({{ $product->reviews_count }})</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pdShipping">Shipping &amp; Return</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="pdDetails">
                {!! $product->body !!}
            </div>

            <div class="tab-pane fade" id="pdVideos">
                @if($embedUrl)
                    <div class="pd-video-wrap">
                        <iframe src="{{ $embedUrl }}" allowfullscreen></iframe>
                    </div>
                @elseif($product->video_url)
                    <a href="{{ $product->video_url }}" target="_blank" rel="noopener">ভিডিও দেখুন</a>
                @else
                    <p class="text-muted">এই প্রোডাক্টের জন্য এখনো কোনো ভিডিও যুক্ত করা হয়নি।</p>
                @endif
            </div>

            <div class="tab-pane fade" id="pdReviews">
                <div class="d-flex align-items-center flex-wrap mb-3">
                    <span class="h4 mb-0 mr-2">{{ number_format($avgRating, 1) }}</span>
                    <span class="pd-stars mr-2">{{ str_repeat('★', $fullStars) . str_repeat('☆', 5 - $fullStars) }}</span>
                    <span class="text-muted">({{ $product->reviews_count }} রিভিউ)</span>
                </div>

                @if(session('review_success'))
                    <div class="alert alert-success">{{ session('review_success') }}</div>
                @endif

                @forelse($product->reviews as $review)
                    <div class="pd-review-item">
                        <div class="d-flex justify-content-between flex-wrap">
                            <strong>{{ $review->user->name ?? 'ব্যবহারকারী' }}</strong>
                            <span class="text-muted small">{{ $review->created_at->format('d M, Y') }}</span>
                        </div>
                        <div class="pd-stars">{{ str_repeat('★', $review->rating) . str_repeat('☆', 5 - $review->rating) }}</div>
                        @if($review->comment)
                            <p class="mb-0 mt-1">{{ $review->comment }}</p>
                        @endif
                    </div>
                @empty
                    <p class="text-muted">এখনো কোনো রিভিউ নেই। প্রথম রিভিউ আপনিই দিন!</p>
                @endforelse

                <hr>

                @auth
                    <h6 class="mt-4 mb-3">{{ $userReview ? 'আপনার রিভিউ আপডেট করুন' : 'রিভিউ লিখুন' }}</h6>
                    <form action="{{ route('shop.review.store', $product->slug) }}" method="POST">
                        @csrf
                        <div class="pd-star-input mb-3">
                            @for($i = 5; $i >= 1; $i--)
                                <label>
                                    <input type="radio" name="rating" value="{{ $i }}" {{ (old('rating', $userReview->rating ?? 0)) == $i ? 'checked' : '' }} required>
                                    <span>★</span>
                                </label>
                            @endfor
                        </div>
                        <div class="form-group">
                            <textarea name="comment" class="form-control" rows="3" placeholder="প্রোডাক্টটি সম্পর্কে আপনার মতামত লিখুন...">{{ old('comment', $userReview->comment ?? '') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-theme rounded-pill px-4">{{ $userReview ? 'আপডেট করুন' : 'সাবমিট করুন' }}</button>
                    </form>
                @else
                    <p class="text-muted">রিভিউ লিখতে চাইলে অনুগ্রহ করে <a href="{{ route('login') }}">লগইন</a> করুন।</p>
                @endauth
            </div>

            <div class="tab-pane fade" id="pdShipping">
                @if($product->shipping_return_info)
                    <div>{!! nl2br(e($product->shipping_return_info)) !!}</div>
                @else
                    <p class="text-muted">সাধারণ ডেলিভারি সময়: ঢাকার ভিতরে ১-২ দিন, ঢাকার বাইরে ২-৪ দিন। প্রোডাক্টে কোনো সমস্যা থাকলে হাতে পাওয়ার ২৪ ঘণ্টার মধ্যে আমাদের সাথে যোগাযোগ করুন।</p>
                @endif
            </div>
        </div>
    </div>

    @if($related->count())
        <h4 class="mt-5 mb-3">Related Products</h4>
        <div class="row">
            @foreach($related as $rp)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="{{ route('shop.show', $rp->slug) }}" class="text-decoration-none">
                        <div class="product-card" style="border:1px solid #eee;border-radius:10px;overflow:hidden;margin-bottom:20px;">
                            <img src="{{ $rp->photo ? '/public/images/media/' . $rp->photo->file : '/public/img/200x200.png' }}" style="width:100%;height:160px;object-fit:cover;">
                            <div style="padding:12px;">
                                <p style="font-weight:600;font-size:14px;margin:0 0 4px;color:#222;">{{ $rp->title }}</p>
                                <span style="font-weight:700;">{{ number_format($rp->effective_price, 2) }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif

</div>
</div>

<script>
    function pdSwap(el) {
        document.getElementById('pdMainImage').src = el.src;
        document.querySelectorAll('.pd-thumbs img').forEach(function (img) { img.classList.remove('active'); });
        el.classList.add('active');
    }
    function pdQty(delta) {
        var input = document.getElementById('pdQtyInput');
        var val = Math.max(1, parseInt(input.value || '1') + delta);
        input.value = val;
        var hidden = document.getElementById('pdQtyHidden');
        if (hidden) hidden.value = val;
    }

    function pdSyncOptionIds() {
        var holder = document.getElementById('pdOptionIdsHolder');
        if (!holder) return;
        holder.innerHTML = '';
        document.querySelectorAll('.pd-variant-group .pd-variant-btn.active').forEach(function (b) {
            if (!b.dataset.optionId) return;
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'option_ids[]';
            input.value = b.dataset.optionId;
            holder.appendChild(input);
        });
    }
    document.addEventListener('DOMContentLoaded', pdSyncOptionIds);

    function pdSelectVariant(el) {
        var group = el.closest('.pd-variant-group');
        group.querySelectorAll('.pd-variant-btn').forEach(function (b) { b.classList.remove('active'); });
        el.classList.add('active');
        var hidden = group.querySelector('.pd-variant-hidden');
        if (hidden) {
            hidden.value = el.textContent.trim();
        }
        pdRecalcPrice();
        pdSyncOptionIds();
    }

    function pdRecalcPrice() {
        var priceEl = document.getElementById('pdBasePrice');
        if (!priceEl) return;
        var base = parseFloat(priceEl.dataset.base) || 0;
        var total = base;
        document.querySelectorAll('.pd-variant-group .pd-variant-btn.active').forEach(function (b) {
            total += parseFloat(b.dataset.price || 0);
        });
        priceEl.textContent = total.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    @if(session('review_success'))
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('#pdTabs .nav-link').forEach(function (l) { l.classList.remove('active'); });
            document.querySelectorAll('.tab-pane').forEach(function (p) { p.classList.remove('show', 'active'); });
            var tabLink = document.querySelector('#pdTabs a[href="#pdReviews"]');
            if (tabLink) tabLink.classList.add('active');
            var pane = document.getElementById('pdReviews');
            if (pane) pane.classList.add('show', 'active');
        });
    @endif
</script>

@endsection
