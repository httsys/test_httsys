{{--
    Shared receipt markup — included both by PosOrderController@show (fetched
    into the in-page "Order Payment" success modal right after checkout, and
    when re-opening an older POS order from the POS Orders list) and by
    receipt-print.blade.php (the standalone printable page). Keep this file
    free of anything that only makes sense inside a modal or only on a full
    page — that split lives in the two wrapper views instead.
--}}
@php
    $currency = config('shop.currency_symbol');
@endphp
<div class="pos-receipt">
    <div class="text-center mb-2">
        <div class="font-weight-bold" style="font-size:15px;">{{ $setting->title ?? config('app.name') }}</div>
        @if(!empty($setting->address))
            <div class="small">{{ $setting->address }}</div>
        @endif
        @if(!empty($setting->phone))
            <div class="small">Tel: {{ $setting->phone }}</div>
        @endif
    </div>

    <hr class="my-2">

    <div class="d-flex justify-content-between small">
        <span>Order ID #{{ $order->order_number }}</span>
        <span>{{ $order->created_at->format('d-m-Y') }}</span>
    </div>
    <div class="d-flex justify-content-between small mb-2">
        <span>Cashier: {{ optional($order->servedBy)->name ?? '-' }}</span>
        <span>{{ $order->created_at->format('h:i A') }}</span>
    </div>

    <hr class="my-2">

    <table class="table table-sm table-borderless mb-1" style="font-size:12px;">
        <thead>
            <tr>
                <th style="width:10%;">Qty</th>
                <th>Product Description</th>
                <th class="text-right" style="width:25%;">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->quantity }}</td>
                    <td>
                        {{ $item->product_title }}
                        @if($item->variant_summary)
                            <div class="text-muted">{{ $item->variant_summary }}</div>
                        @endif
                        @if($item->tax_rate)
                            <div class="text-muted">VAT-{{ rtrim(rtrim(number_format($item->tax_rate, 2), '0'), '.') }} ({{ rtrim(rtrim(number_format($item->tax_rate, 2), '0'), '.') }}%)</div>
                        @endif
                    </td>
                    <td class="text-right">{{ $currency }}{{ number_format($item->unit_price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr class="my-2">

    <div class="d-flex justify-content-between small">
        <span>SUBTOTAL:</span>
        <span>{{ $currency }}{{ number_format($order->subtotal, 2) }}</span>
    </div>
    <div class="d-flex justify-content-between small">
        <span>TAX FEE:</span>
        <span>{{ $currency }}{{ number_format($order->tax, 2) }}</span>
    </div>
    <div class="d-flex justify-content-between small">
        <span>DISCOUNT:</span>
        <span>{{ $currency }}{{ number_format($order->discount, 2) }}</span>
    </div>
    <div class="d-flex justify-content-between font-weight-bold">
        <span>TOTAL:</span>
        <span>{{ $currency }}{{ number_format($order->total, 2) }}</span>
    </div>

    <hr class="my-2">

    <div class="d-flex justify-content-between small">
        <span>Payment Type:</span>
        <span>{{ ucfirst($order->payment_method) }}</span>
    </div>
    @if($order->amount_tendered !== null)
        <div class="d-flex justify-content-between small">
            <span>{{ ucfirst($order->payment_method) }}:</span>
            <span>{{ $currency }}{{ number_format($order->amount_tendered, 2) }}</span>
        </div>
        <div class="d-flex justify-content-between small">
            <span>Change:</span>
            <span>{{ $currency }}{{ number_format($order->change_due, 2) }}</span>
        </div>
    @endif

    <hr class="my-2">

    <div class="text-center small">
        <div>Thank You</div>
        <div>Please Come Again</div>
    </div>

    <div class="text-center text-muted mt-2" style="font-size:10px;">
        Powered by<br>{{ $setting->title ?? config('app.name') }}
    </div>
</div>
