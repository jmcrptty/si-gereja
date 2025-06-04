<div class="mb-4 card">
    <div class="card-header bg-danger fw-bold">
        <i class="fas fa-table me-1"></i>
        Daftar umat yang ditolak
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="simple-dt">
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
                @foreach ($umats_tolak as $umat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $umat->nama_lengkap }}</td>
                        <td>{{ $umat->lingkungan }}</td>
                        <td>{{ $umat->no_hp }}</td>
                        <td>{{ $umat->alamat }}</td>
                        <td>
                            <div class="flex-wrap gap-2 d-flex justify-content-center">
                                {{-- Delete --}}
                                <form action="{{ route('ketualingkungan.umat.destroy', $umat->id) }}" method="POST" onsubmit="return confirm('Apakah ingin menghapus data {{ $umat->nama_lengkap }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="border-0 badge bg-danger fs-6" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $umat->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Konfirmasi Hapus -->
                    <div class="modal fade" id="deleteModal{{ $umat->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $umat->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="border-0 shadow modal-content">
                                <div class="pb-0 border-0 modal-header">
                                    <h5 class="modal-title text-danger fw-bold" id="deleteModalLabel{{ $umat->id }}">
                                        <i class="fas fa-exclamation-circle"></i> Konfirmasi Hapus
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="pt-0 text-center modal-body">
                                    <dotlottie-player
                                        src="https://lottie.host/73f09fa7-54a7-418a-ab54-1242df96a0d6/zaAzYRFgsU.lottie"
                                        background="transparent"
                                        speed="1"
                                        style="width: 200px; height: 200pxpx; margin: 0 auto;"
                                        loop
                                        autoplay
                                    ></dotlottie-player>
                                    <h3 class="fw-semibold">Apakah Anda yakin ingin menghapus <strong>{{ $umat->nama_lengkap }}</strong>?</h3>
                                </div>
                                <div class="pt-0 border-0 modal-footer justify-content-center">
                                    <form action="{{ route('ketualingkungan.umat.destroy', $umat->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 btn btn-danger">Hapus</button>
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
