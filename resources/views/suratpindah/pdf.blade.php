<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Tempat Pindah Domisili</title>
    <style>
        @page {
            size: A4;
            margin: 0.8cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 10.5pt;
            margin: 0;
            padding: 0.8cm;
            line-height: 1.3;
        }

        .kop-surat {
            display: flex;
            align-items: center;
            position: relative;
            margin-bottom: 4px;
        }

        .kop-surat img {
            width: 60px;
            height: auto;
        }

        .kop-text {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            width: 100%;
            font-weight: bold;
            line-height: 1.1;
            font-size: 11pt;
        }

        hr {
            margin: 2px 0;
            border: 0.5px solid #000;
        }

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .mt {
            margin-top: 6px;
        }

        .data-surat {
            margin-left: 5%;
            width: 100%;
            margin-top: 5px;
        }

        table {
            width: 100%;
            font-size: 10.5pt;
        }

        td {
            vertical-align: top;
            padding: 1px 2px;
        }

        .signature, .nama {
            margin-left: 65%;
            text-align: center;
        }

        .justify {
            text-align: justify;
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

<div class="center mt bold">
    SURAT KETERANGAN PINDAH DOMISILI<br>
    NO: {{ $surat->no_surat ?? '...' }}
</div>

<p class="mt justify">
    Kepala Pemerintah Negeri Administratif Akat Fadedo, Kecamatan Seram Timur, Kabupaten Seram Bagian Timur.
</p>
<p class="justify">Dengan ini menerangkan bahwa:</p>

<table class="data-surat">
    <tr><td width="180">Nama</td><td>: {{ strtoupper($surat->nama) }}</td></tr>
    <tr><td>Tempat/Tgl Lahir</td><td>: {{ $surat->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->format('d-m-Y') }}</td></tr>
    <tr><td>Jenis Kelamin</td><td>: {{ strtoupper($surat->jenis_kelamin) }}</td></tr>
    <tr><td>Kewarganegaraan</td><td>: {{ strtoupper($surat->kewarganegaraan) }}</td></tr>
    <tr><td>Pekerjaan</td><td>: {{ strtoupper($surat->pekerjaan) }}</td></tr>
    <tr><td>Kecamatan</td><td>: {{ strtoupper($surat->kecamatan) }}</td></tr>
    <tr><td>Kabupaten</td><td>: {{ strtoupper($surat->kabupaten) }}</td></tr>
    <tr><td>Alamat</td><td>: {{ strtoupper($surat->alamat) }}</td></tr>
</table>

<p class="mt justify">
    Bahwa yang bersangkutan di atas benar warga Masyarakat Negeri Administratif Akat Fadedo yang berdomisili di Negeri Administratif Akat Fadedo, Kecamatan Seram Timur, Kabupaten Seram Bagian Timur. Dan saat ini telah berpindah alamat ke:
</p>

<table class="data-surat">
    <tr><td width="180">Desa</td><td>: {{ strtoupper($surat->desa_pindah) }}</td></tr>
    <tr><td>RT/RW</td><td>: {{ str_pad($surat->rt, 2, '0', STR_PAD_LEFT) }}/{{ str_pad($surat->rw, 2, '0', STR_PAD_LEFT) }}</td></tr>
    <tr><td>Jalan</td><td>: {{ strtoupper($surat->jalan) }}</td></tr>
    <tr><td>Kecamatan</td><td>: {{ strtoupper($surat->kecamatan_pindah) }}</td></tr>
    <tr><td>Kabupaten</td><td>: {{ strtoupper($surat->kabupaten_pindah) }}</td></tr>
    <tr><td>Provinsi</td><td>: {{ strtoupper($surat->provinsi) }}</td></tr>
</table>

<p class="mt justify">Demikian surat keterangan ini dibuat dan digunakan sebagaimana mestinya.</p>

<div class="signature mt">
    <p>Dikeluarkan di: Fadedo</p>
    <p>Pada Tanggal: {{ $tanggal_dikeluarkan }}</p>
    <p>Kepala Pemerintah Negeri Administratif Akat Fadedo</p>

    @if ($surat->qr_code)
    <img src="{{ $surat->qr_code ? public_path($surat->qr_code) : public_path('images/qrcode_place.png') }}"
         alt="QR Code Verifikasi" style="width: 80px; height: 80px;">
    @endif

    <p class="nama">AHMAD BUGIS</p>
</div>

</body>
</html>
