<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran UMKM Perlu Diperbaiki</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, #dc3545, #fd7e14);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 10px 10px;
            border: 1px solid #dee2e6;
        }

        .info-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border-left: 5px solid #dc3545;
            margin: 20px 0;
        }

        .alert-box {
            background: #f8d7da;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #f5c6cb;
            margin: 20px 0;
            color: #721c24;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            background: #e9ecef;
            border-radius: 8px;
            font-size: 14px;
            color: #6c757d;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }

        .warning-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="warning-icon">⚠️</div>
        <h1>Pendaftaran UMKM Perlu Diperbaiki</h1>
        <p>Mohon perbaiki data sesuai catatan admin</p>
    </div>

    <div class="content">
        <p>Yth. <strong>{{ $umkm->penduduk->nama_lengkap ?? 'Bapak/Ibu' }}</strong>,</p>

        <p>Terima kasih atas pendaftaran UMKM yang telah Anda kirimkan. Setelah melalui proses verifikasi, kami perlu
            meminta Anda untuk melakukan beberapa perbaikan pada data yang disubmit.</p>

        <div class="info-box">
            <h3>📋 Detail UMKM yang Diajukan:</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 8px 0;"><strong>Nama Usaha:</strong></td>
                    <td>{{ $umkm->nama_usaha }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0;"><strong>Kategori:</strong></td>
                    <td>{{ $umkm->kategori_label }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0;"><strong>Nama Produk:</strong></td>
                    <td>{{ $umkm->nama_produk }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0;"><strong>Tanggal Pengajuan:</strong></td>
                    <td>{{ $umkm->created_at->format('d F Y, H:i') }}</td>
                </tr>
            </table>
        </div>

        <div class="alert-box">
            <h4 style="margin-top: 0;">📝 Catatan dari Admin:</h4>
            <p style="margin-bottom: 0; font-weight: 500;">
                "{{ $catatan_admin }}"
            </p>
        </div>

        <h4>🔧 Langkah yang Perlu Dilakukan:</h4>
        <ol>
            <li><strong>Perbaiki data sesuai catatan admin</strong> di atas</li>
            <li><strong>Pastikan semua informasi akurat</strong> dan sesuai dengan kondisi usaha</li>
            <li><strong>Upload foto produk yang berkualitas</strong> dan menggambarkan produk dengan jelas</li>
            <li><strong>Periksa kembali kontak</strong> yang dapat dihubungi (WhatsApp/telepon)</li>
            <li><strong>Ajukan kembali</strong> setelah semua perbaikan selesai</li>
        </ol>

        <div style="background: #cce5ff; padding: 15px; border-radius: 8px; border: 1px solid #9fcdff; margin: 20px 0;">
            <h4 style="color: #004085; margin-top: 0;">💡 Tips Sukses Pendaftaran:</h4>
            <ul style="color: #004085; margin-bottom: 0;">
                <li>Berikan deskripsi produk yang detail dan menarik</li>
                <li>Gunakan foto produk yang terang dan jelas</li>
                <li>Pastikan kontak yang diberikan selalu aktif</li>
                <li>Isi semua field yang diperlukan dengan lengkap</li>
            </ul>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/dashboard') }}" class="btn">🔄 Daftar Ulang UMKM</a>
        </div>

        <p><strong>Jangan khawatir!</strong> Penolakan ini bukan berarti akhir dari proses. Tim admin hanya ingin
            memastikan data UMKM yang tampil di website desa berkualitas dan akurat. Silakan perbaiki sesuai catatan dan
            daftar kembali.</p>
    </div>

    <div class="footer">
        <p><strong>Desa Akat Fadedo</strong><br>
            Email ini dikirim otomatis oleh sistem. Jangan membalas email ini.<br>
            Jika ada pertanyaan, silakan hubungi kantor desa.</p>

        <p style="margin-top: 15px; font-size: 12px;">
            © {{ date('Y') }} Desa Akat Fadedo. Semua hak dilindungi.
        </p>
    </div>
</body>

</html>
