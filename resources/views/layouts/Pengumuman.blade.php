@extends('layouts.app')

@section('title', 'Pengumuman')

<!-- Trix Editor CDN -->
<link rel="stylesheet" href="https://unpkg.com/trix@1.3.1/dist/trix.css">
<script src="https://unpkg.com/trix@1.3.1/dist/trix.js"></script>

@section('content')
<div class="container py-5">
    <div class="card shadow-sm">
       <div class="card-header bg-light py-3">
    <h2 class= "text-center mb-4">UPADATE PENGUMUMAN PAROKI</h2>
       </div>
    <div class="card-body p-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form id="pengumumanForm" method="POST" enctype="multipart/form-data"
        action="{{ $default ? route('sekretaris.pengumuman.update', $default->id) : '#' }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="jenis_pengumuman" class="form-label">Jenis Pengumuman</label>
            <select id="jenis_pengumuman" name="jenis_pengumuman" class="form-select">
                <option value="Mingguan" {{ $default && $default->jenis_pengumuman == 'Mingguan' ? 'selected' : '' }}>Mingguan</option>
                <option value="Laporan_Keuangan" {{ $default && $default->jenis_pengumuman == 'Laporan_Keuangan' ? 'selected' : '' }}>Laporan Keuangan</option>
                <option value="Pengumuman_Lainnya" {{ $default && $default->jenis_pengumuman == 'Pengumuman_Lainn    ya' ? 'selected' : '' }}>Pengumuman Lainya</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $default->title ?? '' }}" required>
        </div>

        <div class="mb-3">
            <label for="sub" class="form-label">Sub Judul</label>
            <textarea name="sub" id="sub" class="form-control">{{ $default->sub ?? '' }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar (opsional)</label>
            <input type="file" name="image" id="image" class="form-control">
            <div class="mt-2 image-container">
                <!-- Gambar yang ada saat ini akan muncul di sini -->
                @if($default && $default->image)
    <strong>Gambar Saat Ini:</strong><br>
    <!-- Menggunakan Storage::url untuk mendapatkan URL gambar yang benar -->
    <img src="{{ Storage::url('private/pengumuman_images/' . $default->image) }}" alt="Gambar Pengumuman" style="max-height: 200px;">
@endif
            </div>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Isi Pengumuman</label>
            <input id="content" type="hidden" name="content" value="{{ $default->content ?? '' }}">
            <trix-editor input="content"></trix-editor>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
</div>
</div>

<script>
document.getElementById('jenis_pengumuman').addEventListener('change', function () {
    let jenis = this.value;

    fetch('{{ url("/sekretaris/pengumuman/get-by-jenis") }}/' + jenis)
        .then(res => res.json())
        .then(data => {
            if (data.id) {
                // Update title, sub, and content
                document.getElementById('title').value = data.title || '';
                document.getElementById('sub').value = data.sub || '';
                document.getElementById('content').value = data.content || '';
                document.querySelector("trix-editor").editor.loadHTML(data.content || '');
                document.getElementById('pengumumanForm').action = `/sekretaris/pengumuman/${data.id}`;

                // Menampilkan gambar jika ada
                if (data.image_url) {
                    const imageContainer = document.querySelector('.image-container');
                    imageContainer.innerHTML = `
                        <strong>Gambar Saat Ini:</strong><br>
                        <img src="${data.image_url}" alt="Gambar Pengumuman" style="max-height: 200px;">
                    `;
                }
            } else {
                alert("Pengumuman tidak ditemukan.");
            }
        })
        .catch(() => alert("Gagal memuat data."));
});
</script>
@endsection
