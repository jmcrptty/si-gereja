@extends('layouts.app')

@section('title', 'Forum Umat - Sekretaris')


@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4">Forum Umat</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Pertanyaan Belum Dijawab -->
    <div class="card mb-4">
        <div class="card-header bg-warning text-dark">
            <i class="fas fa-clock me-1"></i>
            Pertanyaan Belum Dijawab
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 15%">Nama</th>
                            <th>Pertanyaan</th>
                            <th style="width: 15%">Tanggal</th>
                            <th style="width: 15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($questions->whereNull('answer') as $index => $question)
                        <tr>
                            <td class="align-middle">{{ $questions->firstItem() + $index }}</td>
                            <td class="align-middle">{{ $question->name }}</td>
                            <td class="align-middle">{{ $question->question }}</td>
                            <td class="align-middle">{{ $question->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-center align-middle">
                                <button type="button" class="btn btn-success btn-sm me-1" 
                                        data-bs-toggle="modal" data-bs-target="#answerModal{{ $question->id }}"
                                        title="Jawab">
                                    <i class="fas fa-reply"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" 
                                        data-bs-toggle="modal" data-bs-target="#deleteModal{{ $question->id }}"
                                        title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-3">Tidak ada pertanyaan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pertanyaan Sudah Dijawab -->
    <div class="card">
        <div class="card-header bg-success text-white">
            <i class="fas fa-check-circle me-1"></i>
            Pertanyaan Sudah Dijawab
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 15%">Nama</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                            <th style="width: 15%">Tanggal</th>
                            <th style="width: 15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($questions->whereNotNull('answer') as $index => $question)
                        <tr>
                            <td class="align-middle">{{ $questions->firstItem() + $index }}</td>
                            <td class="align-middle">{{ $question->name }}</td>
                            <td class="align-middle">{{ $question->question }}</td>
                            <td class="align-middle">{{ $question->answer }}</td>
                            <td class="align-middle">{{ $question->answered_at->format('d/m/Y H:i') }}</td>
                            <td class="text-center align-middle">
                                <button type="button" class="btn btn-danger btn-sm" 
                                        data-bs-toggle="modal" data-bs-target="#deleteModal{{ $question->id }}"
                                        title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-3">Tidak ada pertanyaan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($questions->hasPages())
    <div class="mt-3">

        {{ $questions->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

<!-- Modal Jawab -->
@foreach($questions->whereNull('answer') as $question)
<div class="modal fade" id="answerModal{{ $question->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('sekretaris.forum.answer', $question->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Jawab Pertanyaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Pertanyaan:</strong><br>{{ $question->question }}</p>
                    <div class="form-group">
                        <label for="answer">Jawaban</label>
                        <textarea name="answer" class="form-control" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Hapus -->
@foreach($questions as $question)
<div class="modal fade" id="deleteModal{{ $question->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('sekretaris.forum.destroy', $question->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus pertanyaan dari <strong>{{ $question->name }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection