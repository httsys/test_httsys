<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your payment was confirmed</title>
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
                                Great news — we've verified your payment. Your order is confirmed and will be processed shortly.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 40px;">
                            <div style="background-color:#f4f4f7; border-radius:6px; padding: 20px;">
                                <p style="margin:0 0 8px 0; color:#333; font-size:14px;"><strong>Order:</strong> #{{ $order->order_number }}</p>
                                <p style="margin:0 0 8px 0; color:#333; font-size:14px;"><strong>Amount Paid:</strong> <span style="color:#1cc88a; font-weight:bold;">{{ $order->currency }}{{ number_format($order->total, 2) }}</span></p>
                                <p style="margin:0; color:#333; font-size:14px;"><strong>Payment Method:</strong> {{ $order->payment_method_label }}</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 40px 30px 40px;">
                            <p style="color:#999; font-size:13px; line-height:20px; margin:0;">
                                Please keep this email as your payment receipt. Thank you for shopping with us.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
