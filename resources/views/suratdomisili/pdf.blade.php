<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Domisili</title>
    <style>
        @page {
            size: A4;
            margin: 1cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 10.5pt;
            margin: 0;
            padding: 1cm;
            line-height: 1.3;
        }

        .kop-surat {
            display: flex;
            align-items: center;
            position: relative;
            margin-bottom: 5px;
        }

        .kop-surat img {
            width: 65px;
            height: auto;
        }

        .kop-text {
            text-align: center;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            font-weight: bold;
            line-height: 1.1;
        }

        hr {
            border: 1px solid #000;
            margin: 6px 0;
        }

        .bold {
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .mt-1 {
            margin-top: 5px;
        }

        .mt-2 {
            margin-top: 1rem;
        }

        .signature {
            width: 35%;
            margin-left: auto;
            text-align: center;
            margin-top: 15px;
        }

        .isi-paragraf {
            text-align: justify;
        }

        .qr-code {
            width: 90px;
            height: 90px;
            margin-top: 5px;
        }

        .data-surat {
            margin-left: 5%;
            margin-top: 8px;
            width: 100%;
        }

        table {
            width: 100%;
            font-size: 11pt;
        }

        td {
            vertical-align: top;
            padding: 1px 3px;
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
        SURAT KETERANGAN DOMISILI<br>
        NO: {{ $surat->no_surat ?? '...' }}
    </div>

    <p class="mt-2 isi-paragraf">
        Kepala Pemerintah Negeri Akat Fadedo, Kecamatan Seram Timur, Kabupaten Seram Bagian Timur.
        Dengan ini menerangkan bahwa:
    </p>

    <table class="data-surat">
        <tr><td width="200">Nama</td><td>: {{ strtoupper($surat->nama) }}</td></tr>
        <tr><td>Tempat/Tgl Lahir</td><td>: {{ $surat->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d-m-Y') }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>: {{ strtoupper($surat->jenis_kelamin) }}</td></tr>
        <tr><td>Status Kawin</td><td>: {{ strtoupper($surat->status_kawin) }}</td></tr>
        <tr><td>Kewarganegaraan</td><td>: {{ strtoupper($surat->kewarganegaraan) }}</td></tr>
        <tr><td>Pekerjaan</td><td>: {{ strtoupper($surat->pekerjaan) }}</td></tr>
        <tr><td>Alamat</td><td>: {{ strtoupper($surat->alamat) }}</td></tr>
    </table>

    <p class="mt-1 isi-paragraf">
        Bahwa yang bersangkutan di atas benar Warga Masyarakat Negeri Akat Fadedo yang berdomisili
        di Negeri Akat Fadedo, Kecamatan Seram Timur, Kabupaten Seram Bagian Timur.
        Demikian surat keterangan ini dibuat dan digunakan sebagaimana mestinya.
    </p>

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
