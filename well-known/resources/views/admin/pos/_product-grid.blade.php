<div class="row">
    @forelse($products as $product)
        @php
            $hasSale = !empty($product->sale_price) && $product->sale_price > 0 && $product->sale_price < $product->price;
            $image = $product->photo ? '/public/images/media/' . $product->photo->file : '/public/img/200x200.png';
        @endphp
        <div class="col-6 col-md-4 col-xl-3 mb-3">
            <div class="card h-100 pos-product-card shadow-sm"
                 data-id="{{ $product->id }}"
                 data-has-variants="{{ $product->variantGroups->count() }}"
                 role="button">
                <div class="position-relative">
                    @if($product->is_flash_sale)
                        <span class="badge badge-dark position-absolute" style="top:8px;left:8px;">Flash Sale</span>
                    @endif
                    <img src="{{ $image }}" class="card-img-top" style="height:140px;object-fit:cover;" alt="{{ $product->title }}">
                </div>
                <div class="card-body p-2">
                    <div class="small font-weight-bold text-truncate" title="{{ $product->title }}">{{ $product->title }}</div>
                    <div class="small text-warning mb-1">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star{{ $i <= round($product->average_rating) ? '' : ' text-muted' }}" style="font-size:11px;"></i>
                        @endfor
                        @if($product->reviews_count > 0)
                            <span class="text-muted">({{ $product->reviews_count }})</span>
                        @endif
                    </div>
                    <div>
                        @if($hasSale)
                            <span class="font-weight-bold">{{ config('shop.currency_symbol') }}{{ number_format($product->sale_price, 2) }}</span>
                            <small class="text-muted"><del>{{ config('shop.currency_symbol') }}{{ number_format($product->price, 2) }}</del></small>
                        @else
                            <span class="font-weight-bold">{{ config('shop.currency_symbol') }}{{ number_format($product->price, 2) }}</span>
                        @endif
                    </div>
                    @if($product->stock !== null)
                        <div class="small text-muted">Stock: {{ $product->stock }}</div>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center text-muted py-5">No products found.</div>
    @endforelse
</div>

<div class="pos-pagination">
    {{ $products->links() }}
</div>
