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
                    <form action="{{ route('ketualingkungan.umat.update', $umat->id) }}" method="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error ('nama_lengkap')is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" placeholder="" value="{{ old('nama_lengkap', $umat->nama_lengkap) }}" required>
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" class="form-control @error ('nik')is-invalid @enderror" id="nik" name="nik" minlength="16" maxlength="16" value="{{ old('nik', $umat->nik) }}" required>
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="ttl" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control @error ('ttl')is-invalid @enderror" id="ttl" name="ttl" value="{{ old('ttl', $umat->ttl) }}" required>
                                @error('ttl')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control @error ('alamat')is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat', $umat->alamat) }}" required>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="no_hp" class="form-label">Nomor Telpon</label>
                                <input type="text" class="form-control @error ('no_hp')is-invalid @enderror" id="no_hp" name="no_hp" minlength="10" maxlength="12" value="{{ old('no_hp', $umat->no_hp) }}" required>
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control @error ('email')is-invalid @enderror" id="email" name="email" value="{{ old('email', $umat->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="lingkungan" class="form-label">Lingkungan</label>
                                <select type="text" class="form-control @error ('lingkungan')is-invalid @enderror" id="lingkungan" name="lingkungan" placeholder="" value="" required>
                                    <option selected disabled value="">Pilih Lingkungan</option>
                                    <option {{ $umat->lingkungan == 'st.petrus' ? 'selected' : '' }} value="st.petrus">St. Petrus</option>
                                    <option {{ $umat->lingkungan == 'st.yohanes' ? 'selected' : '' }} value="st.yohanes">St. Yohanes</option>
                                    <option {{ $umat->lingkungan == 'st.maria' ? 'selected' : '' }} value="st.maria">St. Maria</option>
                                </select>
                                @error('lingkungan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <h1 class="pt-1 mt-4">Berkas</h1>

                            <div class="mb-3 col-sm-6">
                                <label for="kk_file" class="form-label fw-semibold">Kartu Keluarga</label>

                                {{-- Tampilkan file sebelumnya jika ada --}}
                                @if ($umat->kk_file)
                                    <div class="mb-2">
                                        <a href="{{ route('ketualingkungan.umat.downloadFile', ['type' => 'kk', 'filename' => basename($umat->kk_file)]) }}"
                                        class="btn btn-outline-primary btn-sm"
                                        target="_blank"
                                        rel="noopener noreferrer">
                                            Lihat Kartu Keluarga Sebelumnya
                                        </a>
                                    </div>
                                @else
                                    <div class="mb-2">
                                        <a href="#"
                                        class="btn btn-outline-primary btn-sm"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        style="color: currentColor; cursor: not-allowed; opacity: 0.5; text-decoration: none; pointer-events: none;">
                                            Kartu Keluarga Belum Pernah Dimasukkan
                                        </a>
                                    </div>
                                @endif

                                <input type="file" class="form-control @error ('kk_file')is-invalid @enderror" id="kk_file" name="kk_file">

                                @error('kk_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>


                            <div class="col-sm-6">
                                <label for="akte_file" class="form-label">Akta Kelahiran</label>

                                {{-- Tampilkan file sebelumnya jika ada --}}
                                @if ($umat->akte_file)
                                    <div class="mb-2">
                                        <a href="{{ route('ketualingkungan.umat.downloadFile', ['type' => 'akte', 'filename' => basename($umat->akte_file)]) }}"
                                        class="btn btn-outline-primary btn-sm"
                                        target="_blank"
                                        rel="noopener noreferrer">
                                            Lihat Akta Kelahiran Sebelumnya
                                        </a>
                                    </div>
                                @else
                                    <div class="mb-2">
                                        <a href="#"
                                        class="btn btn-outline-primary btn-sm"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        style="color: currentColor; cursor: not-allowed; opacity: 0.5; text-decoration: none; pointer-events: none;">
                                            Akta kelahiran Belum Pernah Dimasukkan
                                        </a>
                                    </div>
                                @endif

                                <input type="file" class="form-control @error('akte_file') is-invalid @enderror" id="akte_file" name="akte_file">

                                @error('akte_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-5 button-group text-end">
                            <a href="{{ route('ketualingkungan.umat.index') }}" class="border-0 rounded btn btn-warning btn-lg">Kembali</a>

                            <button class="border-0 rounded btn bg-primary btn-lg" type="submit">Perbarui Data Umat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
