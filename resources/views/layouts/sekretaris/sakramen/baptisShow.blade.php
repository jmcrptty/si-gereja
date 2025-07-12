@extends('layouts.app')
@section('title', 'Data Pembaptisan')

@section('content')
    <main>
        <div class="px-4 container-fluid">
            <h1 class="mt-4">Formulir Pendaftaran Sakramen Baptis {{ $umat->nama_lengkap }}</h1>

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
                                <input disabled readonly type="text" class="form-control" id="gereja_tempat_baptis"
                                    value="{{ optional($umat->baptis)->gereja_tempat_baptis ?? 'Belum Ada' }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="tanggal_baptis" class="form-label">Tanggal Baptis</label>
                                @if (optional($umat->baptis)->tanggal_terima)
                                    <input disabled readonly type="date" class="form-control" id="tanggal_baptis"
                                        value="{{ optional($umat->baptis->tanggal_terima)->format('Y-m-d') }}">
                                @else
                                    <input disabled readonly type="text" class="form-control" id="tanggal_baptis" value="Belum Ada">
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="surat_baptis" class="form-label">Surat Pembaptisan</label>
                                <div>
                                    @if (optional($umat->baptis)->surat_baptis)
                                        <a href="{{ route('sekretaris.umat.downloadFile', ['type' => 'surat_baptis', 'filename' => basename($umat->baptis->surat_baptis)]) }}"
                                            class="btn btn-outline-primary d-block" target="_blank">
                                            Lihat Surat Baptis
                                        </a>
                                    @else
                                        <span class="btn btn-outline-secondary disabled d-block">Belum ada</span>
                                    @endif
                                </div>
                            </div>


                            @if ($umat->baptis->nama_wali_baptis || $umat->baptis->surat_krisma_wali_baptis)
                                {{-- Krisma Wali Baptis --}}
                                <div class="col-sm-6">
                                    <label for="nama_wali_baptis" class="form-label">Nama Wali Baptis</label>
                                    <input disabled readonly type="text" class="form-control" id="nama_wali_baptis" value="{{ $umat->baptis->nama_wali_baptis }}">
                                </div>

                                <div class="col-sm-6">
                                    <label for="surat_krisma_wali_baptis" class="form-label">Surat Krisma Wali Baptis</label>
                                    <div>
                                        @if ($umat->baptis->surat_krisma_wali_baptis)
                                            <a href="{{ route('sekretaris.umat.downloadFile', ['type' => 'surat_krisma_wali_baptis', 'filename' => basename($umat->baptis->surat_krisma_wali_baptis)]) }}"
                                                class="btn btn-outline-primary d-block" target="_blank">
                                                Lihat Surat Krisma Wali Baptis
                                            </a>
                                        @else
                                            <span class="btn btn-outline-secondary disabled d-block">Belum ada</span>
                                        @endif
                                    </div>
                                </div>

                            @elseif ($umat->baptis->nama_wali_baptis_pria || $umat->baptis->nama_wali_baptis_wanita || $umat->baptis->surat_pernikahan_wali_baptis)
                                {{-- Pernikahan Wali Baptis --}}
                                <div class="col-sm-6">
                                    <label for="nama_wali_baptis_pria" class="form-label">Nama Wali Baptis Pria</label>
                                    <input disabled readonly type="text" class="form-control" id="nama_wali_baptis_pria" value="{{ $umat->baptis->nama_wali_baptis_pria }}">
                                </div>

                                <div class="col-sm-6">
                                    <label for="nama_wali_baptis_wanita" class="form-label">Nama Wali Baptis Wanita</label>
                                    <input disabled readonly type="text" class="form-control" id="nama_wali_baptis_wanita" value="{{ $umat->baptis->nama_wali_baptis_wanita }}">
                                </div>

                                <div class="col-sm-6">
                                    <label for="surat_pernikahan_wali_baptis" class="form-label">Surat Pernikahan Wali Baptis</label>
                                    <div>
                                        @if ($umat->baptis->surat_pernikahan_wali_baptis)
                                            <a href="{{ route('sekretaris.umat.downloadFile', ['type' => 'surat_pernikahan_wali_baptis', 'filename' => basename($umat->baptis->surat_pernikahan_wali_baptis)]) }}"
                                                class="btn btn-outline-primary d-block" target="_blank">
                                                Lihat Surat Pernikahan Wali Baptis
                                            </a>
                                        @else
                                            <span class="btn btn-outline-secondary disabled d-block">Belum ada</span>
                                        @endif
                                    </div>
                                </div>
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
