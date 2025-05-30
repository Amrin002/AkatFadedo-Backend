<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Surat Telah Disetujui</title>
    <style>
        /* Email-safe CSS */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            color: #495057;
        }

        .email-container {
            background-color: white;
            max-width: 600px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 26px;
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
        }

        .info-box {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            font-size: 16px;
        }

        .info-box p {
            margin: 5px 0;
        }

        .instructions {
            background-color: #f1f3f5;
            padding: 20px;
            border-radius: 8px;
            font-size: 16px;
            margin-top: 20px;
        }

        .instructions p {
            margin: 10px 0;
        }

        ol {
            margin-left: 20px;
            margin-top: 10px;
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
        <h1>Surat Anda Telah Disetujui!</h1>

        <p>Kami dengan senang hati menginformasikan bahwa surat Anda telah disetujui dan kini siap untuk diunduh.</p>

        <div class="info-box">
            <p><strong>Nomor Surat:</strong> {{ $noSurat }}</p>
            <p><strong>Tanggal Terbit:</strong> {{ $tanggalTerbit->format('d F Y') }}</p>
            <p><strong>Tipe Surat:</strong> {{ $typeSurat }}</p>
        </div>

        <p>Untuk mengunduh surat Anda, kami mengundang Anda untuk memeriksa aplikasi Layanan Desa. Berikut adalah cara
            untuk melakukannya:</p>

        <div class="instructions">
            <p><strong>Langkah-langkah yang perlu Anda ikuti:</strong></p>
            <ol>
                <li>Masuk ke aplikasi Layanan Desa</li>
                <li>Login menggunakan NIK dan Password Anda</li>
                <li>Kunjungi menu <strong>Layanan Pengaduan Surat</strong></li>
                <li>Temukan <strong>{{ $typeSurat }}</strong> dengan Nomor Surat
                    <strong>{{ $noSurat }}</strong>
                </li>
                <li>Klik tombol <strong>Unduh</strong> untuk mendownload surat Anda</li>
            </ol>
        </div>

        <p>Jika Anda mengalami kesulitan atau memiliki pertanyaan, jangan ragu untuk menghubungi kami.</p>

        <div class="footer">
            &copy; {{ date('Y') }} Local Class Technology. All rights reserved.
        </div>
    </div>
</body>

</html>
