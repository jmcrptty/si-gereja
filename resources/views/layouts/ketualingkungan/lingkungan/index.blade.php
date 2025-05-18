@extends('layouts.app')
@section('title', 'Lingkungan')

@section('content')
    <main>
        <div class="px-4 container-fluid">
            <h1 class="mt-4">Lingkungan</h1>
            <ol class="mb-4 breadcrumb">
                <li class="breadcrumb-item active">Tambah, Edit, dan Hapus Data Lingkungan</li>
            </ol>

            <div class="mb-4 card">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
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
                                        <div class="d-flex justify-content-around">
                                            <a href="" class="badge bg-primary fs-6"><i class="fa-solid fa-eye"></i></a>
                                            <a href="" class="badge bg-warning fs-6"><i class="fa-solid fa-pencil"></i></a>
                                            <a href="" class="badge bg-danger fs-6"><i class="fa-solid fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
