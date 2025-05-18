<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Tempat Usaha</title>
    <style>
        @page {
            size: A4;
            margin: 1cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            margin: 0;
            padding: 1cm;
            line-height: 1.5;
        }

        .kop-surat {
            display: flex;
            align-items: center;
            position: relative;
            margin-bottom: 10px;
        }

        .kop-surat img {
            width: 70px;
            height: auto;
        }

        .kop-text {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            width: 100%;
            font-weight: bold;
            line-height: 1.2;
        }

        hr {
            border: 1px solid #000;
            margin: 10px 0;
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
            margin-left: 5%;
            margin-top: 10px;
            width: 100%;
            max-width: 100%;
        }

        table {
            width: 100%;
            font-size: 11pt;
        }

        td {
            vertical-align: top;
            padding: 2px 5px;
        }

        .signature {
            width: 35%;
            margin-left: auto;
            text-align: center;
            margin-top: 2rem;
        }

        .qr-code {
            width: 100px;
            height: 100px;
            margin-top: 10px;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="kop-surat">
        <img src="{{ public_path('admin/assets/img/logo_sbt.png') }}" alt="Logo SBT">
        <div class="kop-text">
            PEMERINTAH KABUPATEN SERAM BAGIAN TIMUR<br>
            KECAMATAN SERAM TIMUR<br>
            NEGERI ADMINISTRATIF AKAT FADEDO<br>
            Jln. Kumbang
        </div>
    </div>

    <hr>

    <div class="center mt-2 bold">
        SURAT KETERANGAN TEMPAT USAHA<br>
        NO: {{ $surat->no_surat ?? '...' }}
    </div>

    <p class="mt-2">
        Yang bertanda tangan di bawah ini, Kepala Pemerintah Negeri Akat Fadedo, Kecamatan Seram Timur,
        Kabupaten Seram Bagian Timur, dengan ini menerangkan bahwa:
    </p>

    <table class="data-surat">
        <tr><td width="200">Nama</td><td>: {{ strtoupper($surat->nama) }}</td></tr>
        <tr><td>Tempat/Tgl Lahir</td><td>: {{ $surat->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d-m-Y') }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>: {{ strtoupper($surat->jenis_kelamin) }}</td></tr>
        <tr><td>Kewarganegaraan</td><td>: {{ strtoupper($surat->kewarganegaraan) }}</td></tr>
        <tr><td>Agama</td><td>: {{ strtoupper($surat->agama) }}</td></tr>
        <tr><td>Pekerjaan</td><td>: {{ strtoupper($surat->pekerjaan) }}</td></tr>
        <tr><td>Alamat</td><td>: {{ strtoupper($surat->alamat) }}</td></tr>
    </table>

    <p class="mt-2">
        Berdasarkan Register Penduduk, benar yang bersangkutan adalah warga Negeri Akat Fadedo yang
        berdomisili di Dusun Akat Fadedo serta membuka/mempunyai usaha sebagai berikut:
    </p>

    <table class="data-surat">
        <tr><td width="200">Nama Tempat Usaha</td><td>: {{ strtoupper($surat->nama_usaha) }}</td></tr>
        <tr><td>Jenis Usaha</td><td>: <span class="bold">"{{ strtoupper($surat->jenis_usaha) }}"</span></td></tr>
        <tr><td>Alamat Tempat Usaha</td><td>: {{ strtoupper($surat->alamat_usaha) }}</td></tr>
        <tr><td>Pemilik Tempat Usaha</td><td>: {{ strtoupper($surat->pemilik_usaha) }}</td></tr>
    </table>

    <p class="mt-2">Demikian surat keterangan ini dibuat dan digunakan sebagaimana mestinya.</p>

    <div class="signature">
        <p>Dikeluarkan di: Fadedo</p>
        <p>Pada Tanggal: {{ $tanggal_dikeluarkan }}</p>
        <p>Kepala Pemerintah Negeri Administratif Akat Fadedo</p>

        @if ($surat->qr_code)
        <img
            src="{{ public_path($surat->qr_code) }}"
            alt="QR Code Verifikasi"
            class="qr-code">
        @endif

        <p class="bold">AHMAD BUGIS</p>
    </div>

</body>
</html>
