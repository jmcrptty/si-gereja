<div class="shadow-sm card">
    <div class="card-header">
        Pendaftaran Sakramen Pernikahan
    </div>
    <div class="card-body">
        <div class="table-responsive"> {{-- Tambahan responsif --}}
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>
                            <input type="checkbox"
                                id="selectAllCheckbox_{{ strtolower(str_replace(' ', '', 'dd')) }}"
                                class="form-check-input">
                        </th>
                        <th>No</th>
                        <th>Nama Calon Pria</th>
                        <th>Nama Calon Wanita</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pernikahan as $data_pernikahan)
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input selectRowCheckbox_{{ strtolower(str_replace(' ', '', 'dd')) }}">
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data_pernikahan->nama_lengkap_pria }}</td>
                            <td>{{ $data_pernikahan->nama_lengkap_wanita }}</td>
                            <td>{{ $data_pernikahan->tanggal_daftar->format('d M Y')}}</td>
                            <td>
                                <div class="flex-wrap gap-2 d-flex justify-content-center">
                                    {{-- Lihat --}}
                                    <a href="{{ route('sekretaris.detailPernikahan', $data_pernikahan->id) }}" class="border-0 badge bg-primary fs-6" title="Lihat" style="text-decoration: none">
                                        <i class="fa-solid fa-eye"></i> 
                                    </a>
                                    {{-- Konfirmasi --}}
                                    <button type="button" class="border-0 badge bg-success fs-6" data-bs-toggle="modal" data-bs-target="#confirmModalPernikahan{{ $data_pernikahan->id }}">
                                        <i class="fa-solid fa-check"></i> 
                                    </button>
                                    {{-- Tolak --}}
                                    <button type="button" class="border-0 badge bg-danger fs-6" data-bs-toggle="modal" data-bs-target="#rejectModalLabelPernikahan{{ $data_pernikahan->id }}">
                                        <i class="fa-solid fa-xmark"></i> 
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- Modal Setujui --}}
                        <div class="modal fade" id="confirmModalPernikahan{{ $data_pernikahan->id }}" tabindex="-1" aria-labelledby="confirmModalPernikahanLabel{{ $data_pernikahan->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="border-0 shadow modal-content">
                                    <div class="pb-0 border-0 modal-header">
                                        <h5 class="modal-title text-danger fw-bold" id="confirmModalPernikahanLabel{{ $data_pernikahan->id }}">
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
                                        <h3 class="fw-semibold">Apakah Anda yakin ingin mengonfirmasi data pernikahan ini?</h3>
                                    </div>
                                    <div class="pt-0 border-0 modal-footer justify-content-center">
                                        <form action="{{ route('sekretaris.setujuPernikahan', $data_pernikahan->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="px-4 btn btn-success">Setujui</button>
                                        </form>
                                        <button type="button" class="px-4 btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Modal Tolak --}}
                        <div class="modal fade" id="rejectModalLabelPernikahan{{ $data_pernikahan->id }}" tabindex="-1" aria-labelledby="rejectModalLabelPernikahan{{ $data_pernikahan->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="border-0 shadow modal-content">
                                    <div class="pb-0 border-0 modal-header">
                                        <h5 class="modal-title text-danger fw-bold" id="rejectModalLabelPernikahan{{ $data_pernikahan->id }}">
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
                                        <h3 class="fw-semibold">Apakah Anda yakin ingin menolak data pernikahan ini?</h3>
                                    </div>
                                    <div class="pt-0 border-0 modal-footer justify-content-center">
                                        <form action="{{ route('sekretaris.tolakPernikahan', $data_pernikahan->id) }}" method="POST" class="d-inline">
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
        </div> {{-- End table-responsive --}}
    </div>
</div>
