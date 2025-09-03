<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Tidak Mampu</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.6;
        }

        .kop-surat {
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
        }

        .kop-surat img {
            width: 80px;
            height: auto;
        }

        .kop-text {
            text-align: center;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            line-height: 1.2;
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .mt-2 {
            margin-top: 1rem;
        }

        .mt-4 {
            margin-top: 2rem;
        }

        .data-surat {
            margin-left: 10%;
        }

        table {
            width: 100%;
            max-width: 600px;
        }

        td {
            vertical-align: top;
            padding: 2px 5px;
        }

        hr {
            margin: 10px 0;
        }

        .signature {
            width: 35%;
            margin-left: auto;
            text-align: center;
        }

        .isi-paragraf {
            text-align: justify;
        }

        .qr-code {
            width: 100px;
            height: 100px;
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

    <div class="center mt-2">
        <strong>SURAT KETERANGAN TIDAK MAMPU</strong><br>
        NO: {{ $surat->no_surat ?? '...' }}
    </div>

    <p class="mt-4 isi-paragraf">
        Kepala Pemerintah Negeri Administratif Akat Fadedo, Kecamatan Ukar Sengan, Kabupaten Seram Bagian Timur,
        menerangkan bahwa:
    </p>

    <table class="data-surat">
        <tr>
            <td width="200">Nama</td>
            <td>: {{ strtoupper($surat->nama) }}</td>
        </tr>
        <tr>
            <td>Tempat/Tgl Lahir</td>
            <td>: {{ $surat->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: {{ strtoupper($surat->jenis_kelamin) }}</td>
        </tr>
        <tr>
            <td>Status Kawin</td>
            <td>: {{ strtoupper($surat->status_kawin) }}</td>
        </tr>
        <tr>
            <td>Kewarganegaraan</td>
            <td>: {{ strtoupper($surat->kewarganegaraan) }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ strtoupper($surat->alamat) }}</td>
        </tr>
    </table>

    <p class="mt-2 isi-paragraf">
        Bahwa yang bersangkutan benar berasal dari keluarga yang berpenghasilan tidak tetap (keluarga tidak mampu).
        <br>Demikian surat keterangan ini dibuat dan digunakan sebagaimana mestinya.
    </p>

    <div class="signature mt-4">
        <p>Dikeluarkan di: Fadedo</p>
        <p>Pada Tanggal: {{ $tanggal_dikeluarkan }}</p>
        <p>Kepala Pemerintah Negeri Administratif Akat Fadedo</p>

        @if ($surat->qr_code)
            <img src="{{ public_path($surat->qr_code) }}" alt="QR Code Verifikasi" class="qr-code">
        @endif

        <p><strong>Muhamad Arsad Talahatu</strong></p>
    </div>

</body>

</html>
