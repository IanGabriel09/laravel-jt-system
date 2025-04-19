<!DOCTYPE html>
<html>
<head>
    <title>User Authorized</title>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f6f8; padding: 30px; color: #333;">

    <div style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 30px 35px; border-radius: 8px; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);">

        <h1 style="color: #2c3e50;">Hello {{ $user->fName }},</h1>

        <p style="font-size: 16px; line-height: 1.6;">
            Great news! Your account has been <strong style="color: #27ae60;">successfully authorized</strong>.
        </p>

        <p style="font-size: 16px; line-height: 1.6;">
            You can now log in and access your dashboard using the link below:
        </p>

        <div style="margin: 30px 0;">
            <a href="{{ route('auth_login') }}" style="background-color: #3498db; color: #ffffff; padding: 12px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">
                Log In Here
            </a>
        </div>

        <p style="font-size: 14px; color: #777;">
            If you didn’t request this access or believe this was a mistake, please contact MIS team at local phone directory 277 or 201.
        </p>

        <p style="margin-top: 40px; font-size: 15px;">
            Thanks,<br>
            <strong>KFCP MIS Team</strong>
        </p>

    </div>

</body>
</html>
