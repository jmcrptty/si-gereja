@extends('layouts.app')

@section('title', 'Data Umat')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-3">Data Umat</h1>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Lingkungan</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>Status Umat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                $dummyData = [
                    ['nama' => 'Andi Setiawan', 'lingkungan' => 'Lingkungan A', 'alamat' => 'Jl. Merdeka No.1', 'tgl_lahir' => '1990-05-10', 'status' => 'Aktif'],
                    ['nama' => 'Budi Santoso', 'lingkungan' => 'Lingkungan B', 'alamat' => 'Jl. Sudirman No.22', 'tgl_lahir' => '1985-11-15', 'status' => 'Tidak Aktif'],
                    ['nama' => 'Citra Dewi', 'lingkungan' => 'Lingkungan C', 'alamat' => 'Jl. Diponegoro No.10', 'tgl_lahir' => '1995-07-20', 'status' => 'Aktif'],
                ];
                @endphp

                @foreach ($dummyData as $index => $umat)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $umat['nama'] }}</td>
                    <td>{{ $umat['lingkungan'] }}</td>
                    <td>{{ $umat['alamat'] }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($umat['tgl_lahir'])->format('d M Y') }}</td>
                    <td class="text-center">
                        @if ($umat['status'] === 'Aktif')
                        <span class="badge bg-success">Aktif</span>
                        @else
                        <span class="badge bg-secondary">Tidak Aktif</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="#" class="btn btn-sm btn-warning me-1">Edit</a>
                        <a href="#" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
