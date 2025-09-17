<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM Disetujui</title>
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
            background: linear-gradient(135deg, #28a745, #20c997);
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
            border-left: 5px solid #28a745;
            margin: 20px 0;
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
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }

        .success-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="success-icon">✅</div>
        <h1>Selamat! UMKM Anda Telah Disetujui</h1>
        <p>Pendaftaran UMKM Anda telah berhasil diverifikasi</p>
    </div>

    <div class="content">
        <p>Yth. <strong>{{ $umkm->penduduk->nama_lengkap ?? 'Bapak/Ibu' }}</strong>,</p>

        <p>Kami dengan senang hati memberitahukan bahwa pendaftaran UMKM Anda telah <strong>DISETUJUI</strong> oleh tim
            admin Desa Akat Fadedo.</p>

        <div class="info-box">
            <h3>📋 Detail UMKM yang Disetujui:</h3>
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
                    <td style="padding: 8px 0;"><strong>Tanggal Disetujui:</strong></td>
                    <td>{{ $tanggal_approval }}</td>
                </tr>
            </table>
        </div>

        <div style="background: #d4edda; padding: 15px; border-radius: 8px; border: 1px solid #c3e6cb; margin: 20px 0;">
            <h4 style="color: #155724; margin-top: 0;">🎉 Selamat!</h4>
            <p style="color: #155724; margin-bottom: 0;">
                UMKM Anda sekarang telah terdaftar resmi dan akan tampil di website Desa Akat Fadedo.
                Masyarakat dapat melihat dan menghubungi usaha Anda melalui platform digital desa.
            </p>
        </div>

        <h4>📞 Langkah Selanjutnya:</h4>
        <ul>
            <li>UMKM Anda akan tampil di direktori UMKM desa</li>
            <li>Pastikan nomor kontak yang terdaftar aktif untuk dihubungi pelanggan</li>
            <li>Jaga kualitas produk dan pelayanan untuk kepuasan pelanggan</li>
            <li>Manfaatkan media sosial yang sudah terdaftar untuk promosi</li>
        </ul>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/daftar-umkm') }}" class="btn">📱 Lihat UMKM Saya di Website</a>
        </div>
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
