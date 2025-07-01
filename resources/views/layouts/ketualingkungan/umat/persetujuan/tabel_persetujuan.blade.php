<div class="mb-4 card">
    <div class="card-header bg-warning fw-bold">
        <i class="fas fa-table me-1"></i>
        Daftar umat yang menunggu verifikasi
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Lingkungan</th>
                    <th>Nomor Telpon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Lingkungan</th>
                    <th>Nomor Telpon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($umats as $umat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $umat->nama_lengkap }}</td>
                        <td>{{ $umat->lingkungan }}</td>
                        <td>{{ $umat->no_hp }}</td>
                        <td>{{ $umat->alamat }}</td>
                        <td>
                            <div class="flex-wrap gap-2 d-flex justify-content-center">
                                {{-- Lihat --}}
                                <a href="{{ route('ketualingkungan.umat.show', $umat->id) }}" class="border-0 badge bg-primary fs-6" title="Lihat" style="text-decoration: none">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                {{-- Konfirmasi --}}
                                <button type="button" class="border-0 badge bg-success fs-6" title="Setujui" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $umat->id }}">
                                    <i class="fa-solid fa-check"></i>
                                </button>

                                {{-- Tolak --}}
                                <button type="button" class="border-0 badge bg-danger fs-6" title="Tolak" data-bs-toggle="modal" data-bs-target="#rejectModalLabel{{ $umat->id }}">
                                    <i class="fa-solid fa-xmark"></i> 
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Konfirmasi -->
                    <div class="modal fade" id="confirmModal{{ $umat->id }}" tabindex="-1" aria-labelledby="confirmModalLabel{{ $umat->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="border-0 shadow modal-content">
                                <div class="pb-0 border-0 modal-header">
                                    <h5 class="modal-title text-danger fw-bold" id="confirmModalLabel{{ $umat->id }}">
                                        <i class="fas fa-exclamation-circle"></i> Konfirmasi Data
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="pt-0 text-center modal-body">
                                    <dotlottie-player
                                        src="https://lottie.host/73f09fa7-54a7-418a-ab54-1242df96a0d6/zaAzYRFgsU.lottie"
                                        background="transparent"
                                        speed="1"
                                        style="width: 200px; height: 200px; margin: 0 auto;"
                                        loop
                                        autoplay
                                    ></dotlottie-player>
                                    <h3 class="fw-semibold">Apakah Anda yakin ingin mengonfirmasi data <strong>{{ $umat->nama_lengkap }}</strong>?</h3>
                                </div>
                                <div class="pt-0 border-0 modal-footer justify-content-center">
                                    <form action="{{ route('ketualingkungan.umat.setuju', $umat->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="px-4 btn btn-success">Setujui</button>
                                    </form>
                                    <button type="button" class="px-4 btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="rejectModalLabel{{ $umat->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $umat->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="border-0 shadow modal-content">
                                <div class="pb-0 border-0 modal-header">
                                    <h5 class="modal-title text-danger fw-bold" id="rejectModalLabel{{ $umat->id }}">
                                        <i class="fas fa-exclamation-circle"></i> Konfirmasi Data
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="pt-0 text-center modal-body">
                                    <dotlottie-player
                                        src="https://lottie.host/73f09fa7-54a7-418a-ab54-1242df96a0d6/zaAzYRFgsU.lottie"
                                        background="transparent"
                                        speed="1"
                                        style="width: 200px; height: 200px; margin: 0 auto;"
                                        loop
                                        autoplay
                                    ></dotlottie-player>
                                    <h3 class="fw-semibold">Apakah Anda yakin ingin menolak data <strong>{{ $umat->nama_lengkap }}</strong>?</h3>
                                </div>
                                <div class="pt-0 border-0 modal-footer justify-content-center">
                                    <form action="{{ route('ketualingkungan.umat.tolak', $umat->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="px-4 btn btn-danger">Tolak</button>
                                    </form>
                                    <button type="button" class="px-4 btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
