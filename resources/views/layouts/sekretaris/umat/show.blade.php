@extends('layouts.app')
@section('title', 'Lingkungan')

@section('content')
    <main>
        <div class="px-4 container-fluid">
            <h1 class="mt-4">Detail {{ $umat->nama_lengkap }}</h1>

            <div class="mb-4 card">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Umat
                </div>
                <div class="card-body">
                    <form action="" method="">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input disabled readonly type="text" class="form-control" id="nama_lengkap" value="{{ $umat->nama_lengkap }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="nik" class="form-label">NIK</label>
                                <input disabled readonly type="text" class="form-control" id="nik" value="{{ $umat->nik }}">
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
                                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                <input disabled readonly type="text" class="form-control" id="nama_ayah" value="{{ $umat->nama_ayah }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                <input disabled readonly type="text" class="form-control" id="nama_ibu" value="{{ $umat->nama_ibu }}">
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
                                <label for="lingkungan" class="form-label">Lingkungan</label>
                                <input disabled readonly type="text" class="form-control" id="lingkungan" value="{{ $umat->lingkungan }}">
                            </div>

                            <h1 class="pt-1 mt-4">Berkas</h1>

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

                            @if ($umat->baptis)
                                <h1 class="pt-1 mt-4">Data Baptis</h1>

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
                                    @if ($tanggal_terima['Baptis'])
                                        <input disabled readonly type="date" class="form-control" id="tanggal_baptis" value="{{ $tanggal_terima['Baptis'] }}">
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
                            @endif

                            @if ($umat->komuni)
                                <h1 class="pt-1 mt-4">Data Komuni</h1>

                                <div class="col-sm-6">
                                    <label for="gereja_tempat_komuni" class="form-label">Gereja Tempat Penerimaan Komuni Pertama</label>
                                    <input disabled readonly type="text" class="form-control" id="gereja_tempat_komuni" value="{{ $umat->komuni->gereja_tempat_komuni }}">
                                </div>

                                <div class="col-sm-6">
                                    <label for="tanggal_komuni" class="form-label">Tanggal Komuni Pertama</label>
                                    @if ($tanggal_terima['Komuni'])
                                        <input disabled readonly type="date" class="form-control" id="tanggal_komuni" value="{{ $tanggal_terima['Komuni'] }}">
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
                            @endif

                            @if ($umat->krisma)
                                <h1 class="pt-1 mt-4">Data Krisma</h1>

                                <div class="col-sm-6">
                                    <label for="gereja_tempat_krisma" class="form-label">Gereja Tempat Penerimaan Krisma</label>
                                    <input disabled readonly type="text" class="form-control" id="gereja_tempat_krisma" value="{{ $umat->krisma->gereja_tempat_krisma }}">
                                </div>

                                <div class="col-sm-6">
                                    <label for="tanggal_krisma" class="form-label">Tanggal Krisma</label>
                                    @if ($tanggal_terima['Krisma'])
                                        <input disabled readonly type="date" class="form-control" id="tanggal_krisma" value="{{ $tanggal_terima['Krisma'] }}">
                                    @else
                                        <input disabled readonly type="text" class="form-control" id="tanggal_krisma" value="Belum Ada">
                                    @endif
                                </div>

                                <div class="col-sm-6">
                                    <label for="surat_krisma" class="form-label">Surat Krisma</label>
                                    <div>
                                        @if ($umat->krisma->surat_krisma)
                                            <a href="{{ route('sekretaris.umat.downloadFile', ['type' => 'surat_krisma', 'filename' => basename($umat->krisma->surat_krisma)]) }}"
                                                class="btn btn-outline-primary d-block" target="_blank">
                                                Lihat Surat Krisma
                                            </a>
                                        @else
                                            <span class="btn btn-outline-secondary disabled d-block">Belum ada</span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if ($umat->jenis_kelamin == 'Pria')
                                <h1 class="pt-1 mt-4">Data Pernikahan</h1>
                                @if ($umat->pernikahanPria && $umat->pernikahanPria->umat_id_wanita)
                                    <div class="col-sm-6">
                                        <label for="akte_file_wanita" class="form-label">Data Pasangan</label>
                                        <div>
                                            @if ($umat->pernikahanPria->akte_file_wanita)
                                                <a href="{{ route('sekretaris.umat.show', $umat->pernikahanPria->umat_id_wanita) }}"
                                                    class="btn btn-outline-primary d-block" target="_blank">
                                                    Lihat Data Pasangan
                                                </a>
                                            @else
                                                <span class="btn btn-outline-secondary disabled d-block">Belum ada</span>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <h1 class="pt-1 mt-4">Data Pasangan</h1>

                                    <div class="col-sm-6">
                                        <label for="nama_lengkap_wanita" class="form-label">Nama</label>
                                        <input disabled readonly type="text" class="form-control" id="nama_lengkap_wanita" value="{{ $umat->pernikahanPria->nama_lengkap_wanita }}">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="email_wanita" class="form-label">Email</label>
                                        <input disabled readonly type="text" class="form-control" id="email_wanita" value="{{ $umat->pernikahanPria->email_wanita }}">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="agama_wanita" class="form-label">Agama</label>
                                        <input disabled readonly type="text" class="form-control" id="agama_wanita" value="{{ $umat->pernikahanPria->agama_wanita }}">
                                    </div>

                                    @if ($umat->pernikahanPria->lingkungan_wanita)
                                        <div class="col-sm-6">
                                            <label for="lingkungan_wanita" class="form-label">Lingkungan</label>
                                            <input disabled readonly type="text" class="form-control" id="lingkungan_wanita" value="{{ $umat->pernikahanPria->lingkungan_wanita }}">
                                        </div>
                                    @endif

                                    <div class="col-sm-6">
                                        <label for="tempat_lahir_wanita" class="form-label">Tempat Lahir</label>
                                        <input disabled readonly type="text" class="form-control" id="tempat_lahir_wanita" value="{{ $umat->pernikahanPria->tempat_lahir_wanita }}">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="ttl_wanita" class="form-label">Tanggal Lahir</label>
                                        <input disabled readonly type="text" class="form-control" id="ttl_wanita" value="{{ $umat->pernikahanPria->ttl_wanita }}">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="alamat_wanita" class="form-label">Alamat</label>
                                        <input disabled readonly type="text" class="form-control" id="alamat_wanita" value="{{ $umat->pernikahanPria->alamat_wanita }}">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="akte_file_wanita" class="form-label">Surat Krisma</label>
                                        <div>
                                            @if ($umat->pernikahanPria->akte_file_wanita)
                                                <a href="{{ route('sekretaris.umat.downloadFile', ['type' => 'akte_file_wanita', 'filename' => basename($umat->pernikahanPria->akte_file_wanita)]) }}"
                                                    class="btn btn-outline-primary d-block" target="_blank">
                                                    Lihat Akte Kelahiran
                                                </a>
                                            @else
                                                <span class="btn btn-outline-secondary disabled d-block">Belum ada</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="tanggal_daftar" class="form-label">Tanggal Pendaftaran</label>
                                        @if ($umat->pernikahanPria->tanggal_daftar)
                                            <input disabled readonly type="date" class="form-control" id="tanggal_daftar" value="{{ $umat->pernikahanPria->tanggal_daftar }}">
                                        @else
                                            <input disabled readonly type="text" class="form-control" id="tanggal_daftar" value="Belum Ada">
                                        @endif
                                    </div>
                                @endif
                            @elseif ($umat->jenis_kelamin == 'Wanita')
                                <h1 class="pt-1 mt-4">Data Pernikahan</h1>
                                @if ($umat->pernikahanWanita && $umat->pernikahanWanita->umat_id_pria)
                                    <div class="col-sm-6">
                                        <label for="akte_file_pria" class="form-label">Data Pasangan</label>
                                        <div>
                                            @if ($umat->pernikahanWanita->akte_file_pria)
                                                <a href="{{ route('sekretaris.umat.show', $umat->pernikahanWanita->umat_id_pria) }}"
                                                    class="btn btn-outline-primary d-block" target="_blank">
                                                    Lihat Data Pasangan
                                                </a>
                                            @else
                                                <span class="btn btn-outline-secondary disabled d-block">Belum ada</span>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <h1 class="pt-1 mt-4">Data Pasangan</h1>

                                    <div class="col-sm-6">
                                        <label for="nama_lengkap_pria" class="form-label">Nama</label>
                                        <input disabled readonly type="text" class="form-control" id="nama_lengkap_pria" value="{{ $umat->pernikahanWanita->nama_lengkap_pria }}">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="email_pria" class="form-label">Email</label>
                                        <input disabled readonly type="text" class="form-control" id="email_pria" value="{{ $umat->pernikahanWanita->email_pria }}">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="agama_pria" class="form-label">Agama</label>
                                        <input disabled readonly type="text" class="form-control" id="agama_pria" value="{{ $umat->pernikahanWanita->agama_pria }}">
                                    </div>

                                    @if ($umat->pernikahanWanita->lingkungan_pria)
                                        <div class="col-sm-6">
                                            <label for="lingkungan_pria" class="form-label">Lingkungan</label>
                                            <input disabled readonly type="text" class="form-control" id="lingkungan_pria" value="{{ $umat->pernikahanWanita->lingkungan_pria }}">
                                        </div>
                                    @endif

                                    <div class="col-sm-6">
                                        <label for="tempat_lahir_pria" class="form-label">Tempat Lahir</label>
                                        <input disabled readonly type="text" class="form-control" id="tempat_lahir_pria" value="{{ $umat->pernikahanWanita->tempat_lahir_pria }}">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="ttl_pria" class="form-label">Tanggal Lahir</label>
                                        <input disabled readonly type="text" class="form-control" id="ttl_pria" value="{{ $umat->pernikahanWanita->ttl_pria }}">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="alamat_pria" class="form-label">Alamat</label>
                                        <input disabled readonly type="text" class="form-control" id="alamat_pria" value="{{ $umat->pernikahanWanita->alamat_pria }}">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="akte_file_pria" class="form-label">Surat Krisma</label>
                                        <div>
                                            @if ($umat->pernikahanWanita->akte_file_pria)
                                                <a href="{{ route('sekretaris.umat.downloadFile', ['type' => 'akte_file_pria', 'filename' => basename($umat->pernikahanWanita->akte_file_pria)]) }}"
                                                    class="btn btn-outline-primary d-block" target="_blank">
                                                    Lihat Akte Kelahiran
                                                </a>
                                            @else
                                                <span class="btn btn-outline-secondary disabled d-block">Belum ada</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="tanggal_daftar" class="form-label">Tanggal Pendaftaran</label>
                                        @if ($umat->pernikahanWanita->tanggal_daftar)
                                            <input disabled readonly type="date" class="form-control" id="tanggal_daftar" value="{{ $umat->pernikahanWanita->tanggal_daftar }}">
                                        @else
                                            <input disabled readonly type="text" class="form-control" id="tanggal_daftar" value="Belum Ada">
                                        @endif
                                    </div>
                                @endif
                            @endif

                        </div>

                        <div class="mt-5 button-group text-end">
                            <a href="{{ route('sekretaris.umat.index') }}" class="border-0 rounded btn-warning btn btn-lg">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
