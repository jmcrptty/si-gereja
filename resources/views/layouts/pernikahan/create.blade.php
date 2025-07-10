@extends('layouts.layoutUmum')

@section('judul-halaman')
    Pendaftaran Sakramen Pernikahan
@endsection

@section('gambar-hero')
    <div class="d-block w-100 hero-slide" style="background-image: url('/img/pernikahan.png');"></div>
@endsection

@section('judul-hero')
    <h1 class="mb-4 display-4">Persyaratan Pernikahan <br>Katedral Merauke</h1>
@endsection

@section('content')
    <!-- Universal Modal for Notifications -->
    <div class="modal fade" id="pemberitahuanModalOutside" tabindex="-1" aria-labelledby="pemberitahuanModalOutsideLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="border-0 shadow modal-content">
                <div class="pb-0 border-0 modal-header">
                    <h5 class="modal-title fw-bold text-primary" id="pemberitahuanModalOutsideLabel">
                        <i class="fas fa-check-circle"></i> Info
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="pt-1 text-center modal-body">
                    <dotlottie-player
                        id="lottiePlayer"
                        src="https://lottie.host/5bd5a5af-8846-4de0-be5c-1d14c6093e61/Y8dZXXk9GH.lottie"
                        background="transparent"
                        speed="1"
                        style="width: 200px; height: 200px; display: block; margin: 0 auto;"
                        autoplay>
                    </dotlottie-player>
                    <h3 id="modalMessage">[message]</h3>
                </div>
                <div class="pt-0 border-0 modal-footer">
                    <button type="button" class="btn btn-primary btn-lg" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>


    <main>
        <div class="px-4 container-fluid">
            <h1 class="mt-4">Formulir Pendaftaran Sakramen Pernikahan</h1>
            <ol class="mb-4 breadcrumb">
                {{-- <li class="breadcrumb-item active">Tambah, Edit, dan Hapus Data Umat</li> --}}
            </ol>

            <div class="mb-4 card">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Formulir Sakramen Pernikahan
                </div>
                <div class="card-body">
                    <form action="{{ route('pernikahan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- tidak untuk diubah-ubah --}}

                        {{-- email umat yang mendaftar --}}
                        <input type="hidden" name="token" value="{{ request()->segment(3) }}">
                        {{-- email default --}}
                        <input type="hidden" name="email_default_pendaftar" value="{{ $umat->email }}">
                        {{-- jenis kelamin umat yang mendaftar --}}
                        <input type="hidden" name="jenis_kelamin_umat" value="{{ $umat->jenis_kelamin }}">

                        <div class="row g-3">
                            {{-- CALON PRIA --}}
                            <h1 class="pt-1 mt-4">Calon Penerima Pria</h1>

                            @if ($umat->jenis_kelamin == 'Wanita')
                                <div class="col-sm-6">
                                    <label for="cari_email_pria" class="form-label">Email</label><div class="form-text d-inline"><span>&nbsp;</span> <span>&#40;</span>jika pasangan sudah terdaftar sebagai umat, isi email untuk mengisi data secara otomatis<span>&#41;</span></div>
                                        <input type="text" class="form-control @error ('cari_email_pria')is-invalid @enderror" id="cari_email_pria" name="cari_email_pria" placeholder="Masukkan Email yang Terdaftar" value="{{ old('cari_email_pria') }}">
                                        <div class="text-center alert alert-info" id="statusAlert" style="display: none;">
                                            <strong>Status: </strong><span id="statusMessage"></span>
                                        </div>
                                        @error('cari_email_pria')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                </div>

                                {{-- pencarian email --}}
                                <div class="col-sm-3">
                                    <label for="tombol_cari_email_pria" class="form-label"></label>
                                    <button type="button" id="tombol_cari_email_pria" class="btn btn-dark d-block">Cari</button>
                                </div>
                            @endif

                            <div class="col-sm-6">
                                <label for="nama_lengkap_pria" class="form-label">Nama Lengkap</label>
                                @if ($umat->jenis_kelamin == 'Pria')
                                    <input readonly type="text" class="form-control @error ('nama_lengkap_pria')is-invalid @enderror pseudo-disabled" id="nama_lengkap_pria" name="nama_lengkap_pria" value="{{ $umat->nama_lengkap }}" required>
                                @else
                                    <input type="text" class="form-control @error ('nama_lengkap_pria')is-invalid @enderror" id="nama_lengkap_pria" name="nama_lengkap_pria" value="{{ old('nama_lengkap_pria') }}" required>
                                    @error('nama_lengkap_pria')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="email_pria" class="form-label">Email</label>
                                @if ($umat->jenis_kelamin == 'Pria')
                                    <input readonly type="text" class="form-control @error ('email_pria')is-invalid @enderror" id="email_pria" name="email_pria" value="{{ $umat->email }}" required>
                                    @error('email_pria')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    <input type="text" class="form-control @error ('email_pria')is-invalid @enderror" id="email_pria" name="email_pria" value="{{ old('email_pria') }}" required>
                                    @error('email_pria')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="alamat_pria" class="form-label">Alamat</label>
                                @if ($umat->jenis_kelamin == 'Pria')
                                    <input readonly type="text" class="form-control @error ('alamat_pria')is-invalid @enderror pseudo-disabled" id="alamat_pria" name="alamat_pria" value="{{ $umat->alamat }}" required>
                                @else
                                    <input type="text" class="form-control @error ('alamat_pria')is-invalid @enderror" id="alamat_pria" name="alamat_pria" value="{{ old('alamat_pria') }}" required>
                                    @error('alamat_pria')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="tempat_lahir_pria" class="form-label">Tempat Lahir</label>
                                @if ($umat->jenis_kelamin == 'Pria')
                                    <input readonly type="text" class="form-control @error ('tempat_lahir_pria')is-invalid @enderror pseudo-disabled" id="tempat_lahir_pria" name="tempat_lahir_pria" value="{{ $umat->tempat_lahir }}" required>
                                @else
                                    <input type="text" class="form-control @error ('tempat_lahir_pria')is-invalid @enderror" id="tempat_lahir_pria" name="tempat_lahir_pria" value="{{ old('tempat_lahir_pria') }}" required>
                                    @error('tempat_lahir_pria')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="ttl_pria" class="form-label">Tanggal Lahir</label>
                                @if ($umat->jenis_kelamin == 'Pria')
                                    <input readonly type="date" class="form-control @error ('ttl_pria')is-invalid @enderror pseudo-disabled" id="ttl_pria" name="ttl_pria" value="{{ $umat->ttl }}" required>
                                @else
                                    <input type="date" class="form-control @error ('ttl_pria')is-invalid @enderror" id="ttl_pria" name="ttl_pria" value="{{ old('ttl_pria') }}" required>
                                    @error('ttl_pria')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            @if (($umat->jenis_kelamin == 'Pria') && !empty($umat->akte_file))
                                {{-- jika umat adalah pria yang sudah mengupload akte: tampilkan badge sudah upload dan masukkan ke hidden input --}}
                                <div class="col-sm-6">
                                    <label for="akte_pria" class="form-label">Akte Kelahiran</label>
                                    <div class="mb-2">
                                        <span class="p-2 px-3 py-2 badge bg-success fs-6">
                                            ✔ Sudah Diupload
                                        </span>
                                    </div>
                                    <input type="hidden" class="form-control @error('akte_pria') is-invalid @enderror" id="akte_pria" name="akte_path_pria" value="{{ $umat->akte_file }}" required>
                                    @error('akte_pria')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @else
                                {{-- jika umat bukan pria atau belum upload berkas: minta akte kelahiran --}}
                                <div class="col-sm-6">
                                    <label for="akte_pria_manual" id="wrapper_akte_pria_manual" class="form-label">Akte Kelahiran</label>
                                    <input type="file" class="form-control @error('akte_pria') is-invalid @enderror" id="akte_pria_manual" name="akte_pria" required>
                                    @error('akte_pria')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif

                            {{-- tampil kalau umat jalur cari email --}}
                            <div class="col-sm-6" id="wrapper_akte_pria_otomatis" style="display: none">
                                <div class="form-label">Akte Kelahiran</div>
                                <div class="mb-2">
                                    <span class="p-2 px-3 py-2 badge bg-success fs-6">
                                        ✔ Sudah Diupload
                                    </span>
                                </div>
                                <input type="hidden" class="form-control @error('akte_pria') is-invalid @enderror" id="akte_pria_otomatis" name="akte_path_pria" value="{{ $umat->akte_file }}" disabled required>
                                @error('akte_pria')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                @if ($umat->jenis_kelamin == 'Pria')
                                    {{-- jika merupakan umat -> sudah pasti katolik dan memiliki lignkungan --}}
                                    <label for="lingkungan_pria" class="form-label">Lingkungan</label>
                                    <select type="text" class="form-control @error ('lingkungan_pria')is-invalid @enderror pseudo-disabled" id="lingkungan_pria" name="lingkungan_pria" placeholder="" value="" required>
                                        <option value="st.petrus" {{ old('lingkungan', $umat->lingkungan) == 'st.petrus' ? 'selected' : '' }}>St. Petrus</option>
                                        <option value="st.yohanes" {{ old('lingkungan', $umat->lingkungan) == 'st.yohanes' ? 'selected' : '' }}>St. Yohanes</option>
                                        <option value="st.maria" {{ old('lingkungan', $umat->lingkungan) == 'st.maria' ? 'selected' : '' }}>St. Maria</option>
                                    </select>
                                    @error('lingkungan_pria')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    {{-- jika bukan umat -> mungkin katolik dan memiliki lingkungan --}}
                                    <label for="agama_pria" class="form-label">Agama</label>
                                    <select type="text" class="form-control @error ('agama_pria')is-invalid @enderror" id="agama_pria" name="agama_pria" placeholder="" value="" required>
                                        <option selected disabled value="">Pilih Agama</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Khonghucu">Khonghucu</option>
                                    </select>
                                    @error('agama_pria')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            {{-- jika katolik, tampilkan pilihan lingkungan --}}
                            <div class="col-sm-6" id="wrapper_lingkungan_pria_manual" style="display: none;">
                                <label for="lingkungan_pria_manual" class="form-label">Lingkungan</label>
                                <input type="text" class="form-control @error ('lingkungan_pria_manual')is-invalid @enderror" id="lingkungan_pria_manual" name="lingkungan_pria_manual" placeholder="Nama Lingkungan (Nama Paroki)" value="{{ old('lingkungan_pria_manual') }}" disabled required>
                                @error('lingkungan_pria_manual')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- tampil jika umat jalur cari email --}}
                            <div class="col-sm-6" id="wrapper_lingkungan_pria_otomatis" style="display: none">
                                <label for="lingkungan_pria_otomatis" class="form-label">Lingkungan</label>
                                <select type="text" class="form-control @error ('lingkungan_pria')is-invalid @enderror pseudo-disabled" id="lingkungan_pria_otomatis" name="lingkungan_pria" placeholder="" value="" disabled required>
                                    <option value="st.petrus" {{ old('lingkungan', $umat->lingkungan) == 'st.petrus' ? 'selected' : '' }}>St. Petrus</option>
                                    <option value="st.yohanes" {{ old('lingkungan', $umat->lingkungan) == 'st.yohanes' ? 'selected' : '' }}>St. Yohanes</option>
                                    <option value="st.maria" {{ old('lingkungan', $umat->lingkungan) == 'st.maria' ? 'selected' : '' }}>St. Maria</option>
                                </select>
                                @error('lingkungan_pria')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- CALON WANITA  --}}
                            <h1 class="pt-1 mt-4">Calon Penerima Wanita</h1>
                            @if ($umat->jenis_kelamin == 'Pria')
                                <div class="col-sm-6">
                                    <label for="cari_email_wanita" class="form-label">Email</label><div class="form-text d-inline"><span>&nbsp;</span> <span>&#40;</span>jika pasangan sudah terdaftar sebagai umat, isi email untuk mengisi data secara otomatis<span>&#41;</span></div>
                                        <input type="text" class="form-control @error ('cari_email_wanita')is-invalid @enderror" id="cari_email_wanita" name="cari_email_wanita" placeholder="Masukkan Email yang Terdaftar" value="{{ old('cari_email_wanita') }}">
                                        <div class="text-center alert alert-info" id="statusAlert" style="display: none;">
                                            <strong>Status: </strong><span id="statusMessage"></span>
                                        </div>
                                        @error('cari_email_wanita')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                </div>
                                {{-- pencarian email --}}
                                <div class="col-sm-3">
                                    <label for="tombol_cari_email_wanita" class="form-label"></label>
                                    <button type="button" id="tombol_cari_email_wanita" class="btn btn-dark d-block">Cari</button>
                                </div>
                            @endif

                            <div class="col-sm-6">
                                <label for="nama_lengkap_wanita" class="form-label">Nama Lengkap</label>
                                @if ($umat->jenis_kelamin == 'Wanita')
                                    <input readonly type="text" class="form-control @error ('nama_lengkap_wanita')is-invalid @enderror pseudo-disabled" id="nama_lengkap_wanita" name="nama_lengkap_wanita" value="{{ $umat->nama_lengkap }}" required>
                                @else
                                    <input type="text" class="form-control @error ('nama_lengkap_wanita')is-invalid @enderror" id="nama_lengkap_wanita" name="nama_lengkap_wanita" value="{{ old('nama_lengkap_wanita') }}">
                                    @error('nama_lengkap_wanita')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="email_wanita" class="form-label">Email</label>
                                @if ($umat->jenis_kelamin == 'Wanita')
                                    <input readonly type="text" class="form-control @error ('email_wanita')is-invalid @enderror" id="email_wanita" name="email_wanita" value="{{ $umat->email }}" required>
                                    @error('email_wanita')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    <input type="text" class="form-control @error ('email_wanita')is-invalid @enderror" id="email_wanita" name="email_wanita" value="{{ old('email_wanita') }}" required>
                                    @error('email_wanita')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="alamat_wanita" class="form-label">Alamat</label>
                                @if ($umat->jenis_kelamin == 'Wanita')
                                    <input readonly type="text" class="form-control @error ('alamat_wanita')is-invalid @enderror pseudo-disabled" id="alamat_wanita" name="alamat_wanita" value="{{ $umat->alamat }}" required>
                                @else
                                    <input type="text" class="form-control @error ('alamat_wanita')is-invalid @enderror" id="alamat_wanita" name="alamat_wanita" value="{{ old('alamat_wanita') }}" required>
                                    @error('alamat_wanita')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="tempat_lahir_wanita" class="form-label">Tempat Lahir</label>
                                @if ($umat->jenis_kelamin == 'Wanita')
                                    <input readonly type="text" class="form-control @error ('tempat_lahir_wanita')is-invalid @enderror pseudo-disabled" id="tempat_lahir_wanita" name="tempat_lahir_wanita" value="{{ $umat->tempat_lahir }}" required>
                                @else
                                    <input type="text" class="form-control @error ('tempat_lahir_wanita')is-invalid @enderror" id="tempat_lahir_wanita" name="tempat_lahir_wanita" value="{{ old('tempat_lahir_wanita') }}" required>
                                    @error('tempat_lahir_wanita')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="ttl_wanita" class="form-label">Tanggal Lahir</label>
                                @if ($umat->jenis_kelamin == 'Wanita')
                                    <input readonly type="date" class="form-control @error ('ttl_wanita')is-invalid @enderror pseudo-disabled" id="ttl_wanita" name="ttl_wanita" value="{{ $umat->ttl }}" required>
                                @else
                                    <input type="date" class="form-control @error ('ttl_wanita')is-invalid @enderror" id="ttl_wanita" name="ttl_wanita" value="{{ old('ttl_wanita') }}" required>
                                    @error('ttl_wanita')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            @if (($umat->jenis_kelamin == 'Wanita') && !empty($umat->akte_file))
                                {{-- jika umat adalah wanita yang sudah mengupload akte: tampilkan badge sudah upload dan masukkan ke hidden input --}}
                                <div class="col-sm-6">
                                    <label for="akte_wanita" class="form-label">Akte Kelahiran</label>
                                    <div class="mb-2">
                                        <span class="p-2 px-3 py-2 badge bg-success fs-6">
                                            ✔ Sudah Diupload
                                        </span>
                                    </div>
                                    <input type="hidden" class="form-control @error('akte_wanita') is-invalid @enderror" id="akte_wanita" name="akte_path_wanita" value="{{ $umat->akte_file }}" required>
                                    @error('akte_wanita')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @else
                                {{-- jika umat bukan wanita atau belum upload berkas: minta akte kelahiran --}}
                                @if (session('uploaded_akte_pria'))
                                    <div class="mb-2">
                                        <span class="p-2 px-3 py-2 badge bg-success fs-6">
                                            ✔ Sudah Diupload
                                        </span>
                                    </div>
                                    <input type="hidden" name="akte_path_pria" value="{{ session('uploaded_akte_pria') }}">
                                @endif

                                <div class="col-sm-6">
                                    <label for="akte_wanita_manual" id="wrapper_akte_wanita_manual" class="form-label">Akte Kelahiran</label>
                                    <input type="file" class="form-control @error('akte_wanita') is-invalid @enderror" id="akte_wanita_manual" name="akte_wanita" required>
                                    @error('akte_wanita')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif

                            {{-- tampil kalau umat jalur cari email --}}
                            <div class="col-sm-6" id="wrapper_akte_wanita_otomatis" style="display: none">
                                <div class="form-label">Akte Kelahiran</div>
                                <div class="mb-2">
                                    <span class="p-2 px-3 py-2 badge bg-success fs-6">
                                        ✔ Sudah Diupload
                                    </span>
                                </div>
                                <input type="hidden" class="form-control @error('akte_wanita') is-invalid @enderror" id="akte_wanita_otomatis" name="akte_path_wanita" value="{{ $umat->akte_file }}" disabled required>
                                @error('akte_wanita')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                @if ($umat->jenis_kelamin == 'Wanita')
                                    {{-- jika merupakan umat -> sudah pasti katolik dan memiliki lignkungan --}}
                                    <label for="lingkungan_wanita" class="form-label">Lingkungan</label>
                                    <select type="text" class="form-control @error ('lingkungan_wanita')is-invalid @enderror pseudo-disabled" id="lingkungan_wanita" name="lingkungan_wanita" placeholder="" value="" required>
                                        <option value="st.petrus" {{ old('lingkungan', $umat->lingkungan) == 'st.petrus' ? 'selected' : '' }}>St. Petrus</option>
                                        <option value="st.yohanes" {{ old('lingkungan', $umat->lingkungan) == 'st.yohanes' ? 'selected' : '' }}>St. Yohanes</option>
                                        <option value="st.maria" {{ old('lingkungan', $umat->lingkungan) == 'st.maria' ? 'selected' : '' }}>St. Maria</option>
                                    </select>
                                    @error('lingkungan_wanita')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    {{-- jika bukan umat -> mungkin katolik dan memiliki lingkungan --}}
                                    <label for="agama_wanita" class="form-label">Agama</label>
                                    <select class="form-control @error('agama_wanita') is-invalid @enderror"
                                            id="agama_wanita"
                                            name="agama_wanita"
                                            required>
                                        <option disabled selected value="">Pilih Agama</option>
                                        <option value="Katolik" {{ old('agama_wanita') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Kristen" {{ old('agama_wanita') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="Islam" {{ old('agama_wanita') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Hindu" {{ old('agama_wanita') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Buddha" {{ old('agama_wanita') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                        <option value="Khonghucu" {{ old('agama_wanita') == 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                                    </select>
                                    @error('agama_wanita')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            {{-- jika katolik, tampilkan pilihan lingkungan --}}
                            <div class="col-sm-6" id="wrapper_lingkungan_wanita_manual" style="display: none;">
                                <label for="lingkungan_wanita_manual" class="form-label">Lingkungan</label>
                                <input type="text" class="form-control @error ('lingkungan_wanita_manual')is-invalid @enderror" id="lingkungan_wanita_manual" name="lingkungan_wanita_manual" placeholder="Nama Lingkungan (Nama Paroki)" value="{{ old('lingkungan_wanita_manual') }}" disabled required>
                                @error('lingkungan_wanita_manual')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- tampil jika umat jalur cari email --}}
                            <div class="col-sm-6" id="wrapper_lingkungan_wanita_otomatis" style="display: none">
                                <label for="lingkungan_wanita_otomatis" class="form-label">Lingkungan</label>
                                <select type="text" class="form-control @error ('lingkungan_wanita')is-invalid @enderror pseudo-disabled" id="lingkungan_wanita_otomatis" name="lingkungan_wanita" placeholder="" value="" disabled required>
                                    <option value="st.petrus" {{ old('lingkungan', $umat->lingkungan) == 'st.petrus' ? 'selected' : '' }}>St. Petrus</option>
                                    <option value="st.yohanes" {{ old('lingkungan', $umat->lingkungan) == 'st.yohanes' ? 'selected' : '' }}>St. Yohanes</option>
                                    <option value="st.maria" {{ old('lingkungan', $umat->lingkungan) == 'st.maria' ? 'selected' : '' }}>St. Maria</option>
                                </select>
                                @error('lingkungan_wanita')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-5 button-group text-end">
                            <a href="{{ route('pernikahan') }}" class="btn btn-dark">Kembali</a>
                            <button class="btn btn-dark" type="submit">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('baptis-after-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // pria
            const agama_select_pria = document.getElementById('agama_pria');
            const lingkunganTextPriaWrapper = document.getElementById('wrapper_lingkungan_pria_manual');
            const lingkunganTextPria = document.getElementById('lingkungan_pria_manual');
            const lingkunganSelectPria = document.getElementById('lingkungan_pria');

            if(agama_select_pria){
                agama_select_pria.addEventListener('change', function(){
                    const selectedValue = this.value;
                    if(selectedValue == 'Katolik'){
                        // nyalakan lingkungan text dan set nilai jadi kosong
                        lingkunganTextPriaWrapper.style.display = 'block';
                        lingkunganTextPria.disabled = false;
                        lingkunganTextPria.value = ""; // bersihkan input sebelumnya

                        // matikan lingkungan select
                        if(lingkunganSelectPria){
                            lingkunganSelectPria.disabled = true;
                        }
                    }
                    else {
                        lingkunganTextPriaWrapper.style.display = 'none';
                        lingkunganTextPria.disabled = true;

                        // nyalakan lingkungan select
                        if(lingkunganSelectPria){
                            lingkunganSelectPria.disabled = false;
                        }
                    }
                });

                if(agama_select_pria.value == 'Katolik'){
                    // nyalakan lingkungan text
                    lingkunganTextPriaWrapper.style.display = 'block';
                    lingkunganTextPria.disabled = false;

                    // matikan lingkungan select
                    if(lingkunganSelectPria){
                        lingkunganSelectPria.disabled = true;
                    }
                }
            }

            // wanita
            const agama_select_wanita = document.getElementById('agama_wanita');
            const lingkunganTextWanitaWrapper = document.getElementById('wrapper_lingkungan_wanita_manual');
            const lingkunganTextWanita = document.getElementById('lingkungan_wanita_manual');
            const lingkunganSelectWanita = document.getElementById('lingkungan_wanita');

            if (agama_select_wanita) {
                agama_select_wanita.addEventListener('change', function () {
                    const selectedValue = this.value;
                    if (selectedValue === 'Katolik') {
                        lingkunganTextWanitaWrapper.style.display = 'block';
                        lingkunganTextWanita.disabled = false;
                        lingkunganTextWanita.value = "";

                        if (lingkunganSelectWanita) {
                            lingkunganSelectWanita.disabled = true;
                        }
                    } else {
                        lingkunganTextWanitaWrapper.style.display = 'none';
                        lingkunganTextWanita.disabled = true;

                        if (lingkunganSelectWanita) {
                            lingkunganSelectWanita.disabled = false;
                        }
                    }
                });

                if (agama_select_wanita.value === 'Katolik') {
                    lingkunganTextWanitaWrapper.style.display = 'block';
                    lingkunganTextWanita.disabled = false;

                    if (lingkunganSelectWanita) {
                        lingkunganSelectWanita.disabled = true;
                    }
                }
            }

        });

        $(document).ready(function(){
            $('#tombol_cari_email_pria').on('click', function(){
                var email = document.getElementById('cari_email_pria').value; //masukan nilai dari input berdasarkan id
                // verifikasi token
                const pathSegments = window.location.pathname.split('/');
                const token = pathSegments[pathSegments.length - 1];

                // Validasi dulu
                if (email === '') {
                    statusAlert.style.display = 'block';
                    statusMessage.textContent = 'email tidak boleh kosong.';
                    statusMessage.classList.remove('text-success', 'text-primary');
                    statusMessage.classList.add('text-danger');
                    pendaftaranButton.style.display = 'none';
                    return;
                }

                // INGAT BUAT PENCEGAHAN EMAIL SESAMA JNIS

                // cari email pria
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ url('api/cek_email_pernikahan_pria') }}",
                    type: "POST",
                    data: { email: email, token: token },
                    dataType: 'json',
                    success: function(result) {
                        const $modal = $('#pemberitahuanModalOutside');
                        const $message = $('#modalMessage');

                        const $lingkunganOtomatisPria = $('#lingkungan_pria_otomatis');
                        const $lingkunganOtomatisPriaWrapper = $('#wrapper_lingkungan_pria_otomatis');

                        const $lingkunganTextPriaWrapper = $('#wrapper_lingkungan_pria_manual');
                        const $lingkunganManualPria = $('#lingkungan_pria_manual');

                        const $akteOtomatisPria = $('#akte_pria_otomatis');
                        const $akteOtomatisPriaWrapper = $('#wrapper_akte_pria_otomatis');

                        const $akteManualPria = $('#akte_pria_manual');
                        const $akteManualPriaWrapper = $('#wrapper_akte_pria_manual');

                        const fields = {
                            'nama_lengkap_pria': result.nama_lengkap,
                            'email_pria': result.email,
                            'alamat_pria': result.alamat,
                            'tempat_lahir_pria': result.tempat_lahir,
                            'ttl_pria': result.ttl,
                            'lingkungan_pria': result.lingkungan,
                            'akte_pria': result.akte_file,
                        };

                        if (result.status === 'not_found') {
                            // nyalakan agama
                            $('#agama_pria').prop('disabled', false).closest('.col-sm-6').show();
                            $('#agama_pria').val("");
                            // nyalakan akte manual
                            $('#akte_pria_manual').prop('disabled', false).closest('.col-sm-6').show();

                            // matikan lingkungan dan akte otomatis
                            $lingkunganOtomatisPriaWrapper.hide();
                            $lingkunganOtomatisPria.prop('disabled', true);
                            $akteOtomatisPriaWrapper.hide();
                            $akteOtomatisPria.prop('disabled', true);

                            for (const [id, value] of Object.entries(fields)) {
                                const el = document.getElementById(id);
                                if (el) {
                                    el.value = '';
                                    el.classList.remove('pseudo-disabled');
                                }
                            }

                            $message.text('Email tidak ditemukan. Silakan melakukan pendaftaran umat.');
                        } else {
                            for (const [id, value] of Object.entries(fields)) {
                                const el = document.getElementById(id);
                                if (el) {
                                    el.value = value || '';
                                    console.log(el.value);
                                    el.classList.add('pseudo-disabled');
                                }
                            }

                            // masukkan nilai lingkungan dan akte krn sebelumnya disabled
                            $lingkunganOtomatisPriaWrapper.show();
                            $lingkunganOtomatisPria.prop('disabled', false);
                            $lingkunganOtomatisPria.val(result.lingkungan);

                             if(result.akte_file && result.akte_file !== ''){
                                // jika umat sudah upload akte
                                $akteOtomatisPriaWrapper.show();
                                $akteOtomatisPria.prop('disabled', false);
                                $akteOtomatisPria.val(result.akte_file);

                                $akteManualPriaWrapper.hide();
                                $akteManualPria.val('');
                                $akteManualPria.prop('disabled', true);
                            } else {
                                // jika umat belum upload akte
                                $akteManualPriaWrapper.show();
                                $akteManualPria.prop('disabled', false);
                                $akteManualPria.val(result.akte_file);

                                $akteOtomatisPriaWrapper.hide();
                                $akteOtomatisPria.val('');
                                $akteOtomatisPria.prop('disabled', true);
                            }


                            // matikan agama
                            $('#agama_pria').prop('disabled', true).closest('.col-sm-6').hide();

                            // matikan lingkungan manual kalau menyala
                            $lingkunganTextPriaWrapper.hide();
                            $lingkunganManualPria.prop('disabled', true);

                            $message.text('Data berhasil ditemukan dan telah diisikan otomatis.');
                        }

                        // an attempt to make modal aria safe wkwk
                        $modal.attr('aria-hidden', 'false');
                        if (!$modal.hasClass('show')) {
                            $modal.modal('show');
                        }
                    }
                });
            });

            $('#tombol_cari_email_wanita').on('click', function(){
                var email = document.getElementById('cari_email_wanita').value; //masukan nilai dari input berdasarkan id
                // verifikasi token
                const pathSegments = window.location.pathname.split('/');
                const token = pathSegments[pathSegments.length - 1];

                // Validasi dulu
                if (email === '') {
                    statusAlert.style.display = 'block';
                    statusMessage.textContent = 'email tidak boleh kosong.';
                    statusMessage.classList.remove('text-success', 'text-primary');
                    statusMessage.classList.add('text-danger');
                    pendaftaranButton.style.display = 'none';
                    return;
                }

                // cari email wanita
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ url('api/cek_email_pernikahan_wanita') }}",
                    type: "POST",
                    data: { email: email, token: token },
                    dataType: 'json',
                    success: function(result) {
                        const $modal = $('#pemberitahuanModalOutside');
                        const $message = $('#modalMessage');

                        const $lingkunganOtomatiswanita = $('#lingkungan_wanita_otomatis');
                        const $lingkunganOtomatiswanitaWrapper = $('#wrapper_lingkungan_wanita_otomatis');

                        const $lingkunganTextwanitaWrapper = $('#wrapper_lingkungan_wanita_manual');
                        const $lingkunganManualwanita = $('#lingkungan_wanita_manual');

                        const $akteOtomatiswanita = $('#akte_wanita_otomatis');
                        const $akteOtomatiswanitaWrapper = $('#wrapper_akte_wanita_otomatis');

                        const fields = {
                            'nama_lengkap_wanita': result.nama_lengkap,
                            'email_wanita': result.email,
                            'alamat_wanita': result.alamat,
                            'tempat_lahir_wanita': result.tempat_lahir,
                            'ttl_wanita': result.ttl,
                            'lingkungan_wanita': result.lingkungan,
                            'akte_wanita': result.akte_file,
                        };

                        if (result.status === 'not_found') {
                            // nyalakan agama
                            $('#agama_wanita').prop('disabled', false).closest('.col-sm-6').show();
                            $('#agama_wanita').val("");
                            // nyalakan akte manual
                            $('#akte_wanita_manual').prop('disabled', false).closest('.col-sm-6').show();

                            // matikan lingkungan dan akte otomatis
                            $lingkunganOtomatiswanitaWrapper.hide();
                            $lingkunganOtomatiswanita.prop('disabled', true);
                            $akteOtomatiswanitaWrapper.hide();
                            $akteOtomatiswanita.prop('disabled', true);

                            for (const [id, value] of Object.entries(fields)) {
                                const el = document.getElementById(id);
                                if (el) {
                                    el.value = '';
                                    el.classList.remove('pseudo-disabled');
                                }
                            }

                            $message.text('Email tidak ditemukan. Silakan melakukan pendaftaran umat.');
                        } else {
                            for (const [id, value] of Object.entries(fields)) {
                                const el = document.getElementById(id);
                                if (el) {
                                    el.value = value || '';
                                    console.log(el.value);
                                    el.classList.add('pseudo-disabled');
                                }
                            }

                            // masukkan nilai lingkungan dan akte krn sebelumnya disabled
                            $lingkunganOtomatiswanitaWrapper.show();
                            $lingkunganOtomatiswanita.prop('disabled', false);
                            $lingkunganOtomatiswanita.val(result.lingkungan);

                            // matikan akte manual
                            $('#akte_wanita_manual').prop('disabled', true).closest('.col-sm-6').hide();

                            if(result.akte_file && result.akte_file !== ''){
                                // jika umat sudah upload akte
                                $akteOtomatiswanitaWrapper.show();
                                $akteOtomatiswanita.prop('disabled', false);
                                $akteOtomatiswanita.val(result.akte_file);

                                $('#akte_wanita_manual').prop('disabled', true).closest('.col-sm-6').hide(); // just in case hehe
                            } else {
                                // jika umat belum upload akte
                                $('#akte_wanita_manual').prop('disabled', false).closest('.col-sm-6').show();
                                $akteOtomatiswanitaWrapper.hide();
                                $akteOtomatiswanita.prop('disabled', true);
                                $akteOtomatiswanita.val('');
                            }


                            // matikan agama
                            $('#agama_wanita').prop('disabled', true).closest('.col-sm-6').hide();

                            // matikan lingkungan manual kalau menyala
                            $lingkunganTextwanitaWrapper.hide();
                            $lingkunganManualwanita.prop('disabled', true);

                            $message.text('Data berhasil ditemukan dan telah diisikan otomatis.');
                        }

                        // an attempt to make modal aria safe wkwk
                        $modal.attr('aria-hidden', 'false');
                        if (!$modal.hasClass('show')) {
                            $modal.modal('show');
                        }
                    }
                });
            });
        });
    </script>
@endpush
