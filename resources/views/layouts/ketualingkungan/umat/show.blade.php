@extends('layouts.app')
@section('title', 'Lingkungan')

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
                    <form action="" method="">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input disabled readonly type="text" class="form-control" id="nama_lengkap" value="{{ $umat->nama_lengkap }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="nik" class="form-label">NIK</label>
                                <input disabled readonly type="text" class="form-control" id="nik" value="{{ $umat->nik }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <input disabled readonly type="text" class="form-control" id="jenis_kelamin" value="{{ $umat->jenis_kelamin }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input disabled readonly type="text" class="form-control" id="tempat_lahir" value="{{ $umat->tempat_lahir }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="ttl" class="form-label">Tanggal Lahir</label>
                                <input disabled readonly type="date" class="form-control" id="ttl" value="{{ $umat->ttl }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input disabled readonly type="text" class="form-control" id="alamat" value="{{ $umat->alamat }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                <input disabled readonly type="text" class="form-control" id="nama_ayah" value="{{ $umat->nama_ayah }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                <input disabled readonly type="text" class="form-control" id="nama_ibu" value="{{ $umat->nama_ibu }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="no_hp" class="form-label">Nomor Telpon</label>
                                <input disabled readonly type="text" class="form-control" id="no_hp" value="{{ $umat->no_hp }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="email" class="form-label">Email</label>
                                <input disabled readonly type="text" class="form-control" id="email" value="{{ $umat->email }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="lingkungan" class="form-label">Lingkungan</label>
                                <input disabled readonly type="text" class="form-control" id="lingkungan" value="{{ $umat->lingkungan }}">
                            </div>

                            <h1 class="pt-1 mt-4">Berkas</h1>

                            <div class="col-sm-6">
                                <label for="kk_file" class="form-label">Kartu Keluarga</label>
                                @if ($umat->kk_file)
                                    <a href="{{ route('ketualingkungan.umat.downloadFile', ['type' => 'kk', 'filename' => basename($umat->kk_file)]) }}"
                                        class="btn btn-outline-primary" target="_blank">
                                        Lihat Kartu Keluarga
                                    </a>
                                @else
                                    <span class="btn btn-outline-secondary disabled">Belum ada</span>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="akte_file" class="form-label">Akta Kelahiran</label>
                                @if ($umat->akte_file)
                                    <a href="{{ route('ketualingkungan.umat.downloadFile', ['type' => 'akte', 'filename' => basename($umat->akte_file)]) }}"
                                        class="btn btn-outline-primary" target="_blank">
                                        Lihat Akta Kelahiran
                                    </a>
                                @else
                                    <span class="btn btn-outline-secondary disabled">Belum ada</span>
                                @endif
                            </div>
                        </div>

                        <div class="mt-5 button-group text-end">
                            <a href="{{ url()->previous() }}" class="border-0 rounded btn btn-warning btn-lg">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
