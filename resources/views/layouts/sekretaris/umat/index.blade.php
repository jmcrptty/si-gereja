@extends('layouts.app')

@section('title', 'Data Umat')

@section('content')
<div class="px-4 container-fluid">
    <h1 class="mt-4 mb-3">Data Umat</h1>

    <div class="mb-4 card">
        <div class="card-header fw-bold">
            <i class="fas fa-table me-1"></i>
            Data Umat
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Lingkungan</th>
                        <th>Nomor Telpon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Lingkungan</th>
                        <th>Nomor Telpon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($umats as $umat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $umat->nama_lengkap }}</td>
                            <td>{{ $umat->lingkungan }}</td>
                            <td>{{ $umat->no_hp }}</td>
                            <td>{{ $umat->alamat }}</td>
                            <td>
                                <div class="flex-wrap gap-2 d-flex justify-content-center">
                                    {{-- Show --}}
                                    <a href="{{ route('sekretaris.umat.show', $umat->id) }}" class="btn btn-sm bg-primary" title="Lihat">
                                        <i class="fa-solid fa-eye"></i> Lihat
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
