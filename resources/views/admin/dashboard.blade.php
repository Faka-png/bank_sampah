@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<div class="d-flex">
    <div class="sidebar d-none d-lg-block">
        <div class="p-4">
            <h4 class="fw-bold m-0 text-success">🍃 HARVEST</h4>
            <small class="text-muted text-uppercase" style="font-size: 10px; letter-spacing: 1px;">Bank Sampah</small>
        </div>
        
        <ul class="nav flex-column mt-3">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                    📊 Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.warga') }}">
                    👥 Data Warga
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.sampah') }}">
                    ♻️ Jenis Sampah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.transaksi') }}">
                    💸 Transaksi
                </a>
            </li>
        </ul>

        <div class="mx-3 p-3 bg-success rounded-3 text-center text-white" style="margin-top: 50px; background-color: #1e5245 !important;">
            <p class="small mb-2">Butuh rekap data cetak?</p>
            <button class="btn btn-light btn-sm w-100 fw-bold text-success">+ Unduh Laporan</button>
        </div>

        <a class="logout-btn" href="{{ route('logout') }}" onclick="return confirm('Apakah Anda yakin ingin logout?')">
            🚪 LOG OUT
        </a>
    </div>

    <div class="main-content flex-grow-1">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <input type="text" class="search-bar" placeholder="Cari data warga atau transaksi...">
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted">🔔</span>
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-secondary rounded-circle" style="width: 35px; height: 35px; background: url('https://via.placeholder.com/150') center/cover;"></div>
                    <div>
                        <p class="mb-0 fw-bold small text-dark">Admin Utama</p>
                        <small class="text-muted d-block" style="font-size: 11px;">Bank Sampah Digital</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <h2 class="fw-bold text-dark mb-1">Selamat Datang di Bank Sampah Digital</h2>
            <p class="text-muted">Sistem monitoring pencatatan setor sampah warga secara real-time.</p>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-lg-4">
                <div class="custom-card">
                    <span class="text-muted small fw-bold d-block mb-3">TOTAL SAMPAH MASUK</span>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h2 class="fw-bold mb-0 text-dark">{{ number_format($hitung_berat, 1) }} <span class="fs-5 text-muted">Kg</span></h2>
                            <small class="text-success fw-semibold">▲ 9.3% Minggu ini</small>
                        </div>
                        <div class="circle-progress">
                            <div class="circle-content">
                                <span class="fw-bold text-dark d-block mb-0" style="font-size: 16px;">{{ number_format($hitung_berat, 0) }}</span>
                                <small class="text-muted" style="font-size: 10px;">Target Kg</small>
                            </div>
                        </div>
                    </div>
                    <hr class="text-muted opacity-25">
                    <div class="d-flex justify-content-between text-muted small">
                        <span>♻️ Organik: 40%</span>
                        <span>💎 Anorganik: 60%</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="custom-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted small fw-bold">SALDO TERDISTRIBUSI</span>
                        <span class="badge bg-light text-dark">Bulanan</span>
                    </div>
                    <h3 class="fw-bold text-success mb-2">Rp {{ number_format($hitung_saldo, 0, ',', '.') }}</h3>
                    <p class="text-muted small mb-3">Akumulasi dana tabungan nasabah aktif.</p>
                    <div style="height: 50px; background: linear-gradient(90deg, rgba(25,135,84,0.1) 0%, rgba(25,135,84,0.3) 100%); border-radius: 8px;" class="d-flex align-items-end p-1">
                        <div class="w-100 text-center text-success small fw-bold" style="font-size: 11px;">Tren Keuangan Stabil ↑</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="custom-card d-flex flex-column justify-content-between" style="background-color: #164237; color: #ffffff;">
                    <div>
                        <span class="text-white-50 small fw-bold d-block mb-2">TOTAL NASABAH AKTIF</span>
                        <h2 class="display-5 fw-bold m-0 text-white">{{ $hitung_warga }}</h2>
                        <p class="text-white-50 small mt-1">Warga terdaftar dalam sistem digital.</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top border-secondary">
                        <span class="small text-white-50">Sistem Bank Sampah v2.0</span>
                        <a href="{{ route('admin.warga') }}" class="btn btn-light btn-sm text-success fw-bold py-1 px-3" style="border-radius: 20px;">Lihat Warga</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="custom-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h5 class="fw-bold m-0 text-dark">Summary of Production</h5>
                            <small class="text-muted">Komparasi total sampah yang masuk per bulan</small>
                        </div>
                        <div class="d-flex gap-3 small">
                            <span class="fw-bold"><span class="text-success">■</span> Tahun Ini</span>
                            <span class="fw-bold text-muted"><span class="text-secondary">■</span> Tahun Lalu</span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-end pt-4 px-2" style="height: 200px;">
                        @foreach(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] as $key => $bulan)
                            @php 
                                // Simulasi tinggi bar statis sebagai placeholder visual agar mirip layout desain
                                $tinggi_bar = [20, 30, 45, 55, 65, 85, 75, 95, 80, 50, 40, 60][$key];
                            @endphp
                            <div class="d-flex flex-column align-items-center flex-grow-1 mx-1 mx-md-2">
                                <div class="w-100 d-flex flex-column justify-content-end align-items-center position-relative" style="height: 160px;">
                                    <div class="bg-success opacity-50 w-50 rounded-top mb-1" style="height: {{ $tinggi_bar }}%; background-color: #a3e635 !important;"></div>
                                    <div class="w-50 rounded-top" style="height: {{ max($tinggi_bar - 15, 10) }}%; background-color: #164237;"></div>
                                </div>
                                <span class="text-muted mt-2" style="font-size: 11px;">{{ $bulan }}</span>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection