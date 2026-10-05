<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your order status was updated</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f7; font-family: Arial, Helvetica, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f7; padding: 30px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="480" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden;">
                    <tr>
                        <td style="padding: 30px 40px 10px 40px;">
                            <h2 style="margin:0; color:#222;">Hi {{ $order->ship_name ?: 'there' }},</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 40px;">
                            <p style="color:#555; font-size:15px; line-height:24px; margin:0;">
                                @if ($order->status === 'confirmed')
                                    Your order has been confirmed and is now being prepared.
                                @elseif ($order->status === 'on_the_way')
                                    Your order is on the way! It should arrive soon.
                                @elseif ($order->status === 'delivered')
                                    Your order has been delivered. Thank you for shopping with us!
                                @elseif ($order->status === 'cancelled')
                                    Your order has been cancelled. If you weren't expecting this, please contact us.
                                @else
                                    Your order status has been updated to "{{ ucfirst(str_replace('_', ' ', $order->status)) }}".
                                @endif
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 40px;">
                            <div style="background-color:#f4f4f7; border-radius:6px; padding: 20px;">
                                <p style="margin:0 0 8px 0; color:#333; font-size:14px;"><strong>Order:</strong> #{{ $order->order_number }}</p>
                                <p style="margin:0 0 8px 0; color:#333; font-size:14px;"><strong>Total:</strong> {{ $order->currency }}{{ number_format($order->total, 2) }}</p>
                                <p style="margin:0; color:#333; font-size:14px;"><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $order->status)) }}</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 40px 30px 40px;">
                            <p style="color:#999; font-size:13px; line-height:20px; margin:0;">
                                Thank you for shopping with us.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
