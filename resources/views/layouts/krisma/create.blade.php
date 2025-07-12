@extends('layouts.layoutUmum')

@section('judul-halaman')
    Pendaftaran Sakramen Komuni
@endsection

@section('gambar-hero')
    <div class="d-block w-100 hero-slide" style="background-image: url('/img/krisma1.png');"></div>
@endsection

@section('judul-hero')
    <h1 class="mb-4 display-4">Formulir Pendaftaran Sakramen Krisma <br>Katedral Merauke</h1>
@endsection

@section('content')
    <main>
        <div class="px-4 container-fluid">
            <h1 class="mt-4">Formulir Pendaftaran Sakramen Krisma</h1>
            <ol class="mb-4 breadcrumb">
                {{-- <li class="breadcrumb-item active">Tambah, Edit, dan Hapus Data Umat</li> --}}
            </ol>

            <div class="mb-4 card">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Formulir Sakramen Krisma
                </div>
                <div class="card-body">
                    <form action="{{ route('krisma.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- tidak untuk diubah-ubah --}}
                        <input type="hidden" name="token" value="{{ request()->segment(3) }}">
                        <input type="hidden" name="email" value="{{ $umat->email }}">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input disabled readonly type="text" class="form-control" id="nama_lengkap" value="{{ $umat->nama_lengkap }}">
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
                                    <input type="file" class="form-control @error('fotokopi_ktp_ortu') is-invalid @enderror" id="fotokopi_ktp_ortu" name="fotokopi_ktp_ortu" required>
                                    @error('fotokopi_ktp_ortu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
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
                                    <input type="file" class="form-control @error('surat_pernikahan_katolik_ortu') is-invalid @enderror" id="surat_pernikahan_katolik_ortu" name="surat_pernikahan_katolik_ortu" required>
                                    @error('surat_pernikahan_katolik_ortu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <h1 class="pt-1 mt-4"> Data Sakramen Baptis</h1>

                            <div class="col-sm-6">
                                <label for="nama_baptis" class="form-label">Nama Baptis</label>
                                @if ($data_baptis?->nama_baptis)
                                    <input disabled readonly type="text" class="form-control" id="nama_baptis" name="nama_baptis" value="{{ $data_baptis->nama_baptis }}">
                                @else
                                    <input type="text" class="form-control @error ('nama_baptis')is-invalid @enderror" id="nama_baptis" name="nama_baptis" value="{{ old('nama_baptis') }}" required>
                                    @error('nama_baptis')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="gereja_tempat_baptis" class="form-label">Gereja Tempat Pembaptisan</label>
                                @if ($data_baptis?->gereja_tempat_baptis)
                                    <input disabled readonly type="text" class="form-control" id="gereja_tempat_baptis" name="gereja_tempat_baptis" value="{{ $data_baptis->gereja_tempat_baptis }}">
                                @else
                                    <input type="text" class="form-control @error ('gereja_tempat_baptis')is-invalid @enderror" id="gereja_tempat_baptis" name="gereja_tempat_baptis" value="{{ old('gereja_tempat_baptis') }}" required>
                                    @error('gereja_tempat_baptis')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="tanggal_baptis" class="form-label">Tanggal Pembaptisan</label>
                                @if ($data_baptis?->tanggal_terima)
                                    <input disabled readonly type="date" class="form-control" id="tanggal_baptis" name="tanggal_baptis" value="{{ \Carbon\Carbon::parse($data_baptis->tanggal_terima)->format('Y-m-d') }}">
                                @else
                                    <input type="date" class="form-control @error ('tanggal_baptis')is-invalid @enderror" id="tanggal_baptis" name="tanggal_baptis" value="{{ old('tanggal_baptis') }}" required>
                                    @error('tanggal_baptis')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label for="surat_baptis" class="form-label">Surat Baptis</label>
                                @if ($data_baptis?->surat_baptis)
                                    <div class="mb-2">
                                        <span class="p-2 px-3 py-2 badge bg-success fs-6">
                                            ✔ Sudah Diupload
                                        </span>
                                    </div>
                                @else
                                    <input type="file" class="form-control @error ('surat_baptis')is-invalid @enderror" id="surat_baptis" name="surat_baptis" value="{{ old('surat_baptis') }}" required>
                                    @error('surat_baptis')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <h1 class="pt-1 mt-4"> Data Sakramen Komuni</h1>

                             <div class="col-sm-6">
                                <label for="tanggal_komuni" class="form-label">Tanggal Komuni Pertama</label>
                                @if ($data_komuni?->tanggal_terima)
                                    <input disabled readonly type="date" class="form-control" id="tanggal_komuni" name="tanggal_komuni" value="{{ \Carbon\Carbon::parse($data_komuni->tanggal_terima)->format('Y-m-d') }}">
                                @else
                                    <input type="date" class="form-control @error ('tanggal_komuni')is-invalid @enderror" id="tanggal_komuni" name="tanggal_komuni" value="{{ old('tanggal_komuni') }}" required>
                                    @error('tanggal_komuni')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="gereja_tempat_komuni" class="form-label">Gereja Tempat Komuni Pertama</label>
                                @if ($data_komuni?->gereja_tempat_komuni)
                                    <input readonly disabled type="text" class="form-control" id="gereja_tempat_komuni" name="gereja_tempat_komuni" value="{{ $data_komuni->gereja_tempat_komuni }}">
                                @else
                                    <input type="text" class="form-control @error ('gereja_tempat_komuni')is-invalid @enderror" id="gereja_tempat_komuni" name="gereja_tempat_komuni" value="{{ old('gereja_tempat_komuni') }}" required>
                                    @error('gereja_tempat_komuni')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="surat_komuni" class="form-label">Surat Komuni Pertama</label>
                                <input type="file" class="form-control @error ('surat_komuni')is-invalid @enderror" id="surat_komuni" name="surat_komuni" value="{{ old('surat_komuni') }}" required>
                                @error('surat_komuni')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-5 button-group text-end">
                            <a href="{{ route('krisma') }}" class="btn btn-dark">Kembali</a>

                            <button class="btn btn-dark" type="submit">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
