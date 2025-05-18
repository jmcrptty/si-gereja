@extends('layouts.app')

@section('content')
    <main>
        <div class="px-4 container-fluid">
            <h1 class="mt-4">Tambah Umat</h1>
            <ol class="mb-4 breadcrumb">
                <li class="breadcrumb-item active">Tambah data umat baru</li>
            </ol>

            {{-- kartu --}}
            <div class="mb-4 card">
                {{-- header kartu --}}
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Umat
                </div>
                {{-- bodi kartu --}}
                <div class="card-body">
                    <form action="{{ route('umat.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error ('nama_lengkap')is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" placeholder="" value="{{ old('nama_lengkap') }}" required>
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="nomor_telpon" class="form-label">Nomor Telpon</label>
                                <input type="text" class="form-control @error ('nomor_telpon')is-invalid @enderror" id="nomor_telpon" name="nomor_telpon" placeholder="08xx 0000 0000" value="{{ old('nomor_telpon') }}" required>
                                @error('nomor_telpon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" class="form-control @error ('nik')is-invalid @enderror" id="nik" name="nik" placeholder="" value="{{ old('nik') }}" required>
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="lingkungan_id" class="form-label">Lingkungan</label>
                                <select type="text" class="form-control @error ('lingkungan_id')is-invalid @enderror" id="lingkungan_id" name="lingkungan_id" placeholder="" value="" required>
                                    <option selected value="">Pilih Lingkungan</option>
                                    @foreach ($lingkungans as $lingkungan)
                                        <option value="{{ $lingkungan->id }}">{{ $lingkungan->nama_lingkungan }}</option>
                                    @endforeach
                                </select>
                                @error('lingkungan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control @error ('alamat')is-invalid @enderror" id="alamat" name="alamat" placeholder="" value="{{ old('alamat') }}" required>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="jenis_kelamin" class="form-label">Lingkungan</label>
                                <select type="text" class="form-control @error ('jenis_kelamin')is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" placeholder="" value="" required>
                                    <option selected value="">Pilih Jenis Kelamin</option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control @error ('tempat_lahir')is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" placeholder="" value="{{ old('tempat_lahir') }}" required>
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control @error ('tanggal_lahir')is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="pendidikan" class="form-label">Pendidikan</label>
                                <select type="text" class="form-control @error ('pendidikan')is-invalid @enderror" id="pendidikan" name="pendidikan" placeholder="" value="" required>
                                    <option selected value="">Pilih Jenis Pendidikan</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                    <option value="Diploma">Diploma (D1, D2, D3)</option>
                                    <option value="Sarjana">Sarjana (S1)</option>
                                    <option value="Magister">Magister (S2)</option>
                                    <option value="Doktor">Doktor (S3)</option>
                                </select>
                                @error('pendidikan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="jenis_pekerjaan" class="form-label">Jenis Pekerjaan</label>
                                <input type="text" class="form-control @error ('jenis_pekerjaan')is-invalid @enderror" id="jenis_pekerjaan" name="jenis_pekerjaan" placeholder="" value="{{ old('jenis_pekerjaan') }}" required>
                                @error('jenis_pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="pt-1 mt-4"><h2>Status Sakramen Umat</h2></div>

                            <div class="col-sm-6">
                                <label for="status_hubungan" class="form-label">Status Hubungan</label>
                                <select type="text" class="form-control @error ('status_hubungan')is-invalid @enderror" id="status_hubungan" name="status_hubungan" placeholder="" value="" required>
                                    <option selected value="Belum Menikah">Belum Menikah</option>
                                    <option value="Menikah">Menikah</option>
                                </select>
                                @error('status_hubungan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="baptis" class="form-label">Pembaptisan</label>
                                <select type="text" class="form-control @error ('baptis')is-invalid @enderror" id="baptis" name="baptis" placeholder="" value="" required>
                                    <option selected value="0">Belum Baptis</option>
                                    <option value="1">Sudah Baptis</option>
                                </select>
                                @error('baptis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="komuni" class="form-label">Komuni</label>
                                <select type="text" class="form-control @error ('komuni')is-invalid @enderror" id="komuni" name="komuni" placeholder="" value="" required>
                                    <option selected value="0">Belum Komuni</option>
                                    <option value="1">Sudah Komuni</option>
                                </select>
                                @error('komuni')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="krisma" class="form-label">Krisma</label>
                                <select type="text" class="form-control @error ('krisma')is-invalid @enderror" id="krisma" name="krisma" placeholder="" value="" required>
                                    <option selected value="0">Belum Krisma</option>
                                    <option value="1">Sudah Krisma</option>
                                </select>
                                @error('krisma')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="pernikahan" class="form-label">Status Pernikahan</label>
                                <select type="text" class="form-control @error ('pernikahan')is-invalid @enderror" id="pernikahan" name="pernikahan" placeholder="" value="" required>
                                    <option selected value="0">Belum Menikah</option>
                                    <option value="1">Sudah Menikah</option>
                                </select>
                                @error('pernikahan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-5 button-group text-end">
                            <a href="{{ route('umat.index') }}" class="text-white border-0 rounded font-weight-bold btn btn-warning btn-lg">Kembali</a>

                            <button class="text-white border-0 rounded font-weight-bold btn bg-success btn-lg" type="submit">Tambah Umat</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>
@endsection
