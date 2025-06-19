@extends('layouts.app')
@section('title', 'Data Pembaptisan')

@section('content')
    <main>
        <div class="px-4 container-fluid">
            <h1 class="mt-4">Formulir Pendaftaran Sakramen Komuni {{ $umat->nama_lengkap }}</h1>

            <div class="mb-4 card">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Formulir
                </div>
                <div class="card-body">
                    <form action="" method="">
                        <div class="row g-3">

                            <h1 class="pt-1 mt-4">Data Peserta</h1>
                            <div class="col-sm-6">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input disabled readonly type="text" class="form-control" id="nama_lengkap" value="{{ $umat->nama_lengkap }}">
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
                                <label for="lingkungan" class="form-label">Lingkungan</label>
                                <input disabled readonly type="text" class="form-control" id="lingkungan" value="{{ $umat->lingkungan }}">
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
                                <label for="akte_file" class="form-label">Akta Kelahiran</label>
                                <div>
                                    @if ($umat->akte_file)
                                        <a href="{{ route('sekretaris.umat.downloadFile', ['type' => 'akte', 'filename' => basename($umat->akte_file)]) }}"
                                            class="btn btn-outline-primary d-block" target="_blank">
                                            Lihat Akta Kelahiran
                                        </a>
                                    @else
                                        <span class="btn btn-outline-secondary disabled d-block">Belum ada</span>
                                    @endif
                                </div>
                            </div>

                            <h1 class="pt-1 mt-4">Data Keluarga</h1>

                            <div class="col-sm-6">
                                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                <input disabled readonly type="text" class="form-control" id="nama_ayah" value="{{ $umat->nama_ayah }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                <input disabled readonly type="text" class="form-control" id="nama_ibu" value="{{ $umat->nama_ibu }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="kk_file" class="form-label">Kartu Keluarga</label>
                                @if ($umat->kk_file)
                                    <a href="{{ route('sekretaris.umat.downloadFile', ['type' => 'kk', 'filename' => basename($umat->kk_file)]) }}"
                                        class="btn btn-outline-primary d-block" target="_blank">
                                        Lihat Kartu Keluarga
                                    </a>
                                @else
                                    <span class="btn btn-outline-secondary disabled d-block">Belum ada</span>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="surat_pernikahan_katolik_ortu" class="form-label">Surat Pernikahan Orang Tua</label>
                                @if ($umat->baptis->surat_pernikahan_katolik_ortu)
                                    <a href="{{ route('sekretaris.umat.downloadFile', ['type' => 'kk', 'filename' => basename($umat->baptis->surat_pernikahan_katolik_ortu)]) }}"
                                        class="btn btn-outline-primary d-block" target="_blank">
                                        Lihat Surat Pernikahan Orang Tua
                                    </a>
                                @else
                                    <span class="btn btn-outline-secondary disabled d-block">Belum ada</span>
                                @endif
                            </div>

                            <h1 class="pt-1 mt-4">Penerimaan Sakramen Baptis</h1>

                            <div class="col-sm-6">
                                <label for="nama_baptis" class="form-label">Nama Baptis</label>
                                <input disabled readonly type="text" class="form-control" id="nama_baptis" value="{{ $umat->baptis->nama_baptis }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="gereja_tempat_baptis" class="form-label">Gereja Tempat Baptis</label>
                                <input disabled readonly type="text" class="form-control" id="gereja_tempat_baptis" value="{{ $umat->baptis->gereja_tempat_baptis }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="tanggal_baptis" class="form-label">Tanggal Baptis</label>
                                @if ($umat->baptis->tanggal_terima)
                                    <input disabled readonly type="date" class="form-control" id="tanggal_baptis" value="{{ $umat->baptis->tanggal_terima->format('Y-m-d') }}">
                                @else
                                    <input disabled readonly type="text" class="form-control" id="tanggal_baptis" value="Belum Ada">
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="surat_baptis" class="form-label">Surat Pembaptisan</label>
                                <div>
                                    @if ($umat->baptis->surat_baptis)
                                        <a href="{{ route('sekretaris.umat.downloadFile', ['type' => 'surat_baptis', 'filename' => basename($umat->baptis->surat_baptis)]) }}"
                                            class="btn btn-outline-primary d-block" target="_blank">
                                            Lihat Surat Baptis
                                        </a>
                                    @else
                                        <span class="btn btn-outline-secondary disabled d-block">Belum ada</span>
                                    @endif
                                </div>
                            </div>

                            <h1 class="pt-1 mt-4">Penerimaan Sakramen Komuni</h1>

                            <div class="col-sm-6">
                                <label for="gereja_tempat_komuni" class="form-label">Gereja Tempat Penerimaan Komuni Pertama</label>
                                <input disabled readonly type="text" class="form-control" id="gereja_tempat_komuni" value="{{ $umat->komuni->gereja_tempat_komuni }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="tanggal_komuni" class="form-label">Tanggal Komuni Pertama</label>
                                @if ($umat->komuni->tanggal_terima)
                                    <input disabled readonly type="date" class="form-control" id="tanggal_komuni" value="{{ $umat->komuni->tanggal_terima->format('Y-m-d') }}">
                                @else
                                    <input disabled readonly type="text" class="form-control" id="tanggal_komuni" value="Belum Ada">
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="surat_komuni" class="form-label">Surat Komuni Pertama</label>
                                <div>
                                    @if ($umat->komuni->surat_komuni)
                                        <a href="{{ route('sekretaris.umat.downloadFile', ['type' => 'surat_komuni', 'filename' => basename($umat->komuni->surat_komuni)]) }}"
                                            class="btn btn-outline-primary d-block" target="_blank">
                                            Lihat Surat Komuni
                                        </a>
                                    @else
                                        <span class="btn btn-outline-secondary disabled d-block">Belum ada</span>
                                    @endif
                                </div>
                            </div>
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
