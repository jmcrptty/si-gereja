@extends('layouts.app')
@section('title', 'Laporan Data Sakramen')

@section('content')
<div class="px-4 container-fluid">
    <h1 class="mt-4">Laporan Penerimaan Sakramen</h1>
    <ol class="mb-4 breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route(auth()->user()->role === 'pastor paroki' ? 'pastorparoki.dashboard' : 'sekretaris.dashboard') }}">Dashboard</a>
        </li>

        <li class="breadcrumb-item active">Laporan Sakramen</li>
    </ol>

    <!-- Summary Card -->
    <div class="mb-4 row">
        <div class="col-xl-12">
            <div class="text-white shadow card bg-primary h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Total Penerimaan Sakramen</div>
                            <div class="text-lg fw-bold">
                                {{ $sakramen_id ? optional($sakramen_list->firstWhere('id', $sakramen_id))->nama_sakramen : 'Semua Sakramen' }}
                                Tahun {{ $year }}
                            </div>
                        </div>
                        <div>
                            <h1 class="mb-0 display-4">{{ $totalPenerimaan }}</h1>
                            <div class="small text-white-75">Penerimaan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<!-- Filter Section -->
<div class="mb-4 card">
    <div class="card-header">
        <div class="row gy-2 gx-3 align-items-center justify-content-between">
            <!-- Label -->
            <div class="col-12 col-lg-auto">
                <div class="d-flex align-items-center filter-label">
                    <i class="fas fa-filter me-2"></i>
                    <strong>Filter Data</strong>
                </div>
            </div>

            <!-- Form -->
            <div class="col">
                <form 
                    action="{{ route(auth()->user()->role === 'pastor paroki' ? 'pastorparoki.laporan.sakramen' : 'sekretaris.laporan.sakramen') }}" 
                    method="GET"
                    class="row gx-2 gy-2 align-items-center justify-content-start flex-lg-nowrap flex-wrap">

                    <!-- Sakramen -->
                    <div class="col-12 col-md-auto">
                        <select name="sakramen_id" class="form-select form-select-auto" onchange="this.form.submit()">
                            <option value="">Semua Sakramen</option>
                            @foreach($sakramen_list as $s)
                                <option value="{{ $s->id }}" {{ $sakramen_id == $s->id ? 'selected' : '' }}>
                                    {{ $s->nama_sakramen }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tahun -->
                    <div class="col-12 col-md-auto">
                        <select name="year" class="form-select form-select-auto" onchange="this.form.submit()">
                            @for($y = date('Y'); $y >= 2020; $y--)
                                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <!-- Pencarian -->
                    <div class="col-12 col-md">
                        <div class="input-group">
                            <input type="text"
                                   name="search"
                                   class="form-control"
                                   placeholder="Cari umat..."
                                   value="{{ $search }}">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




    <!-- Data Table -->
    <div class="mb-4 card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Penerimaan Sakramen

            <a href="#" class="btn btn-danger float-end" data-bs-toggle="modal" data-bs-target="#modalDownloadSakramenPDF">
                <i class="fas fa-file-pdf me-1"></i> Download PDF
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Lingkungan</th>
                            <th>Sakramen</th>
                            <th>Tanggal Terima</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{ dd($penerimaan->get(2)->umat_id) }} --}}
                        @forelse($penerimaan as $index => $data)
                            <tr>
                                <td>{{ $penerimaan->firstItem() + $index }}</td>
                                <td>{{ $data->nama_lengkap }}</td>
                                <td>{{ $data->lingkungan }}</td>
                                <td>{{ $data->nama_sakramen }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal_terima)->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    @php $sakramen = strtolower($data->nama_sakramen); @endphp

                                    @if($sakramen === 'baptis')
                                        <a href="{{ route('sekretaris.detailBaptis.penerimaan', ['umat' => $data->umat_id]) }}"
                                        class="badge bg-primary"><i class="fa fa-eye"></i></a>
                                    @elseif($sakramen === 'komuni')
                                        <a href="{{ route('sekretaris.detailKomuni', ['umat' => $data->umat_id]) }}"
                                        class="badge bg-primary"><i class="fa fa-eye"></i></a>
                                    @elseif($sakramen === 'krisma')
                                        <a href="{{ route('sekretaris.detailKrisma', ['umat' => $data->umat_id]) }}"
                                        class="badge bg-primary"><i class="fa fa-eye"></i></a>
                                    @elseif($sakramen === 'pernikahan')
                                        <a href="{{ route('sekretaris.detailPernikahan', $data->umat_id) }}" class="badge bg-primary" title="Lihat">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    Tidak ada data penerimaan sakramen untuk periode ini
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($penerimaan->hasPages())
                <div class="mt-3">
                    {{ $penerimaan->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="modalDownloadSakramenPDF" tabindex="-1" aria-labelledby="modalLabelSakramen" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabelSakramen">Konfirmasi Download</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Yakin ingin mengunduh laporan sakramen tahun {{ $year }}?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
       @php
            $role = Auth::user()->role;
            $routePrefix = $role === 'sekretaris' ? 'sekretaris' : 'pastorparoki';
        @endphp

        <form id="formDownloadSakramenPDF"
            action="{{ route($routePrefix . '.laporan.sakramen.download') }}"
            method="POST"
            target="_blank"
            onsubmit="closeModalSakramen()">
            @csrf
            <input type="hidden" name="year" value="{{ $year }}">
            <input type="hidden" name="search" value="{{ $search }}">
            <input type="hidden" name="sakramen_id" value="{{ $sakramen_id }}">
            <button type="submit" class="btn btn-primary">Ya, Unduh</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    function closeModalSakramen() {
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalDownloadSakramenPDF'));
        if (modal) {
            modal.hide();
        }
    }
</script>
<style>
/* Ukuran Select Responsif */
.form-select-auto {
  width: auto;
  min-width: 160px;
  max-width: 100%;
}

/* Label jarak bawah di tablet dan bawah */
@media (max-width: 991.98px) {
  .filter-label {
    margin-bottom: 0.5rem;
  }

  .form-select-auto {
    width: 100%; /* Select full width di tablet */
  }
}

/* Mobile First - form vertikal di layar kecil */
@media (max-width: 576px) {
  .card-header form {
    flex-direction: column !important;
    align-items: stretch !important;
    gap: 0.75rem;
  }

  .dropdown-menu {
    width: 100%;
    font-size: 1rem;
  }

  .dropdown-item {
    padding: 12px 20px;
  }
}

</style>


@endsection
