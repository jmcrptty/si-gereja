<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Umat {{ $tahun }}</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12px;
        }

        /* Kop Surat tanpa border */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .kop-table td {
            vertical-align: middle;
            text-align: center;
            border: none;
        }

        .logo-kiri,
        .logo-kanan {
            width: 80px;
        }

        .kop-title {
            font-size: 18px;
            font-weight: bold;
        }

        .kop-subtitle {
            font-size: 16px;
            font-weight: bold;
        }

        .kop-alamat {
            font-size: 12px;
            margin-top: 5px;
        }

        /* Garis pembatas bawah */
        .kop-line {
            border-bottom: 2px solid #000;
            margin-top: 5px;
            margin-bottom: 20px;
        }

        /* Isi Laporan */
        h2, h4 {
            text-align: center;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<!-- Kop Surat Tanpa Garis -->
<table class="kop-table">
    <tr>
        <td class="logo-kiri">
            <img src="img/logo2.png" alt="Logo Kiri" width="60">
        </td>
        <td>
            <div class="kop-title">KEUSKUPAN AGUNG MERAUKE</div>
            <div class="kop-subtitle">PAROKI SANTO FRANSISKUS XAVERIUS KATEDRAL</div>
            <div class="kop-alamat">
                Jalan Raya Mandala No.32, Maro, Merauke, Papua Selatan <br>
                Email: pfransiskusxaveriusmerauke@gmail.com
            </div>
        </td>
        <td class="logo-kanan">
            <img src="img/LOGO.png" alt="Logo Kanan" width="60" style="border-radius: 50%;">
        </td>
    </tr>
</table>

<!-- Garis Pembatas Bawah -->
<div class="kop-line"></div>

<!-- Isi Laporan -->
<h2>Laporan Data Umat</h2>
<h4>Tahun {{ $tahun }}</h4>
<p>Total Umat: <strong>{{ $umat->count() }}</strong> Orang</p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Lingkungan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($umat as $i => $u)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $u->nama_lengkap }}</td>
            <td>{{ $u->lingkungan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
