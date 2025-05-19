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
                        @csrf
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input disabled readlonly type="text" class="form-control @error ('nama_lengkap')is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" placeholder="" value="{{ $umat->nama_lengkap }}" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="nik" class="form-label">NIK</label>
                                <input disabled readlonly type="text" class="form-control @error ('nik')is-invalid @enderror" id="nik" name="nik" minlength="16" maxlength="16" value="{{ $umat->nik }}" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="ttl" class="form-label">Tanggal Lahir</label>
                                <input disabled readlonly type="date" class="form-control @error ('ttl')is-invalid @enderror" id="ttl" name="ttl" value="{{ $umat->ttl }}" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input disabled readlonly type="text" class="form-control @error ('alamat')is-invalid @enderror" id="alamat" name="alamat" value="{{ $umat->alamat }}" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="no_hp" class="form-label">Nomor Telpon</label>
                                <input disabled readlonly type="text" class="form-control @error ('no_hp')is-invalid @enderror" id="no_hp" name="no_hp" minlength="10" maxlength="12" value="{{ $umat->no_hp }}" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="email" class="form-label">Email</label>
                                <input disabled readlonly type="text" class="form-control @error ('email')is-invalid @enderror" id="email" name="email" value="{{ $umat->email }}" required>
                            </div>

                            <div class="col-sm-6">
                                <label for="lingkungan" class="form-label">Lingkungan</label>
                                <select disabled readlonly type="text" class="form-control @error ('lingkungan')is-invalid @enderror" id="lingkungan" name="lingkungan" placeholder="" value="" required>
                                    <option {{ $umat->lingkungan == 'st.petrus' ? 'selected' : '' }} value="st.petrus">St. Petrus</option>
                                    <option {{ $umat->lingkungan == 'st.yohanes' ? 'selected' : '' }} value="st.yohanes">St. Yohanes</option>
                                    <option {{ $umat->lingkungan == 'st.maria' ? 'selected' : '' }} value="st.maria">St. Maria</option>
                                </select>

                            </div>

                            <h1 class="pt-1 mt-4">Berkas</h1>

                            <div class="col-sm-6">
                                <label for="kk_file" class="form-label">Kartu Keluarga</label>
                                <input disabled readlonly type="file" class="form-control @error ('kk_file')is-invalid @enderror" id="kk_file" name="kk_file" value="{{ old('kk_file') }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="akte_file" class="form-label">Akte Kelahiran</label>
                                <input disabled readlonly type="file" class="form-control @error ('akte_file')is-invalid @enderror" id="akte_file" name="akte_file" value="{{ old('akte_file') }}" >
                            </div>
                        </div>

                        <div class="mt-5 button-group text-end">
                            <a href="{{ route('umat.index') }}" class="border-0 rounded btn btn-warning btn-lg">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
