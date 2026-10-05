@extends('layouts.front')

@section('title') Post a Currency Listing @endsection

@section('content')

<style>
    .cx-wrap { max-width: 640px; margin: 0 auto; padding: 110px 16px 60px; }
    .cx-card { background: #fff; border-radius: 14px; box-shadow: 0 4px 18px rgba(20,30,60,0.06); padding: 28px 30px; }
    .btn-theme { background: #0097ff; border-color: #0097ff; color: #fff; }
    .btn-theme:hover, .btn-theme:focus { background: #0080e0; border-color: #0080e0; color: #fff; }
    .p2p-warning { background: #fff6e5; border: 1px solid #f0d99a; color: #7a5b00; border-radius: 10px; padding: 12px 16px; font-size: 12.5px; margin: 16px 0; line-height: 1.6; }
    @media (max-width: 860px) { .cx-wrap { padding-top: 90px; } }
</style>

<div class="cx-wrap">
    <div class="cx-card">
        <h2>Post a Currency Listing</h2>
        <p class="text-muted">Say how much you're selling and at what rate. Buyers pay through the site — the money is held until you confirm you've handed over the currency and an admin releases it to your wallet.</p>

        @include('includes.form-errors')

        <form method="POST" action="{{ route('currency.store') }}">
            @csrf

            <div class="form-group">
                <label>Currency</label>
                <select name="currency" class="form-control" required>
                    @forelse ($currencies as $c)
                        <option value="{{ $c->code }}" {{ old('currency', 'USD') == $c->code ? 'selected' : '' }}>{{ $c->code }} — {{ $c->name }}</option>
                    @empty
                        <option value="USD" selected>USD — US Dollar</option>
                    @endforelse
                </select>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Amount to sell</label>
                        <input type="number" step="0.01" min="1" name="amount_available" value="{{ old('amount_available') }}" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Rate (৳ per unit)</label>
                        <input type="number" step="0.0001" min="0.01" name="rate" value="{{ old('rate') }}" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Minimum order (optional)</label>
                        <input type="number" step="0.01" min="0" name="min_order" value="{{ old('min_order') }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Maximum order (optional)</label>
                        <input type="number" step="0.01" min="0" name="max_order" value="{{ old('max_order') }}" class="form-control">
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

@endsection
