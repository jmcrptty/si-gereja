<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Umat {{ $tahun }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2, h4 { text-align: center; margin: 0; }
    </style>
</head>
<body>
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
