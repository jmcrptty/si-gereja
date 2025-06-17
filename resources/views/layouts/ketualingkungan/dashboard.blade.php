@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="px-4 container-fluid">
       <h1 class="mt-4">Dashboard</h1>

    <div class="mb-4 card welcome-card">
        <div class="card-body">
            <h5 class="mb-0">Selamat Datang, {{ Auth::user()->name }}!</h5>
            <p class="mb-0 text-muted">{{ Auth::user()->role }}</p>
        </div>
    </div>
</div>
@endsection
