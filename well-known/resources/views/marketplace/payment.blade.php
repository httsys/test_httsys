@extends('layouts.front')

@section('title') Complete Your Payment @endsection

@section('content')

<style>
    .cx-wrap { max-width: 640px; margin: 0 auto; padding: 110px 16px 60px; }
    .cx-card { background: #fff; border-radius: 14px; box-shadow: 0 4px 18px rgba(20,30,60,0.06); padding: 28px 30px; }
    .pay-to-box { display: flex; align-items: center; justify-content: space-between; gap: 12px; background: #f4f7fc; border: 1.5px solid #e3e6ec; border-radius: 10px; padding: 14px 16px; margin: 10px 0; }
    .pay-to-box .pay-to-number { font-size: 20px; font-weight: 700; letter-spacing: 0.5px; direction: ltr; unicode-bidi: embed; }
    .pay-to-box .pay-to-name { font-size: 12px; color: #888; margin-top: 2px; }
    .copy-btn { flex-shrink: 0; border: 1.5px solid #0097ff; background: #fff; color: #0097ff; border-radius: 8px; padding: 8px 16px; font-weight: 600; font-size: 13px; cursor: pointer; }
    .copy-btn:hover { background: #0097ff; color: #fff; }
    .copy-btn.copied { background: #1cc88a; border-color: #1cc88a; color: #fff; }
    .btn-theme { background: #0097ff; border-color: #0097ff; color: #fff; }
    .btn-theme:hover, .btn-theme:focus { background: #0080e0; border-color: #0080e0; color: #fff; }
    @media (max-width: 860px) { .cx-wrap { padding-top: 90px; } }
</style>

<div class="cx-wrap">
    <div class="cx-card">

        <h4>Complete Your Payment</h4>
        <p class="mb-1"><strong>Item:</strong> {{ $order->listing->title ?? '—' }} @if($order->quantity > 1)× {{ $order->quantity }}@endif</p>
        <p class="mb-1"><strong>Amount to Pay:</strong> ৳{{ number_format($order->amount, 2) }}</p>

        <hr>

        @include('includes.form-errors')
        @if (session('currency_error'))
            <div class="alert alert-danger">{{ session('currency_error') }}</div>
        @endif

        <form method="POST" action="{{ route('marketplace.submit-payment', $order->id) }}">
            @csrf

            <div class="form-group">
                <label>Pay using</label>
                <select name="payment_method_id" id="cxMethodSelect" class="form-control" required>
                    <option value="">Choose a payment method</option>
                    @foreach ($paymentMethods as $method)
                        <option value="{{ $method->id }}"
                                data-account-number="{{ $method->configValue('account_number') }}"
                                data-account-name="{{ $method->configValue('account_name') }}"
                                data-instructions="{{ $method->instructions }}"
                                {{ old('payment_method_id') == $method->id ? 'selected' : '' }}>
                            {{ $method->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div id="cxPayToBox" style="display:none;">
                <p class="mb-1 small text-muted">Send payment to</p>
                <div class="pay-to-box">
                    <div>
                        <div class="pay-to-number" id="cxPayToNumber"></div>
                        <div class="pay-to-name" id="cxPayToName"></div>
                    </div>
                    <button type="button" class="copy-btn" id="cxCopyBtn">Copy</button>
                </div>
                <div id="cxInstructions" class="mb-3 mt-2 text-muted" style="white-space: pre-line;"></div>
            </div>

            <div class="form-group">
                <label>Your Transaction / Reference Number</label>
                <input type="text" name="payment_reference" class="form-control" required value="{{ old('payment_reference') }}">
            </div>

            <div class="form-group">
                <label>How should the seller deliver this to you?</label>
                <textarea name="receiving_details" rows="3" class="form-control" placeholder="Shipping address, contact number, or how you'll receive a digital delivery." required>{{ old('receiving_details') }}</textarea>
                <small class="text-muted">The seller only sees this after you submit — and should wait for admin confirmation before sending.</small>
            </div>

            <button type="submit" class="btn btn-theme">I Have Paid — Submit</button>
        </form>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var select = document.getElementById('cxMethodSelect');
    var box = document.getElementById('cxPayToBox');
    var numberEl = document.getElementById('cxPayToNumber');
    var nameEl = document.getElementById('cxPayToName');
    var instrEl = document.getElementById('cxInstructions');
    var copyBtn = document.getElementById('cxCopyBtn');

    function refresh() {
        var opt = select.options[select.selectedIndex];
        if (!opt || !opt.value) { box.style.display = 'none'; return; }

        var number = opt.getAttribute('data-account-number') || '';
        var name = opt.getAttribute('data-account-name') || '';
        var instructions = opt.getAttribute('data-instructions') || '';

        if (!number && !instructions) { box.style.display = 'none'; return; }

        numberEl.textContent = number;
        nameEl.textContent = name;
        instrEl.textContent = instructions;
        copyBtn.setAttribute('data-value', number);
        box.style.display = number ? 'block' : 'none';
    }

    select.addEventListener('change', refresh);
    refresh();

    copyBtn.addEventListener('click', function () {
        var value = this.getAttribute('data-value');
        if (!value) { return; }
        navigator.clipboard.writeText(value).then(function () {
            copyBtn.classList.add('copied');
            copyBtn.textContent = 'Copied';
            setTimeout(function () {
                copyBtn.classList.remove('copied');
                copyBtn.textContent = 'Copy';
            }, 1500);
        });
    });
});
</script>

@endsection
