@extends('layouts.layoutUmum')

@section('judul-halaman')
    Pendaftaran Sakramen Komuni
@endsection

@section('gambar-hero')
    <div class="d-block w-100 hero-slide" style="background-image: url('/img/komuni.png');"></div>
@endsection

@section('judul-hero')
    <h1 class="mb-4 display-4">Formulir Pendaftaran Komuni <br>Katedral Merauke</h1>
@endsection

@section('content')
    <main>
        <div class="px-4 container-fluid">
            <h1 class="mt-4">Formulir Pendaftaran Komuni</h1>
            <ol class="mb-4 breadcrumb">
                {{-- <li class="breadcrumb-item active">Tambah, Edit, dan Hapus Data Umat</li> --}}
            </ol>

            <div class="mb-4 card">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Formulir Komuni
                </div>
                <div class="card-body">
                    <form action="{{ route('komuni-pertama.store') }}" method="POST" enctype="multipart/form-data">
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
                                @if ($data_baptis?->nama_baptis)
                                    <input readonly type="text" class="form-control" id="nama_baptis" name="nama_baptis" value="{{ $data_baptis->nama_baptis }}">
                                @else
                                    <input type="text" class="form-control @error ('nama_baptis')is-invalid @enderror" id="nama_baptis" name="nama_baptis" value="{{ old('nama_baptis') }}">
                                    @error('nama_baptis')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <h1 class="pt-1 mt-4">Data Orang Tua</h1>

                            <div class="col-sm-6">
                                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                <input disabled readonly type="text" class="form-control" id="nama_ayah" value="{{ $umat->nama_ayah }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                <input disabled readonly type="text" class="form-control" id="nama_ibu" value="{{ $umat->nama_ibu }}">
                            </div>

                            <div class="mb-3 col-sm-6">
                                <label for="fotokopi_ktp_ortu" class="form-label">Fotokopi KTP Orang Tua</label>
                                @if ($data_baptis?->fotokopi_ktp_ortu)
                                    <div class="mb-2">
                                        <span class="p-2 px-3 py-2 badge bg-success fs-6">
                                            ✔ Sudah Diupload
                                        </span>
                                    </div>
                                @else
                                    <input type="file" class="form-control @error('fotokopi_ktp_ortu') is-invalid @enderror" id="fotokopi_ktp_ortu" name="fotokopi_ktp_ortu">
                                @endif

                                @error('fotokopi_ktp_ortu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-sm-6">
                                <label for="surat_pernikahan_katolik_ortu" class="form-label">Surat Pernikahan Orang Tua</label>
                                @if ($data_baptis?->surat_pernikahan_katolik_ortu)
                                    <div class="mb-2">
                                        <span class="p-2 px-3 py-2 badge bg-success fs-6">
                                            ✔ Sudah Diupload
                                        </span>
                                    </div>
                                @else
                                    <input type="file" class="form-control @error('surat_pernikahan_katolik_ortu') is-invalid @enderror" id="surat_pernikahan_katolik_ortu" name="surat_pernikahan_katolik_ortu">
                                @endif

                                @error('surat_pernikahan_katolik_ortu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <h1 class="pt-1 mt-4"> Data Sakramen Baptis</h1>

                            <div class="col-sm-6">
                                <label for="tanggal_pembaptisan" class="form-label">Tanggal Pembaptisan</label>
                                <input type="date" class="form-control @error ('tanggal_pembaptisan')is-invalid @enderror" id="tanggal_pembaptisan" name="tanggal_pembaptisan" value="{{ old('tanggal_pembaptisan') }}">
                                @error('tanggal_pembaptisan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="surat_baptis" class="form-label">Surat Baptis</label>
                                <input type="file" class="form-control @error ('surat_baptis')is-invalid @enderror" id="surat_baptis" name="surat_baptis" value="{{ old('surat_baptis') }}" >
                                @error('surat_baptis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-5 button-group text-end">
                            <a href="{{ route('komuni-pertama') }}" class="border-0 rounded btn btn-warning btn-lg">Kembali</a>

                            <button class="border-0 rounded btn bg-primary btn-lg" type="submit">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
