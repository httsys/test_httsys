@extends('layouts.front')

@section('title') {{ __('donation.manual_title') }} @endsection

@section('content')

<style>
    .pay-to-box { display: flex; align-items: center; justify-content: space-between; gap: 12px; background: #f4f7fc; border: 1.5px solid #e3e6ec; border-radius: 10px; padding: 14px 16px; margin: 10px 0; }
    .pay-to-box .pay-to-number { font-size: 20px; font-weight: 700; letter-spacing: 0.5px; direction: ltr; unicode-bidi: embed; }
    .pay-to-box .pay-to-name { font-size: 12px; color: #888; margin-top: 2px; }
    .copy-btn { flex-shrink: 0; border: 1.5px solid #0097ff; background: #fff; color: #0097ff; border-radius: 8px; padding: 8px 16px; font-weight: 600; font-size: 13px; cursor: pointer; transition: background .15s, color .15s; }
    .copy-btn:hover { background: #0097ff; color: #fff; }
    .copy-btn.copied { background: #1cc88a; border-color: #1cc88a; color: #fff; }
</style>

<div class="breadcrumb-area">
    <div class="container">
        <h1 class="breadcrumb-title">{{ __('donation.manual_title') }}</h1>
    </div>
</div>

<div class="blog-page-section">
<div class="container">
    <div class="donate-box" style="max-width: 640px; margin: 0 auto; background: #fff; border-radius: 14px; padding: 30px; box-shadow: 0 4px 24px rgba(0,0,0,0.06);">

        <p><strong>{{ __('donation.fund_label') }}:</strong> {{ $donation->fund->title }}</p>
        <p><strong>{{ __('donation.amount_label') }}:</strong> ৳{{ number_format($donation->amount, 2) }}</p>
        <p><strong>{{ __('donation.reference_label') }}:</strong> {{ $donation->reference }}</p>

        <hr>

        <h5>{{ __('donation.how_to_pay', ['method' => $donation->paymentMethod->name]) }}</h5>

        @if ($accountNumber = $donation->paymentMethod->configValue('account_number'))
            <p class="mb-1 small text-muted">{{ __('donation.pay_to_label') }}</p>
            <div class="pay-to-box">
                <div>
                    <div class="pay-to-number" id="payToNumber">{{ $accountNumber }}</div>
                    @if ($accountName = $donation->paymentMethod->configValue('account_name'))
                        <div class="pay-to-name">{{ $accountName }}</div>
                    @endif
                </div>
                <button type="button" class="copy-btn" id="copyNumberBtn" data-value="{{ $accountNumber }}">{{ __('donation.copy_button') }}</button>
            </div>
        @endif

        @if ($donation->paymentMethod->instructions)
            <div class="mb-3 mt-2" style="white-space: pre-line;">{{ $donation->paymentMethod->instructions }}</div>
        @elseif (! $accountNumber)
            <div class="mb-3">{{ __('donation.no_instructions') }}</div>
        @endif

        @include('includes.form-errors')

        <form action="{{ route('donations.manual.submit', $donation->reference) }}" method="POST">
            @csrf
            <div class="form-group">
                <label>{{ __('donation.manual_reference_label') }}</label>
                <input type="text" name="manual_reference" class="form-control" required value="{{ old('manual_reference', $donation->manual_reference) }}">
            </div>
            <button type="submit" class="btn btn-primary">{{ __('donation.manual_submit') }}</button>
        </form>
    </div>
</div>
</div>

<script>
(function () {
    var btn = document.getElementById('copyNumberBtn');
    if (!btn) return;

    btn.addEventListener('click', function () {
        var value = btn.dataset.value;
        var restoreText = btn.textContent;
        var copiedText = @json(__('donation.copied_button'));

        function showCopied() {
            btn.textContent = copiedText;
            btn.classList.add('copied');
            setTimeout(function () {
                btn.textContent = restoreText;
                btn.classList.remove('copied');
            }, 1500);
        }

        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(value).then(showCopied);
        } else {
            var temp = document.createElement('textarea');
            temp.value = value;
            temp.style.position = 'fixed';
            temp.style.opacity = '0';
            document.body.appendChild(temp);
            temp.focus();
            temp.select();
            try { document.execCommand('copy'); } catch (e) {}
            document.body.removeChild(temp);
            showCopied();
        }
    });
})();
</script>

@stop
