@extends('layouts.app')

@section('title', 'Manajemen Akun')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="border-0 shadow-sm card rounded-3">
                <div class="py-4 text-white card-header" style="background-color: var(--primary-dark);">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-person-plus me-3" style="font-size: 1.5rem;"></i>
                        <div>
                            <h4 class="mb-1">Edit Detail Akun</h4>
                            <p class="mb-0 opacity-75">Perbarui informasi akun ketua lingkungan</p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('ketualingkungan.store.edit.akun') }}" method="POST" class="row g-3 align-items-center">
                        @csrf

                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">

                        <div class="col-md-4">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Ketua" value="{{ $ketling->name }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email Ketua" value="{{ $ketling->email }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Lingkungan</label>
                            <input type="email" disabled class="form-control" placeholder="Lingkungan Ketua" value="{{ $ketling->lingkungan }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan password baru">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi Password">
                        </div>

                        <div class="mt-3 col-12 text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-person-plus"></i> Update Akun
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

    .form-control:focus {
        border-color: var(--accent-gold);
        box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.15);
    }

    .btn:hover {
        opacity: 0.9;
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }

    .alert {
        border: none;
        border-radius: 10px;
        margin-bottom: 1rem;
    }

    .alert-success {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        color: #155724;
    }
</style>
@endsection
