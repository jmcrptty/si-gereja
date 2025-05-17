@extends('layouts.app')

@section('content')
    <main>
        <div class="px-4 container-fluid">
            <h1 class="mt-4">Umat</h1>
            <ol class="mb-4 breadcrumb">
                <li class="breadcrumb-item active">Tambah, Edit, dan Hapus Data Umat</li>
            </ol>

            <div class="mb-4 card">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Umat
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Lingkungan</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Lingkungan</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($umats as $umat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $umat->nama_lengkap }}</td>
                                    <td>{{ $umat->lingkungan->nama_lingkungan }}</td>
                                    <td>{{ $umat->alamat }}</td>
                                    <td>aksi</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
