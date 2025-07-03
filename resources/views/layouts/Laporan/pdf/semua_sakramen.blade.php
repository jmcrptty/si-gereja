<!DOCTYPE html>
<html>
<head>
    <title>Laporan Sakramen {{ $year }}</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12px;
        }

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

        .logo-kiri, .logo-kanan {
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

        .kop-line {
            border-bottom: 2px solid #000;
            margin-top: 5px;
            margin-bottom: 20px;
        }

        h1, h2, h3 {
            text-align: center;
            margin: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .rekap-table td {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Kop Surat -->
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

    <div class="kop-line"></div>

    <!-- Judul -->
    <h2>Laporan Penerimaan Semua Sakramen Tahun {{ $year }}</h2>

    <!-- Rekap Jumlah Per Sakramen -->
    <table class="rekap-table">
        <tbody>
            @php
                $grouped = $data->groupBy('nama_sakramen');
            @endphp
            @foreach($grouped as $sakramen => $list)
                <tr>
                    <td>Sakramen {{ $sakramen }}</td>
                    <td>: {{ $list->count() }} Umat</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tabel Detail Per Sakramen -->
    @foreach($grouped as $sakramen => $list)
        <h3>Data Penerima Sakramen {{ $sakramen }}</h3>
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Lengkap</th>
                    <th>Lingkungan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_lengkap }}</td>
                        <td>{{ $item->lingkungan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

</body>
</html>
