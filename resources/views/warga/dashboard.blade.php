@extends('layouts.app')
@section('title', 'Dashboard Nasabah')
@section('content')
    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">👋 Halo, {{ session('nama') }}</a>
            <div class="ms-auto">
                <a href="{{ route('logout') }}" class="btn btn-sm btn-light text-danger fw-bold" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
        @endif
        
        @if(session('status') == 'sukses')
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <strong>Setoran Berhasil!</strong> Data sampah telah dicatat dan saldo otomatis ditambahkan ke tabungan Anda.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <div class="card border-0 shadow-sm bg-primary text-white p-4">
                    <h5>Total Tabungan Anda</h5>
                    <h2 class="fw-bold">Rp {{ number_format($t_saldo, 0, ',', '.') }}</h2>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card border-0 shadow-sm bg-warning text-dark p-4">
                    <h5>Total Sampah Disetor</h5>
                    <h2 class="fw-bold">{{ number_format($t_berat, 2) }} Kg</h2>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-success m-0">Riwayat Setoran Sampah Anda</h5>
                <button type="button" class="btn btn-success shadow-sm btn-sm px-3" data-bs-toggle="modal" data-bs-target="#modalSetorMandi">
                    + Setor Sampah Mandiri
                </button>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-success text-dark">
                        <tr>
                            <th>Tanggal</th>
                            <th>ID Transaksi</th>
                            <th>Total Berat</th>
                            <th>Saldo Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayat as $t)
                        <tr>
                            <td>{{ $t->tanggal }}</td>
                            <td><span class='badge bg-dark'>{{ $t->id_transaksi }}</span></td>
                            <td>{{ $t->total_berat }} Kg</td>
                            <td class='text-success fw-bold'>Rp {{ number_format($t->total_saldo, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan='4' class='text-center text-muted py-3'>Belum ada riwayat setoran.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Form -->
    <div class="modal fade" id="modalSetorMandi" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold">Form Setor Sampah Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('warga.setor') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nama Penyetor</label>
                            <input type="text" class="form-control bg-light" value="{{ session('nama') }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Kategori Sampah</label>
                            <select name="id_jenis" class="form-select" required>
                                <option value="">-- Pilih Jenis Sampah Anda --</option>
                                @foreach($jenis_sampah as $s)
                                    <option value="{{ $s->id_jenis }}">{{ $s->nama_sampah }} (Rp {{ number_format($s->harga_perkg, 0, ',', '.') }}/Kg)</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Berat Sampah (Kg)</label>
                            <div class="input-group">
                                <input type="number" step="0.01" name="berat" class="form-control" placeholder="Contoh: 1.75" required>
                                <span class="input-group-text">Kg</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success px-4">Simpan Setoran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection