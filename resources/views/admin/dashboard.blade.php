@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
<div class="d-flex min-vh-100" style="background-color: #f4f7f5; font-family: 'Inter', sans-serif;">

    <div class="d-none d-lg-flex flex-column justify-content-between p-4 position-fixed top-0 bottom-0 start-0" style="width: 260px; background-color: #0c231a; z-index: 1000;">
        <div>
            <div class="d-flex align-items-center gap-2 mb-5 text-white fw-bolder fs-5" style="letter-spacing: 1px;">
                <span class="text-success">🍃</span> Bank Sampah
            </div>
            
            <ul class="nav flex-column gap-1">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 fw-medium text-white" style="background-color: #153527;" href="{{ route('admin.dashboard') }}">
                        <span class="fs-5">🎛️</span> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 fw-medium" style="color: #8da296;" href="{{ route('admin.warga') }}">
                        <span class="fs-5">👥</span> Data Warga
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 fw-medium" style="color: #8da296;" href="{{ route('admin.sampah') }}">
                        <span class="fs-5">♻️</span> Jenis Sampah
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 fw-medium" style="color: #8da296;" href="{{ route('admin.transaksi') }}">
                        <span class="fs-5">💸</span> Transaksi
                    </a>
                </li>
            </ul>
        </div>

        <div>
            <a class="d-flex align-items-center gap-2 px-2 text-decoration-none fw-bold text-danger" href="{{ route('logout') }}" onclick="return confirm('Apakah Anda yakin ingin logout?')">
                <span>🚪</span> LOG OUT
            </a>
        </div>
    </div>

    <div class="flex-grow-1 p-4 p-md-5" style="margin-left: 260px;">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-5">
            <div>
                <h3 class="fw-bold text-dark m-0">👋 Halo, {{ session('nama_admin') }}</h3>
                <small class="text-muted">Selamat datang di panel tabungan lingkungan Anda</small>
            </div>
            
            <!-- Notifikasi & Profile Ringkas -->
            <div class="d-flex align-items-center justify-content-end gap-4">
                <span class="fs-5" style="cursor: pointer;">💬</span>
                <span class="fs-5" style="cursor: pointer;">🔔</span>
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 40px; height: 40px; background-color: #0c231a;">
                        {{ strtoupper(substr(session('nama_admin'), 0, 1)) }}
                    </div>
                    <div>
                        <p class="mb-0 fw-bold lh-1 text-dark" style="font-size: 14px;">{{ session('nama_admin') }}</p>
                        <small class="text-muted" style="font-size: 12px;">Anggota Nasabah Aktif</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-xl-4 col-md-6">
                <div class="card h-100 border-0 rounded-4 p-4 shadow-sm bg-white">
                    <span class="text-muted small fw-bold d-block mb-2">TOTAL SAMPAH TERKUMPUL</span>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h2 class="fw-bolder text-dark mb-0">{{ number_format($hitung_berat, 1) }} <span class="fs-5 text-muted fw-normal">Kg</span></h2>
                        </div>
                        
                        @php $derajat_progress = min(($hitung_berat / 500) * 360, 360); @endphp
                        <div class="position-relative d-flex align-items-center justify-content-center rounded-circle shadow-sm" 
                             style="width: 90px; height: 90px; background: conic-gradient(#0c231a {{ $derajat_progress }}deg, #e5e7eb 0deg);">
                            <div class="position-absolute bg-white rounded-circle" style="width: 70px; height: 70px; z-index: 1;"></div>
                            <div class="position-relative text-center" style="z-index: 2;">
                                <span class="fw-bold text-dark d-block lh-1" style="font-size: 14px;">{{ number_format(($hitung_berat/500)*100, 0) }}%</span>
                                <small class="text-muted" style="font-size: 9px;">Target</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card h-100 border-0 rounded-4 p-4 shadow-sm bg-white d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="text-muted small fw-bold">SALDO TERDISTRIBUSI</span>
                            <span class="badge bg-light text-dark rounded-pill border px-2 py-1" style="font-size: 10px;">Weekly</span>
                        </div>
                        <h3 class="fw-bolder text-dark mb-1">Rp {{ number_format($hitung_saldo, 0, ',', '.') }}</h3>
                        <p class="text-muted small mb-0">Total distribusi dana simpanan seluruh nasabah aktif terdaftar.</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-12">
                <div class="card h-100 border-0 rounded-4 p-4 shadow-sm text-white d-flex flex-column justify-content-between" style="background-color: #122c20;">
                    <div>
                        <span class="text-white-50 small fw-bold d-block mb-1">TOTAL NASABAH AKTIF</span>
                        <h2 class="display-6 fw-bold text-white mb-1">{{ $hitung_warga }} Warga</h2>
                        <p class="text-white-50 small mb-0">Sistem manajemen monitoring dan pencatatan sampah real-time.</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top border-secondary mt-4">
                        <small class="text-white-50">Nasabah Aktif</small>
                        <a href="{{ route('admin.warga') }}" class="btn btn-light btn-sm text-success fw-bold px-3 rounded-pill" style="font-size: 12px;">Lihat Warga</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection