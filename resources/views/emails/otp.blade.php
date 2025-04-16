<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <style>
        /* Email-safe CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .email-container {
            background-color: white;
            max-width: 600px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        h1 {
            font-size: 22px;
            color: #343a40;
        }

        p {
            color: #495057;
            font-size: 16px;
            line-height: 1.6;
        }

        .otp-box {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin: 20px 0;
            letter-spacing: 2px;
        }

        .btn {
            display: inline-block;
            background-color: #0d6efd;
            color: white !important;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .subcopy {
            margin-top: 30px;
            font-size: 14px;
            color: #6c757d;
        }

        .subcopy a {
            color: #0d6efd;
            word-break: break-word;
        }

        .footer {
            margin-top: 40px;
            font-size: 13px;
            color: #adb5bd;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h1>Reset Password Anda</h1>
        <p>Kami menerima permintaan reset password untuk akun Anda.<br>
            Gunakan kode OTP berikut atau klik tombol di bawah ini untuk mereset password Anda:</p>

        <div class="otp-box">{{ $otp }}</div>

        <p style="text-align: center;">
            <strong>Gunakan kode di atas langsung di aplikasi Anda.</strong>
        </p>

        <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>

        {{-- <div class="subcopy">
            <p>Jika tombol di atas tidak berfungsi, buka link berikut secara manual:</p>
            <a href="{{ $link }}">{{ $link }}</a>
        </div> --}}

        <div class="footer">
            &copy; {{ date('Y') }} Local Class Technology. All rights reserved.
        </div>
    </div>
</body>

</html>
