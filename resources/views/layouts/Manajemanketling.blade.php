@extends('layouts.app')

@section('title', 'Manajemen Ketua Lingkungan')

@section('content')
<div class="container-fluid py-4">

    <!-- Heading & Summary -->
    <div class="row mb-3">
        <div class="col">
            <h4 class="fw-bold text-primary mb-0">
                <i class="bi bi-people-fill me-1"></i> Manajemen Ketua Lingkungan
            </h4>
            <small class="text-muted">Kelola akun ketua lingkungan dalam sistem</small>
        </div>
        <div class="col-auto">
            <span class="badge bg-primary fs-6 px-3 py-2">Total: {{ $ketuas->count() }} Ketua</span>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Form Card -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <strong><i class="bi bi-person-plus me-2"></i>Tambah Akun Ketua Lingkungan</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('sekretaris.ketling.store') }}" method="POST" class="row g-3 align-items-center">
                @csrf

                <!-- Role (Hidden) -->
                <input type="hidden" name="role" value="ketua lingkungan">

                <!-- Nama -->
                <div class="col-md-4">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" placeholder="Nama Ketua" required>
                </div>

                <!-- Email -->
                <div class="col-md-4">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email Ketua" required>
                </div>

                <!-- Lingkungan -->
                <div class="col-md-4">
                    <label class="form-label">Lingkungan</label>
                    <input type="text" name="lingkungan" class="form-control" placeholder="Nama Lingkungan" required>
                </div>

                <!-- Password -->
                <div class="col-md-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <!-- Konfirmasi Password -->
                <div class="col-md-4">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi Password" required>
                </div>

                <div class="col-12 text-end mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-person-plus"></i> Tambah Akun
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <strong><i class="bi bi-table me-2"></i>Daftar Ketua Lingkungan</strong>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Lingkungan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ketuas as $i => $ketua)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $ketua->name }}</td>
                                <td>{{ $ketua->email }}</td>
                                <td>{{ $ketua->lingkungan }}</td>
                                <td class="text-center">
                                    <form method="POST" action="{{ route('sekretaris.ketling.destroy', $ketua->id) }}"
                                        onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada akun ketua lingkungan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
