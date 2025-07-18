@extends('layouts.app')

@section('title', 'Informasi Misa')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-light py-3">
            <h2 class="text-center mb-0">UPDATE JADWAL MISA</h2>
        </div>
        
        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form id="misaForm" method="POST" action="{{ route('sekretaris.informasi_misa.update', $default->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="jenis_misa" class="form-label">Jenis Misa</label>
                    <select id="jenis_misa" name="jenis_misa" class="form-select">
                        <option value="Harian" {{ $default->jenis_misa == 'Harian' ? 'selected' : '' }}>Misa Harian</option>
                        <option value="Jumat_Pertama" {{ $default->jenis_misa == 'Jumat Pertama' ? 'selected' : '' }}>Misa Jumat Pertama</option>
                        <option value="Minggu" {{ $default->jenis_misa == 'Minggu' ? 'selected' : '' }}>Misa Minggu</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jadwal_misa" class="form-label">Jadwal Misa</label>
                    <input type="text" name="jadwal_misa" id="jadwal_misa" 
                           class="form-control" value="{{ $default->jadwal_misa ?? '' }}" required>
                    <small class="form-text text-muted">Contoh: 06:00 WIT, 17:00 WIT</small>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('jenis_misa').addEventListener('change', function () {
    let jenis = this.value;

    fetch(`{{ url("/sekretaris/informasi-misa/get-by-jenis") }}/${jenis}`)
        .then(res => res.json())
        .then(data => {
            if (data.id) {
                document.getElementById('jadwal_misa').value = data.jadwal_misa || '';
                document.getElementById('misaForm').action = `/sekretaris/informasi-misa/${data.id}`;
            } else {
                alert("Jadwal misa tidak ditemukan.");
            }
        })
        .catch(() => alert("Gagal memuat data."));
});
</script>
@endsection