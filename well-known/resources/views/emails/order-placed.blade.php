<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your order was received</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f7; font-family: Arial, Helvetica, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f7; padding: 30px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="520" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden;">
                    <tr>
                        <td style="padding: 30px 40px 10px 40px;">
                            <h2 style="margin:0; color:#222;">Hi {{ $order->ship_name ?: 'there' }},</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 40px;">
                            <p style="color:#555; font-size:15px; line-height:24px; margin:0;">
                                Thank you for your order. We've received it with the following details:
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 40px 0 40px;">
                            <p style="margin:0; color:#333; font-size:14px;"><strong>Order:</strong> #{{ $order->order_number }}</p>
                            <p style="margin:4px 0 0 0; color:#333; font-size:14px;"><strong>Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 16px 40px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td style="padding: 8px 0; border-bottom: 1px solid #eee; font-size: 14px; color: #333;">
                                            {{ $item->product_title }}
                                            @if($item->variant_summary)
                                                <br><span style="color:#888; font-size:12px;">{{ $item->variant_summary }}</span>
                                            @endif
                                        </td>
                                        <td style="padding: 8px 0; border-bottom: 1px solid #eee; font-size: 13px; color: #888; text-align: center; white-space: nowrap;">x{{ $item->quantity }}</td>
                                        <td style="padding: 8px 0; border-bottom: 1px solid #eee; font-size: 14px; color: #333; text-align: right; white-space: nowrap;">{{ $order->currency }}{{ number_format($item->line_total, 2) }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 40px 20px 40px;">
                            <div style="background-color:#f4f4f7; border-radius:6px; padding: 20px;">
                                <p style="margin:0 0 6px 0; color:#333; font-size:14px;"><strong>Subtotal:</strong> {{ $order->currency }}{{ number_format($order->subtotal, 2) }}</p>
                                <p style="margin:0 0 6px 0; color:#333; font-size:14px;"><strong>Tax:</strong> {{ $order->currency }}{{ number_format($order->tax, 2) }}</p>
                                <p style="margin:0 0 6px 0; color:#333; font-size:14px;"><strong>Shipping Charge:</strong> {{ $order->currency }}{{ number_format($order->shipping_charge, 2) }}</p>
                                <p style="margin:0 0 6px 0; color:#333; font-size:14px;"><strong>Discount:</strong> {{ $order->currency }}{{ number_format($order->discount, 2) }}</p>
                                <p style="margin:8px 0 0 0; color:#333; font-size:16px;"><strong>Total:</strong> <span style="color:#1cc88a; font-weight:bold;">{{ $order->currency }}{{ number_format($order->total, 2) }}</span></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 40px 20px 40px;">
                            <p style="margin:0 0 6px 0; color:#333; font-size:14px;"><strong>Payment Method:</strong> {{ $order->payment_method_label }}</p>
                            <p style="margin:0 0 6px 0; color:#333; font-size:14px;"><strong>Shipping Address:</strong><br>
                                {{ $order->ship_address_line }}, {{ $order->ship_city }}, {{ $order->ship_state }}, {{ $order->ship_country }}@if($order->ship_postal_code), {{ $order->ship_postal_code }}@endif
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 40px 30px 40px;">
                            <p style="color:#999; font-size:13px; line-height:20px; margin:0;">
                                @if ($order->payment_method_id && $order->payment_status !== 'paid')
                                    Once we verify your payment, you'll receive another email confirming it. Thank you for shopping with us!
                                @else
                                    You'll receive another email as your order moves through processing, shipping and delivery. Thank you for shopping with us!
                                @endif
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
