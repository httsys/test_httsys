<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>We could not complete your donation</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f7; font-family: Arial, Helvetica, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f7; padding: 30px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="480" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden;">
                    <tr>
                        <td style="padding: 30px 40px 10px 40px;">
                            <h2 style="margin:0; color:#222;">Hi {{ $donation->donor_name ?: 'there' }},</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 40px;">
                            <p style="color:#555; font-size:15px; line-height:24px; margin:0;">
                                Unfortunately, we were unable to confirm your donation due to a payment issue. It has not been completed.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 40px;">
                            <div style="background-color:#f4f4f7; border-radius:6px; padding: 20px;">
                                <p style="margin:0 0 8px 0; color:#333; font-size:14px;"><strong>Fund:</strong> {{ $donation->fund->title }}</p>
                                <p style="margin:0 0 8px 0; color:#333; font-size:14px;"><strong>Amount:</strong> ৳{{ number_format($donation->amount, 2) }}</p>
                                <p style="margin:0 0 8px 0; color:#333; font-size:14px;"><strong>Payment Method:</strong> {{ $donation->paymentMethod->name }}</p>
                                <p style="margin:0; color:#333; font-size:14px;"><strong>Reference:</strong> {{ $donation->reference }}</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 40px 30px 40px;">
                            <p style="color:#555; font-size:14px; line-height:22px; margin:0 0 12px 0;">
                                Please try again, or reach out to us if you believe this is a mistake.
                            </p>
                            <a href="{{ route('donations.index') }}" style="display:inline-block; background-color:#4e73df; color:#ffffff; text-decoration:none; padding:10px 22px; border-radius:6px; font-size:14px; font-weight:bold;">Try Again</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
