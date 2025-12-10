<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>{{ $title ?? 'Surat Pengantar SKCK' }}</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            margin: 0;
        }

        /* Wrapper halaman → margin kiri kanan ditambah */
        .page-wrapper {
            margin: 0 35px; /* Tambahkan margin kiri-kanan halaman */
        }

        /* Kop Surat */
        .header {
            text-align: center;
            position: relative;
        }
        .header h3 {
            margin: 0;
            font-size: 12pt;
            text-transform: uppercase;
            font-weight: normal;
        }
        .header h2 {
            margin: 0;
            font-size: 16pt;
            text-transform: uppercase;
            font-weight: bold;
        }
        .header p {
            margin: 0;
            font-size: 10pt;
            font-style: italic;
        }

        .line-container {
            margin-top: 10px;
            margin-bottom: 20px;
            border-bottom: 5px double black;
        }

        /* Judul */
        .title-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .title-container u {
            font-weight: bold;
            font-size: 12pt;
            text-transform: uppercase;
        }
        .nomor-surat {
            margin-top: 2px;
        }

        /* Konten → margin kiri kanan diperbesar lagi */
        .content {
            text-align: justify;
            margin: 0 20px; /* Tambah margin kiri-kanan konten */
        }

        /* Tabel Biodata */
        .table-data {
            margin-left: 40px; /* Tambah jarak agar lebih ke tengah */
            width: 100%;
            border-collapse: collapse;
        }
        .table-data td {
            vertical-align: top;
            padding: 2px 0;
        }
        .label {
            width: 180px;
        }
        .colon {
            width: 20px;
            text-align: center;
        }

        .closing {
            margin-top: 15px;
            text-indent: 30px;
        }

        /* Tanda Tangan */
        .signature-container {
            margin-top: 30px;
            width: 100%;
            display: table;
        }
        .signature-box {
            display: table-cell;
            width: 50%;
        }
        .signature-right {
            display: table-cell;
            width: 50%;
            text-align: center;
            vertical-align: top;
        }
        .signature-name {
            margin-top: 70px;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
        }
        .logo-container {
            position: absolute;
            left: 0;
            top: 0;
        }

        .logo-container img {
            width: 80px;   /* Sesuaikan ukuran logo */
            height: auto;
        }
    </style>
</head>
<body>

<div class="page-wrapper">

    <div class="header">

        <div class="logo-container">
            <img src="{{ public_path('logosurat.png') }}" alt="Logo Desa">
        </div>

        <h3><b>PEMERINTAH KABUPATEN GARUT</b></h3>
        <h3><b>KECAMATAN BAYONGBONG</b></h3>
        <h2>DESA BANJARSARI</h2>
        <p><b>Alamat: Jln. Ciloa No. 09 Banjarsari Bayongbong Garut - 44162</b></p>
    </div>

    <div class="line-container"></div>

    <div class="title-container">
        <u>SURAT PENGANTAR PERMOHONAN SKCK</u>
        <div class="nomor-surat">Nomor: {{ $pengajuan->nomor_surat ?? '333.1/..../VIII/Ds.-2021' }}</div>
    </div>

    <div class="content">

        <p>Yang bertanda tangan di bawah ini Kepala Desa Banjarsari Kecamatan Bayongbong Kabupaten Garut, dengan ini menerangkan bahwa :</p>

        <table class="table-data">
            <tr>
                <td class="label">Nama</td>
                <td class="colon">:</td>
                <td>{{ $pengajuan->data['nama'] ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Tempat/Tanggal Lahir</td>
                <td class="colon">:</td>
                <td>{{ $pengajuan->data['ttl'] ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Jenis Kelamin</td>
                <td class="colon">:</td>
                <td>{{ $pengajuan->data['jenis_kelamin'] ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Pekerjaan</td>
                <td class="colon">:</td>
                <td>{{ $pengajuan->data['pekerjaan'] ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Status</td>
                <td class="colon">:</td>
                <td>{{ $pengajuan->data['status'] ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Agama</td>
                <td class="colon">:</td>
                <td>{{ $pengajuan->data['agama'] ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">NIK</td>
                <td class="colon">:</td>
                <td>{{ $pengajuan->data['nik'] ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Kewarganegaraan</td>
                <td class="colon">:</td>
                <td>{{ $pengajuan->data['kewarganegaraan'] ?? 'INDONESIA' }}</td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td class="colon">:</td>
                <td>{{ $pengajuan->data['alamat'] ?? '-' }}</td>
            </tr>
        </table>

        <p>
            Yang tersebut di atas berdasarkan keterangan dari Ketua RT/RW setempat dan menurut data yang ada pada kami, adalah benar-benar warga kami, yang datang ke Kantor Desa kami memohon Surat Keterangan <b><i>SKCK</i></b> untuk melengkapi persyaratan :
        </p>

        <div style="text-align: center; font-weight: bold; margin: 10px 0; text-transform: uppercase;">
            <i>"{{ $pengajuan->data['keperluan'] ?? 'PEMBUATAN SKCK' }}"</i>
        </div>

        <p>
            Demikian surat keterangan ini kami buat, agar yang berkepentingan mengetahui dan untuk dipergunakan sebagaimana mestinya.
        </p>
    </div>

    <div class="signature-container">
        <div class="signature-box"></div>
        <div class="signature-right">
            <div>Banjarsari, {{ date('d F Y') }}</div>
            <div style="margin-bottom: 5px;">a.n. Kepala Desa Banjarsari</div>
            <div>Sekretaris Desa</div>

            <div class="signature-name">
                {{ $penandatangan ?? 'RESTY FITRIANA' }}
            </div>
        </div>
    </div>

</div>

</body>
</html>
