@extends('layouts.app')
@section('title', 'Login - Bank Sampah Digital')
@section('content')

<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh; background-color: #f4f7f5;">
    <div class="card border-0 rounded-4 shadow-sm p-4 p-sm-5" style="width: 100%; max-width: 440px; background-color: #ffffff;">
        
        <div class="text-center mb-4">
            <h3 class="fw-bold text-dark m-0" style="letter-spacing: -0.5px;">Bank Sampah</h3>
            <p class="text-muted small mt-1">Silakan masuk untuk mengakses panel tabungan lingkungan</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger border-0 small rounded-3 shadow-sm d-flex align-items-center gap-2 mb-4" role="alert">
                <div class="fw-medium">{{ session('error') }}</div>
            </div>
        @endif

        <form action="{{ route('login.proses') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary text-uppercase mb-2" style="font-size: 11px; letter-spacing: 0.5px;">Masuk Sebagai</label>
                <select name="role" class="form-select border-1 py-25 rounded-3 text-dark fw-medium" style="border-color: #e5e7eb; font-size: 14px;" required>
                    <option value="" disabled selected>-- Pilih Hak Akses --</option>
                    <option value="admin">Admin / Pengelola</option>
                    <option value="pengguna">Warga / Nasabah</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary text-uppercase mb-2" style="font-size: 11px; letter-spacing: 0.5px;">Username atau Email</label>
                <input type="text" name="username" class="form-control border-1 py-25 rounded-3" style="border-color: #e5e7eb; font-size: 14px;" placeholder="Masukkan username atau email Anda" required>
            </div>
            
            <div class="mb-4">
                <label class="form-label small fw-bold text-secondary text-uppercase mb-2" style="font-size: 11px; letter-spacing: 0.5px;">Password</label>
                <input type="password" name="password" class="form-control border-1 py-25 rounded-3" style="border-color: #e5e7eb; font-size: 14px;" placeholder="••••••••" required>
            </div>
            
            <button type="submit" class="btn text-white w-100 py-25 rounded-pill fw-bold shadow-sm border-0 mt-2 text-uppercase" style="background-color: #0c231a; font-size: 13px; letter-spacing: 0.5px; transition: all 0.2s ease;">
                Masuk Sistem
            </button>
        </form>
        
        <div class="text-center mt-4 pt-2">
            <small class="text-muted" style="font-size: 11px;">&copy; 2026 Bank Sampah.</small>
        </div>
    </div>
</div>

@endsection