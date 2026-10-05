<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Receipt #{{ $order->order_number }}</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial, Helvetica, sans-serif; max-width: 650px; margin: 0 auto; padding: 24px; color: #222; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0 0 4px; }
        .muted { color: #666; }
        table { width: 100%; border-collapse: collapse; margin: 16px 0; }
        th, td { padding: 8px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #f7f7f7; }
        .text-right { text-align: right; }
        .totals { width: 280px; margin-left: auto; }
        .totals div { display: flex; justify-content: space-between; padding: 4px 0; }
        .totals .grand { font-weight: bold; font-size: 16px; border-top: 1px solid #ccc; padding-top: 8px; margin-top: 4px; }
        .customer-box { margin: 16px 0; padding: 12px; background: #f9f9f9; border-radius: 6px; line-height: 1.5; }
        @media print { body { padding: 0; } }
    </style>
</head>
<body>
    <div class="header">
        <h2>{{ $setting->title ?? config('app.name') }}</h2>
        @if(!empty($setting->address))<div class="muted">{{ $setting->address }}</div>@endif
        @if(!empty($setting->phone))<div class="muted">Tel: {{ $setting->phone }}</div>@endif
    </div>

    <div><strong>Receipt for Order #{{ $order->order_number }}</strong></div>
    <div class="muted">{{ $order->created_at->format('d M Y, h:i A') }} &middot; Payment: {{ ucfirst($order->payment_method) }} ({{ ucfirst($order->payment_status) }})</div>

    <div class="customer-box">
        <strong>Billed / Shipped To</strong>
        <div>{{ $order->ship_name }}</div>
        @if(!empty($order->ship_phone))<div>{{ $order->ship_phone }}</div>@endif
        @if(!empty($order->ship_email))<div>{{ $order->ship_email }}</div>@endif
        <div>
            {{ $order->ship_address_line }}@if(!empty($order->ship_address_line)),@endif
            {{ $order->ship_city }}, {{ $order->ship_state }}, {{ $order->ship_country }}
            @if(!empty($order->ship_postal_code)), {{ $order->ship_postal_code }}@endif
        </div>
    </div>

    <table>
        <thead><tr><th>Product</th><th>Qty</th><th class="text-right">Unit Price</th><th class="text-right">Line Total</th></tr></thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_title }}@if($item->variant_summary)<div class="muted">{{ $item->variant_summary }}</div>@endif</td>
                    <td>{{ $item->quantity }}</td>
                    <td class="text-right">{{ $order->currency }}{{ number_format($item->unit_price, 2) }}</td>
                    <td class="text-right">{{ $order->currency }}{{ number_format($item->line_total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <div><span>Subtotal</span><span>{{ $order->currency }}{{ number_format($order->subtotal, 2) }}</span></div>
        <div><span>Tax</span><span>{{ $order->currency }}{{ number_format($order->tax, 2) }}</span></div>
        <div><span>Shipping</span><span>{{ $order->currency }}{{ number_format($order->shipping_charge, 2) }}</span></div>
        <div><span>Discount</span><span>{{ $order->currency }}{{ number_format($order->discount, 2) }}</span></div>
        <div class="grand"><span>Total</span><span>{{ $order->currency }}{{ number_format($order->total, 2) }}</span></div>
    </div>

    <p class="muted" style="margin-top:30px;text-align:center;">Thank you for your order!</p>

    <script>window.onload = function () { window.print(); };</script>
</body>
</html>
