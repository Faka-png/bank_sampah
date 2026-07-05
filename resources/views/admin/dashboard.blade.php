@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">🍃 Bank Sampah</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.warga') }}">Data Warga</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.sampah') }}">Jenis Sampah</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.transaksi') }}">Transaksi</a></li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger btn-sm text-white px-3 ms-lg-2" href="{{ route('logout') }}" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="p-5 bg-white rounded-3 shadow-sm">
                    <h1 class="display-6 fw-bold text-success">Selamat Datang di Bank Sampah Digital</h1>
                    <p class="col-md-8 fs-6 text-muted">Sistem monitoring dan pencatatan setor sampah warga secara real-time dan transparan.</p>
                </div>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm bg-primary text-white p-3">
                    <h3>{{ $hitung_warga }} Warga</h3>
                    <p class="mb-0 text-white-50">Total Nasabah Aktif</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm bg-warning text-dark p-3">
                    <h3>{{ number_format($hitung_berat, 2) }} Kg</h3>
                    <p class="mb-0 text-muted">Total Sampah Terkumpul</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm bg-success text-white p-3">
                    <h3>Rp {{ number_format($hitung_saldo, 0, ',', '.') }}</h3>
                    <p class="mb-0 text-white-50">Total Saldo Terdistribusi</p>
                </div>
            </div>
        </div>
    </div>
@endsection