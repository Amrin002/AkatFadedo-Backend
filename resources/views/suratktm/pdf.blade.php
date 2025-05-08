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
        }


        .bold {
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .mt-4 {
            margin-top: 0.5rem;
        }

        .mt-2 {
            margin-top: 1rem;
        }

        .signature {
            margin-left: 70%;

        }

        .signature .nama {
            text-align: center;
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
            margin-top: 10px;
            margin-bottom: 10px;
        }

        <style>body {
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
        }


        .bold {
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .mt-4 {
            margin-top: 0.5rem;
        }

        .mt-2 {
            margin-top: 1rem;
        }

        .signature {
            margin-left: 70%;

        }

        .signature .nama {
            text-align: center;
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
            margin-top: 7px;
            margin-bottom: 7px;
        }
    </style>
</head>

<body>

    <div class="kop-surat">
        <img src="{{ public_path('admin/assets/img/logo_sbt.png') }}" alt="Logo SBT" width="80">
        <div class="kop-text bold">
            PEMERINTAH KABUPATEN SERAM BAGIAN TIMUR<br>
            KECAMATAN SERAM TIMUR<br>
            NEGERI ADMINISTRATIF AKAT FADEDU<br>
            Jln. Kumbang
        </div>
    </div>

    <hr>

    <div class="center mt-2 bold">
        SURAT KETERANGAN TIDAK MAMPU<br>
        NO: {{ $surat->no_surat ?? '...' }}
    </div>

    <p class="mt-4">Kepala Pemerintah Negeri Administratif Akat Fadedo, Kecamatan Seram Timur, Kabupaten Seram Bagian
        Timur, menerangkan bahwa:</p>

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

    <p class="mt-2">
        Bahwa yang bersangkutan benar berasal dari keluarga yang berpenghasilan tidak tetap (keluarga tidak mampu).
        <br>Demikian surat keterangan ini dibuat dan digunakan sebagaimana mestinya.
    </p>
    <div class="signature">

        <div class="mt-4">
            <p>Dikeluarkan di: Fadedu</p>
            <p>Pada Tanggal: {{ $tanggal_dikeluarkan }}</p>
            <p>Kepala Pemerintah Negeri Administratif Akat Fadedo</p>
            {{-- Tambahkan QR Code di sini --}}
            @if ($surat->qr_code)
                <img src="{{ public_path($surat->qr_code) }}" alt="QR Code Verifikasi" class="qr-code"
                    style="width: 100px; height: 100px;">
            @endif
            <p class="nama"><strong>AHMAD BUGIS</strong></p>
        </div>
    </div>

</body>

</html>
