<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>{{ $title ?? 'Surat Keterangan Tidak Mampu' }}</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            margin: 0;
        }

        /* Wrapper halaman → margin kiri kanan disamakan dengan contoh */
        .page-wrapper {
            margin: 0 35px;
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
            /* Font style italic dihilangkan untuk alamat agar sesuai pdf SKTM source: 3, 
               tapi jika ingin seragam dengan layout SKCK, bisa dikembalikan ke italic */
            font-style: normal; 
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

        /* Konten */
        .content {
            text-align: justify;
            margin: 0 20px;
        }

        /* Tabel Biodata */
        .table-data {
            margin-left: 40px; 
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .table-data td {
            vertical-align: top;
            padding: 2px 0;
        }
        .label {
            width: 180px; /* Lebar label disesuaikan */
        }
        .colon {
            width: 20px;
            text-align: center;
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
            text-align: center; /* Sesuai PDF SKTM source: 10, posisi rata tengah di kanan */
            vertical-align: top;
        }
        .signature-name {
            margin-top: 70px;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
        }
        
        /* Logo (Opsional) */
        .logo-container {
            position: absolute;
            left: 0;
            top: 0;
        }
        .logo-container img {
            width: 80px;
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
        <p><b><i>Alamat: Jln. Ciloa No. 09 Banjarsari Bayongbong Garut 44162</i></b></p>
    </div>

    <div class="line-container"></div>

    <div class="title-container">
        <u>SURAT KETERANGAN TIDAK MAMPU</u>
        <div class="nomor-surat">Nomor: {{ $pengajuan->nomor_surat ?? '145.1/.../VII/Ds.-2017' }}</div>
    </div>

    <div class="content">
        <p>Yang bertanda tangan di bawah ini Kepala Desa Banjarsari Kecamatan Bayongbong Kabupaten Garut, dengan ini menerangkan bahwa :</p>

        <table class="table-data">
            <tr>
                <td class="label">Nama</td>
                <td class="colon">:</td>
                <td>{{ $pengajuan->data['nama'] ?? 'HILMI ZAIDAN FIKRI' }}</td>
            </tr>
            <tr>
                <td class="label">Tempat/Tanggal Lahir</td>
                <td class="colon">:</td>
                <td>{{ $pengajuan->data['ttl'] ?? 'GARUT, 08-01-2001' }}</td>
            </tr>
            <tr>
                <td class="label">Jenis Kelamin</td>
                <td class="colon">:</td>
                <td>{{ $pengajuan->data['jenis_kelamin'] ?? 'PEREMPUAN' }}</td>
            </tr>
            <tr>
                <td class="label">Pekerjaan</td>
                <td class="colon">:</td>
                <td>{{ $pengajuan->data['pekerjaan'] ?? 'MENGURUS RUMAH TANGGA' }}</td>
            </tr>
            <tr>
                <td class="label">Status</td>
                <td class="colon">:</td>
                <td>{{ $pengajuan->data['status'] ?? 'KAWIN' }}</td>
            </tr>
            <tr>
                <td class="label">Agama</td>
                <td class="colon">:</td>
                <td>{{ $pengajuan->data['agama'] ?? 'ISLAM' }}</td>
            </tr>
            <tr>
                <td class="label">NIK</td>
                <td class="colon">:</td>
                <td>{{ $pengajuan->data['nik'] ?? '3205170801010006' }}</td>
            </tr>
            <tr>
                <td class="label">Kewarganegaraan</td>
                <td class="colon">:</td>
                <td>{{ $pengajuan->data['kewarganegaraan'] ?? 'INDONESIA' }}</td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td class="colon">:</td>
                <td>
                    {{ $pengajuan->data['alamat'] ?? 'KP. CIBODAS, RT. 01/RW. 01. BANJARSARI KEC. BAYONGBONG KAB. GARUT' }}
                </td>
            </tr>
        </table>

        <p>
            Yang tersebut di atas berdasarkan keterangan dari ketua rt/rw setempat dan menurut data yang ada pada kami, adalah benar-benar warga kami, yang tergolong dalam keluarga tidak mampu (Pra-Ks).
        </p>

        <p>
            Demikian surat keterangan ini kami buat, agar yang berkepentingan mengetahui dan untuk dipergunakan sebagaimana mestinya.
        </p>
    </div>

    <div class="signature-container">
        <div class="signature-box"></div>
        <div class="signature-right">
            <div>Banjarsari, {{ date('d F Y') }}</div> 
            
            <div style="margin-bottom: 5px;">Kepala desa Banjarsari</div>
            
            <div class="signature-name">
                {{ $penandatangan ?? 'U.SUPRIATNA' }}
            </div>
        </div>
    </div>

</div>

</body>
</html>