@extends('layouts.front')

@section('title') Post a Listing @endsection

@section('content')

<style>
    .mk-wrap { max-width: 640px; margin: 0 auto; padding: 110px 16px 60px; }
    .mk-card { background: #fff; border-radius: 14px; box-shadow: 0 4px 18px rgba(20,30,60,0.06); padding: 28px 30px; }
    .type-toggle { display: flex; gap: 10px; margin-bottom: 20px; }
    .type-toggle label {
        flex: 1; text-align: center; border: 1.5px solid #e3e6ec; border-radius: 10px; padding: 12px;
        font-weight: 700; cursor: pointer; margin: 0; color: #6c7488;
    }
    .type-toggle input { display: none; }
    .type-toggle input:checked + span { color: #0097ff; }
    .type-toggle label:has(input:checked) { border-color: #0097ff; background: #eaf4ff; color: #0097ff; }
    .btn-theme { background: #0097ff; border-color: #0097ff; color: #fff; }
    .btn-theme:hover, .btn-theme:focus { background: #0080e0; border-color: #0080e0; color: #fff; }
    .p2p-warning { background: #fff6e5; border: 1px solid #f0d99a; color: #7a5b00; border-radius: 10px; padding: 12px 16px; font-size: 12.5px; margin: 16px 0; line-height: 1.6; }
    @media (max-width: 860px) { .mk-wrap { padding-top: 90px; } }
</style>

<div class="mk-wrap">
    <div class="mk-card">
        <h2>Post a Listing</h2>
        <p class="text-muted">Sell a physical or digital item — fixed price, or let buyers bid in an auction. Payment is held by admin until you confirm delivery and it's released to your wallet.</p>

        @include('includes.form-errors')

        <form method="POST" action="{{ route('marketplace.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="type-toggle">
                <label><input type="radio" name="listing_type" value="fixed" id="typeFixed" {{ old('listing_type', 'fixed') == 'fixed' ? 'checked' : '' }}><span>Fixed Price</span></label>
                <label><input type="radio" name="listing_type" value="auction" id="typeAuction" {{ old('listing_type') == 'auction' ? 'checked' : '' }}><span>Auction</span></label>
            </div>

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label>Photo</label>
                <input type="file" name="photo" accept="image/*" class="form-control-file">
            </div>

            <div id="fixedFields">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Price (৳)</label>
                            <input type="number" step="0.01" min="0.01" name="price" value="{{ old('price') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Quantity available</label>
                            <input type="number" min="1" name="quantity_available" value="{{ old('quantity_available', 1) }}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div id="auctionFields" style="display:none;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Starting bid (৳)</label>
                            <input type="number" step="0.01" min="0.01" name="starting_price" value="{{ old('starting_price') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Minimum bid step (৳)</label>
                            <input type="number" step="0.01" min="0.01" name="bid_increment" value="{{ old('bid_increment', 10) }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Auction ends</label>
                            <input type="datetime-local" name="ends_at" value="{{ old('ends_at') }}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <p class="text-muted small mb-2">Selling something digital? Attach a file or a link — leave both blank for a physical item.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Digital file (optional)</label>
                        <input type="file" name="digital_file" class="form-control-file">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Or an external link</label>
                        <input type="text" name="digital_link" value="{{ old('digital_link') }}" class="form-control" placeholder="https://...">
                    </div>
                </div>
            </div>

            <div class="p2p-warning">
                <strong>সতর্কবাণী:</strong> এডমিনের পেমেন্ট সিস্টেমের বাইরে কোনো ধরনের আর্থিক লেনদেন করবেন না — যদি করে থাকেন, সেক্ষেত্রে কর্তৃপক্ষ দায়ী থাকবে না।
                <br>
                <strong>Warning:</strong> Do not make any financial transaction outside the admin's payment system — if you do, the authority will not be held responsible.
            </div>

            <button type="submit" class="btn btn-theme">Post Listing</button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var fixedRadio = document.getElementById('typeFixed');
    var auctionRadio = document.getElementById('typeAuction');
    var fixedFields = document.getElementById('fixedFields');
    var auctionFields = document.getElementById('auctionFields');

    function refresh() {
        var isAuction = auctionRadio.checked;
        fixedFields.style.display = isAuction ? 'none' : 'block';
        auctionFields.style.display = isAuction ? 'block' : 'none';
    }

    fixedRadio.addEventListener('change', refresh);
    auctionRadio.addEventListener('change', refresh);
    refresh();
});
</script>

@endsection
