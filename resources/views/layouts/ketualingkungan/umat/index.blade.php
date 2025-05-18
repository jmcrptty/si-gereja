@extends('layouts.app')

@section('content')
    <main>
        <div class="px-4 container-fluid">
            <h1 class="mt-4">Umat</h1>
            <ol class="mb-4 breadcrumb">
                <li class="breadcrumb-item active">Tambah, Edit, dan Hapus Data Umat</li>
            </ol>

            <a class="mb-4 btn btn-success fs-5" href="{{ route('umat.create') }}"><i class="fa-solid fa-plus"></i> Tambah Umat</a>

            <div class="mb-4 card">
                <div class="card-header">
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
                                    <td style="d-flex justify-content-evenly">
                                        <div class="d-flex justify-content-evenly">
                                            <a href="#" class="badge bg-info fs-6"><i class="fa-solid fa-eye" style="color: #000000;"></i></a>
                                            <a href="#" class="badge bg-warning fs-6"><i class="fa-solid fa-pen" style="color: #000000;"></i></a>
                                            <a href="#" class="badge bg-danger fs-6"><i class="fa-solid fa-trash" style="color: #000000;"></i></a>
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
