@extends('layouts.app')
@section('title', 'Data Pembaptisan')

@section('content')
    <main>
        <div class="px-4 container-fluid">
            <h1 class="mt-4">Formulir Pendaftaran Sakramen Pernikahan {{ $pernikahan->nama_lengkap_pria }} & {{ $pernikahan->nama_lengkap_wanita }}</h1>

            <div class="mb-4 card">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Formulir
                </div>
                <div class="card-body">
                    <form action="" method="">
                        <div class="row g-3">

                            {{-- CALON PRIA --}}
                            <h1 class="pt-1 mt-4">Data Calon Pria</h1>
                            <div class="col-sm-6">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap Pria</label>
                                <input disabled readonly type="text" class="form-control" id="nama_lengkap" value="{{ $pernikahan->nama_lengkap_pria }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input disabled readonly type="text" class="form-control" id="tempat_lahir" value="{{ $pernikahan->tempat_lahir_pria }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="ttl" class="form-label">Tanggal Lahir</label>
                                <input disabled readonly type="date" class="form-control" id="ttl" value="{{ $pernikahan->ttl_pria }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input disabled readonly type="text" class="form-control" id="alamat" value="{{ $pernikahan->alamat_pria }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="lingkungan" class="form-label">Agama</label>
                                <input disabled readonly type="text" class="form-control" id="lingkungan" value="{{ $pernikahan->agama_pria }}">
                            </div>

                            @if ($pernikahan->agama_pria == 'Katolik')
                                <div class="col-sm-6">
                                    <label for="lingkungan" class="form-label">Lingkungan</label>
                                    <input disabled readonly type="text" class="form-control" id="lingkungan" value="{{ $pernikahan->lingkungan_pria }}">
                                </div>
                            @endif

                            <div class="col-sm-6">
                                <label for="email" class="form-label">Email</label>
                                <input disabled readonly type="text" class="form-control" id="email" value="{{ $pernikahan->email_pria }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="akte_file" class="form-label">Akta Kelahiran</label>
                                <div>
                                    @if ($pernikahan->akte_file_pria)
                                        <a href="{{ route('sekretaris.pernikahan.downloadFile', ['type' => 'akte', 'filename' => basename($pernikahan->akte_file_pria)]) }}"
                                            class="btn btn-outline-primary d-block" target="_blank">
                                            Lihat Akta Kelahiran
                                        </a>
                                    @else
                                        <span class="btn btn-outline-secondary disabled d-block">Belum ada</span>
                                    @endif
                                </div>
                            </div>

                            {{-- CALON WANITA --}}

                            <h1 class="pt-1 mt-4">Data Calon Wanita</h1>
                            <div class="col-sm-6">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap Wanita</label>
                                <input disabled readonly type="text" class="form-control" id="nama_lengkap" value="{{ $pernikahan->nama_lengkap_wanita }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input disabled readonly type="text" class="form-control" id="tempat_lahir" value="{{ $pernikahan->tempat_lahir_wanita }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="ttl" class="form-label">Tanggal Lahir</label>
                                <input disabled readonly type="date" class="form-control" id="ttl" value="{{ $pernikahan->ttl_wanita }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input disabled readonly type="text" class="form-control" id="alamat" value="{{ $pernikahan->alamat_wanita }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="lingkungan" class="form-label">Agama</label>
                                <input disabled readonly type="text" class="form-control" id="lingkungan" value="{{ $pernikahan->agama_wanita }}">
                            </div>

                            @if ($pernikahan->agama_wanita == 'Katolik')
                                <div class="col-sm-6">
                                    <label for="lingkungan" class="form-label">Lingkungan</label>
                                    <input disabled readonly type="text" class="form-control" id="lingkungan" value="{{ $pernikahan->lingkungan_wanita }}">
                                </div>
                            @endif

                            <div class="col-sm-6">
                                <label for="email" class="form-label">Email</label>
                                <input disabled readonly type="text" class="form-control" id="email" value="{{ $pernikahan->email_wanita }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="akte_file" class="form-label">Akta Kelahiran</label>
                                <div>
                                    @if ($pernikahan->akte_file_wanita)
                                        <a href="{{ route('sekretaris.pernikahan.downloadFile', ['type' => 'akte', 'filename' => basename($pernikahan->akte_file_wanita)]) }}"
                                            class="btn btn-outline-primary d-block" target="_blank">
                                            Lihat Akta Kelahiran
                                        </a>
                                    @else
                                        <span class="btn btn-outline-secondary disabled d-block">Belum ada</span>
                                    @endif
                                </div>
                            </div>

                            <h1 class="pt-1 mt-4">Detail Penerimaan Sakramen Pernikahan</h1>

                            <div class="col-sm-6">
                                <label for="gereja_tempat_komuni" class="form-label">Gereja Tempat Penerimaan Sakramen Perniakahan</label>
                                <input disabled readonly type="text" class="form-control" id="gereja_tempat_komuni"
                                    value="Gereja Katedral Santo Fransiskus Xaverius Merauke">
                            </div>

                            <div class="col-sm-6">
                                <label for="tanggal_komuni" class="form-label">Tanggal Pernikahan</label>
                                @if(optional($pernikahan->tanggal_terima))
                                    <input disabled readonly type="date" class="form-control" id="tanggal_komuni"
                                        value="{{ optional($pernikahan->tanggal_terima)->format('Y-m-d') }}">
                                @else
                                    <input disabled readonly type="text" class="form-control" id="tanggal_komuni" value="Belum Ada">
                                @endif
                            </div>

                        <div class="mt-5 button-group text-end">
                            <a href="{{ url()->previous() }}" class="border-0 rounded btn-warning btn btn-lg">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
