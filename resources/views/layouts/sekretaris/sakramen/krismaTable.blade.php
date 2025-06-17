<div class="shadow-sm card">
    <div class="card-header">
        Pendaftaran Sakramen Krisma
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>
                        <input type="checkbox"
                                id="selectAllCheckbox_{{ strtolower(str_replace(' ', '', 'dd')) }}"
                                class="form-check-input">
                    </th>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nomor HP</th>
                    <th>Email</th>
                    <th>Tanggal Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($krisma as $data_krisma)
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input selectRowCheckbox_{{ strtolower(str_replace(' ', '', 'dd')) }}">
                        </td>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data_krisma->umat->nama_lengkap }}</td>
                        <td>{{ $data_krisma->umat->no_hp }}</td>
                        <td>{{ $data_krisma->umat->email }}</td>
                        <td>{{ $data_krisma->tanggal_daftar}}</td>
                        <td>
                            <div class="flex-wrap gap-2 d-flex justify-content-center">
                                {{-- Lihat --}}
                                <a href="{{ route('sekretaris.detailKrisma', $data_krisma->umat->id) }}" class="border-0 badge bg-primary fs-6" title="Lihat" style="text-decoration: none">
                                    <i class="fa-solid fa-eye"></i> Lihat
                                </a>
                                {{-- Konfirmasi --}}
                                <button type="button" class="border-0 badge bg-success fs-6" data-bs-toggle="modal" data-bs-target="#confirmModalKrisma{{ $data_krisma->id }}">
                                    <i class="fa-solid fa-check"></i> Setujui
                                </button>

                                {{-- Tolak --}}
                                <button type="button" class="border-0 badge bg-danger fs-6" data-bs-toggle="modal" data-bs-target="#rejectModalLabelKrisma{{ $data_krisma->id }}">
                                    <i class="fa-solid fa-xmark"></i> Tolak
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Konfirmasi -->
                    <div class="modal fade" id="confirmModalKrisma{{ $data_krisma->id }}" tabindex="-1" aria-labelledby="confirmModalKrismaLabel{{ $data_krisma->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="border-0 shadow modal-content">
                                <div class="pb-0 border-0 modal-header">
                                    <h5 class="modal-title text-danger fw-bold" id="confirmModalKrismaLabel{{ $data_krisma->id }}">
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
                                    <h3 class="fw-semibold">Apakah Anda yakin ingin mengonfirmasi data <strong>{{ $data_krisma->umat->nama_lengkap }}</strong>?</h3>
                                </div>
                                <div class="pt-0 border-0 modal-footer justify-content-center">
                                    <form action="{{ route('sekretaris.setujuKrisma', $data_krisma->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="px-4 btn btn-success">Setujui</button>
                                    </form>
                                    <button type="button" class="px-4 btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="rejectModalLabelKrisma{{ $data_krisma->id }}" tabindex="-1" aria-labelledby="rejectModalLabelKrisma{{ $data_krisma->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="border-0 shadow modal-content">
                                <div class="pb-0 border-0 modal-header">
                                    <h5 class="modal-title text-danger fw-bold" id="rejectModalLabelKrisma{{ $data_krisma->id }}">
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
                                    <h3 class="fw-semibold">Apakah Anda yakin ingin menolak data <strong>{{ $data_krisma->umat->nama_lengkap }}</strong>?</h3>
                                </div>
                                <div class="pt-0 border-0 modal-footer justify-content-center">
                                    <form action="{{ route('sekretaris.tolakKrisma', $data_krisma->id) }}" method="POST" class="d-inline">
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
