<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Tempat Pindah Domisili</title>
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
            line-height: 1.4;
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
            margin: 8px 0;
            border: 1px solid #000;
        }

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .mt-2 {
            margin-top: 10px;
        }

        .mt-4 {
            margin-top: 15px;
        }

        .data-surat {
            margin-left: 5%;
            width: 100%;
            max-width: 100%;
            margin-top: 10px;
        }

        table {
            width: 100%;
            font-size: 12pt;
        }

        td {
            vertical-align: top;
            padding: 2px 4px;
        }

        .signature {
            margin-left: 70% ;
            text-align: center;
        }

        .nama {
            margin-left: 70% ;
            text-align: center;
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
        SURAT KETERANGAN PINDAH DOMISILI<br>
        NO: {{ $surat->no_surat ?? '...' }}
    </div>

    <p class="mt-2">
        Kepala Pemerintah Negeri Administratif Akat Fadedo, Kecamatan Seram Timur, Kabupaten Seram Bagian Timur.
    </p>
    <p>
        Dengan ini menerangkan bahwa :
    </p>

    <table class="data-surat">
        <tr><td width="200">Nama</td><td>: {{ strtoupper($surat->nama) }}</td></tr>
        <tr><td>Tempat/Tgl Lahir</td><td>: {{ $surat->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d-m-Y') }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>: {{ strtoupper($surat->jenis_kelamin) }}</td></tr>
        <tr><td>Kewarganegaraan</td><td>: {{ strtoupper($surat->kewarganegaraan) }}</td></tr>
        <tr><td>Pekerjaan</td><td>: {{ strtoupper($surat->pekerjaan) }}</td></tr>
        <tr><td>Kecamatan</td><td>: {{ strtoupper($surat->kecamatan) }}</td></tr>
        <tr><td>Kabupaten</td><td>: {{ strtoupper($surat->kabupaten) }}</td></tr>
        <tr><td>Alamat</td><td>: {{ strtoupper($surat->alamat) }}</td></tr>
    </table>

    <p class="mt-2">
        Bahwa yang bersangkutan di atas benar warga Masyarakat Negeri Administratif Akat Fadedo yang berdomisili di Negeri Administratif Akat Fadedo
        Kecamatan Seram Timur, Kabupaten Seram Bagian Timur. Dan saat ini telah berpindah alamat ke :
    </p>

    <table class="data-surat">
        <tr><td width="200">Desa</td><td>: {{ strtoupper($surat->desa_pindah) }}</td></tr>
        <tr><td>RT/RW</td><td>: {{ str_pad($surat->rt, 2, '0', STR_PAD_LEFT) }}/{{ str_pad($surat->rw, 2, '0', STR_PAD_LEFT) }}</td></tr>
        <tr><td>Jalan</td><td>: {{ strtoupper($surat->jalan) }}</td></tr>
        <tr><td>Kecamatan</td><td>: {{ strtoupper($surat->kecamatan_pindah) }}</td></tr>
        <tr><td>Kabupaten</td><td>: {{ strtoupper($surat->kabupaten_pindah) }}</td></tr>
        <tr><td>Provinsi</td><td>: {{ strtoupper($surat->provinsi) }}</td></tr>
    </table>

    <p class="mt-2">Demikian surat keterangan ini dibuat dan digunakan sebagaimana mestinya.</p>

    <div class="signature">

        <div class="mt-4">
            <p>Dikeluarkan di: Fadedo</p>
            <p>Pada Tanggal: {{ $tanggal_dikeluarkan }}</p>
            <p>Kepala Pemerintah Negeri Administratif Akat Fadedo</p>
            {{-- Tambahkan QR Code di sini --}}
            @if ($surat->qr_code)
            <img
                src="{{ $surat->qr_code ? public_path($surat->qr_code) : public_path('images/qrcode_place.png') }}"
                alt="QR Code Verifikasi"
                class="qr-code"
                style="width: 100px; height: 100px;">
            @endif
            <p class="nama"><strong>AHMAD BUGIS</strong></p>
        </div>
    </div>

</body>
</html>

