<!DOCTYPE html>
<html>
<head>
    <title>Laporan Sakramen {{ $year }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <h2>Laporan Sakramen Tahun {{ $year }}</h2>
    <p>Jenis Sakramen: {{ $sakramen }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Lingkungan</th>
                <th>Sakramen</th>
                <th>Tanggal Terima</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_lengkap }}</td>
                    <td>{{ $item->lingkungan }}</td>
                    <td>{{ $item->nama_sakramen }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_terima)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
