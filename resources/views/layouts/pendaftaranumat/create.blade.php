@extends('layouts.pendaftaranumat.layoutUmum')
@section('title', 'Pendfataran Umat')

@section('judul-hero')
    <H5>PENDAFTARAN UMAT PAROKI KATEDRAL</H5>
    <h1 class="mb-4 display-4">SILAHKAN LENGKAPI FORMULIR DI BAWAH</h1>
@endsection

@section('content')
    <main>
        <div class="px-4 container-fluid">
            <h1 class="mt-4">Formulir Pendaftaran Umat</h1>
            <ol class="mb-4 breadcrumb">
                {{-- <li class="breadcrumb-item active">Tambah, Edit, dan Hapus Data Umat</li> --}}
            </ol>

            <div class="mb-4 card">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Umat
                </div>
                <div class="card-body">
                    <form action="{{ route('pendaftaran-umat.store') }}" method="POST" enctype="multipart/form-data">
                        {{-- tidak untuk diubah-ubah --}}
                        @csrf
                        <input type="hidden" name="token" value="{{ request()->segment(3) }}">
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
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select type="text" class="form-control @error ('jenis_kelamin')is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" placeholder="" value="" required>
                                    <option selected disabled value="">Pilih Jenis Kelamin</option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control @error ('tempat_lahir')is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                                @error('tempat_lahir')
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
                                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                <input type="text" class="form-control @error ('nama_ayah')is-invalid @enderror" id="nama_ayah" name="nama_ayah" placeholder="" value="{{ old('nama_ayah') }}" required>
                                @error('nama_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                <input type="text" class="form-control @error ('nama_ibu')is-invalid @enderror" id="nama_ibu" name="nama_ibu" placeholder="" value="{{ old('nama_ibu') }}" required>
                                @error('nama_ibu')
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
                                <input type="text" class="form-control @error ('email')is-invalid @enderror" id="email" name="email" value="{{ $email }}" readonly required style="background-color: #f8f9fa; color: #6c757d;">
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
                            <a href="{{ route('pendaftaran-umat') }}" class="border-0 rounded btn btn-warning btn-lg">Kembali</a>

                            <button class="border-0 rounded btn bg-primary btn-lg" type="submit">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
