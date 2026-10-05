@extends('layouts.front')

@section('title') {{ __('donation.page_title') }} @endsection

@section('content')

<style>
    .donate-box { max-width: 640px; margin: 0 auto; background: #fff; border-radius: 14px; padding: 30px; box-shadow: 0 4px 24px rgba(0,0,0,0.06); }
    .fund-option { display: flex; align-items: center; gap: 12px; border: 1.5px solid #e3e6ec; border-radius: 10px; padding: 12px 14px; margin-bottom: 10px; cursor: pointer; transition: border-color .15s; }
    .fund-option:hover { border-color: #0097ff; }
    .fund-option input { margin-right: 6px; }
    .fund-option img { width: 48px; height: 48px; object-fit: cover; border-radius: 8px; }
    .fund-option .fund-name { font-weight: 600; }
    .fund-option .fund-progress { font-size: 12px; color: #888; }
    .amount-quick { display: flex; gap: 8px; flex-wrap: wrap; margin: 10px 0; }
    .amount-quick button { border: 1.5px solid #e3e6ec; background: #f7f9fc; border-radius: 30px; padding: 6px 16px; font-weight: 600; }
    .amount-quick button.active { background: #0097ff; color: #fff; border-color: #0097ff; }
    .method-option { display: inline-flex; align-items: center; gap: 8px; border: 1.5px solid #e3e6ec; border-radius: 10px; padding: 10px 16px; margin: 0 8px 8px 0; cursor: pointer; }
</style>

<div class="breadcrumb-area">
    <div class="container">
        <ul class="page-list">
            <li class="item-home"><a class="bread-link" href="{{ route('home') }}" title="{{ __('donation.breadcrumb_home') }}">{{ __('donation.breadcrumb_home') }}</a></li>
            <li class="separator separator-home"></li>
            <li class="item-current">{{ __('donation.breadcrumb_current') }}</li>
        </ul>
        <h1 class="breadcrumb-title">{{ __('donation.page_title') }}</h1>
    </div>
</div>

<div class="blog-page-section">
<div class="container">

    @if (session('donation_error'))
        <div class="alert alert-danger">{{ session('donation_error') }}</div>
    @endif
    @include('includes.form-errors')

    <div class="donate-box">
        <form action="{{ route('donations.store') }}" method="POST">
            @csrf

            <h5 class="mb-3">{{ __('donation.step1_title') }}</h5>
            @forelse ($funds as $fund)
                <label class="fund-option">
                    <input type="radio" name="fund_id" value="{{ $fund->id }}" required
                        {{ (old('fund_id') == $fund->id) || (! old('fund_id') && $selectedFund && $selectedFund->id == $fund->id) ? 'checked' : '' }}>
                    <img src="{{ $fund->photo ? '/public/images/media/' . $fund->photo->file : '/public/img/200x200.png' }}" alt="">
                    <span>
                        <span class="fund-name d-block">{{ $fund->title }}</span>
                        @if ($fund->short_description)
                            <span class="fund-progress">{{ $fund->short_description }}</span>
                        @endif
                        @if (! is_null($fund->progress_percent))
                            <span class="fund-progress d-block">{{ __('donation.progress', ['collected' => '৳' . number_format($fund->collected_amount), 'target' => '৳' . number_format($fund->target_amount), 'percent' => $fund->progress_percent]) }}</span>
                        @endif
                    </span>
                </label>
            @empty
                <p class="text-muted">{{ __('donation.no_funds') }}</p>
            @endforelse

            <h5 class="mb-2 mt-4">{{ __('donation.step2_title') }}</h5>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>{{ __('donation.name_label') }}</label>
                    <input type="text" name="donor_name" class="form-control" value="{{ old('donor_name', auth()->user()->name ?? '') }}">
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('donation.mobile_label') }}</label>
                    <input type="text" name="donor_mobile" class="form-control" value="{{ old('donor_mobile', auth()->user()->phone ?? '') }}" placeholder="01XXXXXXXXX">
                </div>
                <div class="form-group col-md-12">
                    <label>{{ __('donation.email_label') }} {{ auth()->check() ? '' : '(' . __('donation.email_required_note') . ')' }}</label>
                    <input type="email" name="donor_email" class="form-control" value="{{ old('donor_email', auth()->user()->email ?? '') }}">
                </div>
            </div>
            <p class="small text-muted">{{ __('donation.contact_help') }}</p>

            <h5 class="mb-2 mt-4">{{ __('donation.step3_title') }}</h5>
            <div class="amount-quick">
                @foreach ([100, 500, 1000, 2000, 5000] as $amt)
                    <button type="button" class="amount-pick" data-amount="{{ $amt }}">৳{{ number_format($amt) }}</button>
                @endforeach
            </div>
            <div class="input-group mb-3" style="max-width: 260px;">
                <div class="input-group-prepend"><span class="input-group-text">৳</span></div>
                <input type="number" name="amount" id="donationAmount" class="form-control" min="10" step="1" value="{{ old('amount') }}" required>
            </div>

            <h5 class="mb-2 mt-4">{{ __('donation.step4_title') }}</h5>
            <div class="mb-4">
                @foreach ($methods as $method)
                    <label class="method-option">
                        <input type="radio" name="payment_method_id" value="{{ $method->id }}" required {{ old('payment_method_id') == $method->id ? 'checked' : '' }}>
                        {{ $method->name }}
                    </label>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary btn-block py-2">{{ __('donation.submit_button') }}</button>
        </form>
    </div>

</div>
</div>

<script>
document.querySelectorAll('.amount-pick').forEach(function (btn) {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.amount-pick').forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');
        document.getElementById('donationAmount').value = btn.dataset.amount;
    });
});
</script>

@stop
