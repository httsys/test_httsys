<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your verification code</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f7; font-family: Arial, Helvetica, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f7; padding: 30px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="480" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden;">
                    <tr>
                        <td style="padding: 30px 40px 10px 40px;">
                            <h2 style="margin:0; color:#222;">Hi {{ $name }},</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 40px;">
                            <p style="color:#555; font-size:15px; line-height:24px; margin:0;">
                                Use the code below to verify your email address. This code is valid for a limited time.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 40px;">
                            <div style="background-color:#f4f4f7; border-radius:6px; text-align:center; padding: 20px;">
                                <span style="font-size:32px; letter-spacing:8px; font-weight:bold; color:#4e73df;">{{ $code }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 40px 30px 40px;">
                            <p style="color:#999; font-size:13px; line-height:20px; margin:0;">
                                If you didn't request this code, you can safely ignore this email.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
