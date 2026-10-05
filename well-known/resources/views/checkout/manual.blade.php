@extends('layouts.front')

@section('title') Complete Your Payment @endsection

@section('content')

<style>
    .pay-to-box { display: flex; align-items: center; justify-content: space-between; gap: 12px; background: #f4f7fc; border: 1.5px solid #e3e6ec; border-radius: 10px; padding: 14px 16px; margin: 10px 0; }
    .pay-to-box .pay-to-number { font-size: 20px; font-weight: 700; letter-spacing: 0.5px; direction: ltr; unicode-bidi: embed; }
    .pay-to-box .pay-to-name { font-size: 12px; color: #888; margin-top: 2px; }
    .copy-btn { flex-shrink: 0; border: 1.5px solid #0097ff; background: #fff; color: #0097ff; border-radius: 8px; padding: 8px 16px; font-weight: 600; font-size: 13px; cursor: pointer; transition: background .15s, color .15s; }
    .btn-theme { background: #0097ff; border-color: #0097ff; color: #fff; }
.btn-theme:hover, .btn-theme:focus { background: #0080e0; border-color: #0080e0; color: #fff; }
    .copy-btn:hover { background: #0097ff; color: #fff; }
    .copy-btn.copied { background: #1cc88a; border-color: #1cc88a; color: #fff; }
    .manual-order-item { display: flex; gap: 12px; align-items: center; padding: 8px 0; border-bottom: 1px solid #eee; }
    .manual-order-item img { width: 44px; height: 44px; object-fit: cover; border-radius: 8px; background: #f7f7f7; }
</style>

<div class="breadcrumb-area">
    <div class="container">
        <h1 class="breadcrumb-title">Complete Your Payment</h1>
    </div>
</div>

<div class="blog-page-section">
<div class="container">
    <div class="donate-box" style="max-width: 640px; margin: 0 auto; background: #fff; border-radius: 14px; padding: 30px; box-shadow: 0 4px 24px rgba(0,0,0,0.06);">

        @foreach ($order->items as $item)
            <div class="manual-order-item">
                <img src="{{ $item->product_image ? '/public/images/media/' . $item->product_image : '/public/img/200x200.png' }}" alt="{{ $item->product_title }}">
                <div class="flex-grow-1">
                    <div>{{ $item->product_title }}</div>
                    @if($item->variant_summary)<div class="text-muted small">{{ $item->variant_summary }}</div>@endif
                </div>
                <div class="text-right text-muted small">x{{ $item->quantity }}</div>
            </div>
        @endforeach

        <p class="mt-3 mb-1"><strong>Amount to Pay:</strong> {{ $order->currency }}{{ number_format($order->total, 2) }}</p>
        <p class="mb-1"><strong>Order Reference:</strong> {{ $order->order_number }}</p>

        <hr>

        <h5>How to pay with {{ $order->paymentMethod->name }}</h5>

        @if ($accountNumber = $order->paymentMethod->configValue('account_number'))
            <p class="mb-1 small text-muted">Send payment to</p>
            <div class="pay-to-box">
                <div>
                    <div class="pay-to-number" id="payToNumber">{{ $accountNumber }}</div>
                    @if ($accountName = $order->paymentMethod->configValue('account_name'))
                        <div class="pay-to-name">{{ $accountName }}</div>
                    @endif
                </div>
                <button type="button" class="copy-btn" id="copyNumberBtn" data-value="{{ $accountNumber }}">Copy</button>
            </div>
        @endif

        @if ($order->paymentMethod->instructions)
            <div class="mb-3 mt-2" style="white-space: pre-line;">{{ $order->paymentMethod->instructions }}</div>
        @elseif (! $accountNumber)
            <div class="mb-3">Contact us for payment instructions.</div>
        @endif

        @include('includes.form-errors')

        <form action="{{ route('checkout.manual.submit', $order->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Your Transaction / Reference Number</label>
                <input type="text" name="manual_reference" class="form-control" required value="{{ old('manual_reference', $order->manual_reference) }}">
            </div>
            <button type="submit" class="btn btn-theme">I Have Paid — Submit</button>
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

        function showCopied() {
            btn.textContent = 'Copied';
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
