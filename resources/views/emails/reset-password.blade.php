<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Your Password</title>
</head>
<body style="margin:0; padding:0; background:#f4f7fb; font-family:Arial, Helvetica, sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f4f7fb; padding:40px 0;">
    <tr>
        <td align="center">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:600px; background:#ffffff; border-radius:16px; overflow:hidden; box-shadow:0 8px 24px rgba(0,0,0,0.08);">
                <tr>
                    <td style="background:linear-gradient(135deg, #2563eb, #1d4ed8); padding:28px 32px; text-align:center;">
                        <h1 style="margin:0; color:#ffffff; font-size:24px; font-weight:700;">Account Management System</h1>
                        <p style="margin:8px 0 0; color:#dbeafe; font-size:14px;">Secure account access and verification</p>
                    </td>
                </tr>

                <tr>
                    <td style="padding:40px 32px; text-align:center;">
                        <h2 style="margin:0 0 12px; color:#111827; font-size:26px;">Reset Your Password</h2>
                        <p style="margin:0 0 28px; color:#4b5563; font-size:16px; line-height:1.6;">
                            Hello {{ $user->fullname }}, we received a request to reset your password. Click the button below to set a new password.
                        </p>

                        <a href="{{ $resetLink }}"
                           style="display:inline-block; background:#2563eb; color:#ffffff; text-decoration:none; font-size:16px; font-weight:700; padding:14px 28px; border-radius:10px;">
                            Reset Password
                        </a>

                        <p style="margin:28px 0 8px; color:#6b7280; font-size:13px;">
                            This password reset link will expire in 1 hour.
                        </p>
                        <p style="margin:0; word-break:break-all; font-size:13px; color:#2563eb;">
                            {{ $resetLink }}
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>