@extends('layouts.layoutUmum')

@section('judul-halaman')
    Pendaftaran Sakramen Baptis
@endsection

@section('gambar-hero')
    <div class="d-block w-100 hero-slide" style="background-image: url('/img/baptis1.png');"></div>
@endsection

@section('judul-hero')
    <h1 class="mb-4 display-4">Formulir Pendaftaran Baptis <br>Katedral Merauke</h1>
@endsection

@section('content')
    <main>
        <div class="px-4 container-fluid">
            <h1 class="mt-4">Formulir Pendaftaran Baptis</h1>
            <ol class="mb-4 breadcrumb">
                {{-- <li class="breadcrumb-item active">Tambah, Edit, dan Hapus Data Umat</li> --}}
            </ol>

            <div class="mb-4 card">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Formulir Pembaptisan
                </div>
                <div class="card-body">
                    <form action="{{ route('baptis.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- tidak untuk diubah-ubah --}}
                        <input type="hidden" name="token" value="{{ request()->segment(3) }}">
                        <input type="hidden" name="email" value="{{ $umat->email }}">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input disabled readonly type="text" class="form-control" id="nama_lengkap" value="{{ $umat->nama_lengkap }}">
                            </div>
                            <div class="col-sm-6">
                                <label for="nama_baptis" class="form-label">Nama Baptis</label>
                                <input type="text" class="form-control @error ('nama_baptis')is-invalid @enderror" id="nama_baptis" name="nama_baptis" placeholder="" value="{{ old('nama_baptis') }}" required>
                                @error('nama_baptis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <h1 class="pt-1 mt-4">Data Orang Tua</h1>

                            <div class="col-sm-6">
                                <label for="fotokopi_ktp_ortu" class="form-label">Fotokopi KTP Orang Tua</label>
                                <input type="file" class="form-control @error ('fotokopi_ktp_ortu')is-invalid @enderror" id="fotokopi_ktp_ortu" name="fotokopi_ktp_ortu" value="{{ old('fotokopi_ktp_ortu') }}" >
                                @error('fotokopi_ktp_ortu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="surat_pernikahan_katolik_ortu" class="form-label">Surat Pernikahan Katolik Orang Tua</label>
                                <input type="file" class="form-control @error ('surat_pernikahan_katolik_ortu')is-invalid @enderror" id="surat_pernikahan_katolik_ortu" name="surat_pernikahan_katolik_ortu" value="{{ old('surat_pernikahan_katolik_ortu') }}" >
                                @error('surat_pernikahan_katolik_ortu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <h1 class="pt-1 mt-4"> Data Wali Baptis</h1>

                            <h5>Wali Baptis Tunggal <span>&#42;</span></h5>
                            <div class="col-sm-6">
                                <label for="nama_wali_baptis" class="form-label">Nama Wali Baptis</label>
                                <input type="text" class="form-control @error ('nama_wali_baptis')is-invalid @enderror" id="nama_wali_baptis" name="nama_wali_baptis" value="{{ old('nama_wali_baptis') }}">
                                @error('nama_wali_baptis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="surat_krisma_wali_baptis" class="form-label">Surat Krisma Wali Baptis</label>
                                <input type="file" class="form-control @error ('surat_krisma_wali_baptis')is-invalid @enderror" id="surat_krisma_wali_baptis" name="surat_krisma_wali_baptis" value="{{ old('surat_krisma_wali_baptis') }}" >
                                @error('surat_krisma_wali_baptis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <h5>Wali Baptis Pasangan <span>&#42;</span></h5>
                            <div class="col-sm-6">
                                <label for="nama_wali_baptis_pria" class="form-label">Nama Wali Baptis Pria</label>
                                <input type="text" class="form-control @error ('nama_wali_baptis_pria')is-invalid @enderror" id="nama_wali_baptis_pria" name="nama_wali_baptis_pria" value="{{ old('nama_wali_baptis_pria') }}">
                                @error('nama_wali_baptis_pria')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="nama_wali_baptis_wanita" class="form-label">Nama Wali Baptis Wanita</label>
                                <input type="text" class="form-control @error ('nama_wali_baptis_wanita')is-invalid @enderror" id="nama_wali_baptis_wanita" name="nama_wali_baptis_wanita" value="{{ old('nama_wali_baptis_wanita') }}">
                                @error('nama_wali_baptis_wanita')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="surat_pernikahan_wali_baptis" class="form-label">Surat Pernikahan Wali Baptis</label>
                                <input type="file" class="form-control @error ('surat_pernikahan_wali_baptis')is-invalid @enderror" id="surat_pernikahan_wali_baptis" name="surat_pernikahan_wali_baptis" value="{{ old('surat_pernikahan_wali_baptis') }}" >
                                @error('surat_pernikahan_wali_baptis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <br>
                        <br>
                        <h6><i><span>&#42;</span>Pilih Salah Satu</i></h6>

                        <div class="mt-5 button-group text-end">
                            <a href="{{ route('baptis') }}" class="border-0 rounded btn btn-warning btn-lg">Kembali</a>

                            <button class="border-0 rounded btn bg-primary btn-lg" type="submit">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
