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
                    <form action="{{ route('umat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error ('nama_lengkap')is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" placeholder="" value="{{ old('nama_lengkap') }}" required>
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" class="form-control @error ('nik')is-invalid @enderror" id="nik" name="nik" minlength="16" maxlength="16" value="{{ old('nik') }}" required>
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="ttl" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control @error ('ttl')is-invalid @enderror" id="ttl" name="ttl" value="{{ old('ttl') }}" required>
                                @error('ttl')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control @error ('alamat')is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') }}" required>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="no_hp" class="form-label">Nomor Telpon</label>
                                <input type="text" class="form-control @error ('no_hp')is-invalid @enderror" id="no_hp" name="no_hp" minlength="10" maxlength="12" value="{{ old('no_hp') }}" required>
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control @error ('email')is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="lingkungan" class="form-label">Lingkungan</label>
                                <select type="text" class="form-control @error ('lingkungan')is-invalid @enderror" id="lingkungan" name="lingkungan" placeholder="" value="" required>
                                    <option selected disabled value="">Pilih Lingkungan</option>
                                    <option value="st.petrus">St. Petrus</option>
                                    <option value="st.yohanes">St. Yohanes</option>
                                    <option value="st.maria">St. Maria</option>
                                </select>
                                @error('lingkungan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <h1 class="pt-1 mt-4">Berkas</h1>

                            <div class="col-sm-6">
                                <label for="kk_file" class="form-label">Kartu Keluarga</label>
                                <input type="file" class="form-control @error ('kk_file')is-invalid @enderror" id="kk_file" name="kk_file" value="{{ old('kk_file') }}">
                                @error('kk_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="akte_file" class="form-label">Akte Kelahiran</label>
                                <input type="file" class="form-control @error ('akte_file')is-invalid @enderror" id="akte_file" name="akte_file" value="{{ old('akte_file') }}" >
                                @error('akte_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-5 button-group text-end">
                            <a href="{{ route('umat.index') }}" class="border-0 rounded btn btn-warning btn-lg">Kembali</a>

                            <button class="border-0 rounded btn bg-primary btn-lg" type="submit">Tambah Umat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
