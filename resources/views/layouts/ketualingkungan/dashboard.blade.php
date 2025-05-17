@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-4">
       <h1 class="mt-4">Dashboard</h1>
    
    <div class="card mb-4 welcome-card">
        <div class="card-body">
            <h5 class="mb-0">Selamat Datang, {{ Auth::user()->name }}!</h5>
            <p class="text-muted mb-0">{{ Auth::user()->role }}</p>
        </div>
    </div>
</div>
@endsection
