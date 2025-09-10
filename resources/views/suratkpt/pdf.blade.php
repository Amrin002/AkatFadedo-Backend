<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Penghasilan Tetap</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.4;
            margin: 0;
            padding: 10px;
            font-size: 14px;
        }

        .kop-surat {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            margin-bottom: 8px;
        }

        .kop-surat img {
            width: 70px;
            height: auto;
        }

        .kop-text {
            text-align: center;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            line-height: 1.1;
            font-weight: bold;
            font-size: 15px;
        }

        .center {
            text-align: center;
        }

        .mt-1 {
            margin-top: 8px;
        }

        .mt-2 {
            margin-top: 12px;
        }

        .mt-3 {
            margin-top: 16px;
        }

        .data-surat {
            margin-left: 8%;
        }

        table {
            width: 100%;
            max-width: 600px;
        }

        td {
            vertical-align: top;
            padding: 1px 5px;
            font-size: 14px;
        }

        hr {
            margin: 5px 0;
            border: 0;
            border-top: 1px solid #000;
        }

        .signature {
            width: 40%;
            margin-left: auto;
            text-align: center;
            margin-top: 15px;
        }

        .signature p {
            margin: 3px 0;
            font-size: 14px;
        }

        .isi-paragraf {
            text-align: justify;
            margin: 8px 0;
            font-size: 14px;
            line-height: 1.3;
        }

        .qr-code {
            width: 80px;
            height: 80px;
        }

        .qr-placeholder {
            width: 80px;
            height: 80px;
            margin: 10px auto;
            border: 2px dashed #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8px;
            color: #999;
            background-color: #f9f9f9;
            text-align: center;
        }

        .judul-surat {
            font-size: 14px;
            font-weight: bold;
            margin: 10px 0;
        }

        .nama-kepala {
            font-weight: bold;
            font-size: 14px;
            margin-top: 15px;
        }
    </style>
</head>

<body>

    <div class="kop-surat">
        <img src="{{ public_path('admin/assets/img/logo_sbt.png') }}" alt="Logo SBT">
        <div class="kop-text">
            PEMERINTAH KABUPATEN SERAM BAGIAN TIMUR<br>
            KECAMATAN UKAR SENGAN<br>
            NEGERI ADMINISTRATIF AKAT FADEDO<br>
            Jln. Kumbang
        </div>
    </div>

    <hr>

    <div class="center mt-2 bold">
        SURAT KETERANGAN PENGHASILAN TETAP<br>
        NO: {{ $surat->no_surat ?? '...' }}
    </div>

    <p class="isi-paragraf">
        Yang bertanda tangan dibawah ini:
    </p>

    <table class="data-surat">
        <tr>
            <td style="width: 100px">Nama</td>
            <td>: {{ $surat->nama ?? 'Kepala Desa' }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>: {{ $surat->jabatan ?? 'Kepala Desa' }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ $surat->alamat ?? 'Alamat Desa' }}</td>
        </tr>
    </table>

    <p class="isi-paragraf">
        menerangkan dengan sebenarnya bahwa:
    </p>

    <table class="data-surat">
        <tr>
            <td style="width: 100px">Nama</td>
            <td>: {{ $surat->nama_yang_bersangkutan }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: {{ $surat->nik }}</td>
        </tr>
        <tr>
            <td>TTL</td>
            <td>: {{ $surat->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d F Y') }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: {{ $surat->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>: {{ $surat->agama }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>: {{ $surat->pekerjaan }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ $surat->alamat_yang_bersangkutan }}</td>
        </tr>
    </table>

    <p class="isi-paragraf">
        Bahwa yang bersangkutan merupakan Anak Kandung dari Pasangan {{ $surat->nama_ayah }} dan
        {{ $surat->nama_ibu }} dengan pekerjaan sebagai
        {{ $surat->pekerjaan_orang_tua }} dengan penghasilan sebesar Rp.
        {{ number_format($surat->penghasilan_per_bulan, 0, ',', '.') }} per bulan sehingga masuk kategori Masyarakat
        yang kurang mampu.
        <br>
        Surat Keterangan ini diberikan untuk {{ $surat->keperluan }}.
        <br>
        Demikian surat keterangan ini dibuat dan digunakan sebagaimana mestinya.
    </p>

    <div class="signature">
        <p>Dikeluarkan di: Fadedo</p>
        <p>Pada Tanggal: {{ $tanggal_dikeluarkan }}</p>
        <p>Kepala Pemerintah Negeri Administratif Akat Fadedo</p>

        @if ($surat->qr_code)
            <img src="{{ public_path($surat->qr_code) }}" alt="QR Code Verifikasi" class="qr-code">
        @endif

        <p class="bold">Muhamad Arsad Talahatu</p>
    </div>

</body>

</html>
