@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <div class="card mb-4">
        <div class="card-body">
            Welcome to the dashboard! {{ Auth::user()->role }}
        </div>
    </div>
</div>
@endsection
