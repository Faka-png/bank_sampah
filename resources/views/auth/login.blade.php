@extends('layouts.app')
@section('title', 'Login - Bank Sampah Digital')
@section('content')
<div class="bg-success-subtle d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="card border-0 shadow p-4" style="width: 100%; max-width: 400px;">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-success">🍃 Bank Sampah</h3>
            <p class="text-muted small">Silakan login untuk mengakses sistem</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger border-0 small shadow-sm">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login.proses') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-bold text-muted">Masuk Sebagai</label>
                <select name="role" class="form-select" required>
                    <option value="">-- Pilih Hak Akses --</option>
                    <option value="admin">Admin / Pengelola</option>
                    <option value="pengguna">Warga / Nasabah</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold text-muted">Username atau Email</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username/email" required>
            </div>
            <div class="mb-4">
                <label class="form-label small fw-bold text-muted">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-success w-100 py-2 fw-bold shadow-sm">Masuk Sistem</button>
        </form>
    </div>
</div>
@endsection