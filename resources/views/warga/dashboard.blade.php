@extends('layouts.app')
@section('title', 'Dashboard Nasabah')
@section('content')

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">

<style>
    body {
        background-color: #f4f7f5 !important;
        font-family: 'Inter', sans-serif !important;
    }
</style>

<div class="d-flex min-vh-100" style="margin: -24px;">

    <div class="d-none d-lg-flex flex-column justify-content-between p-4 position-fixed top-0 bottom-0 start-0" style="width: 260px; background-color: #0c231a; z-index: 1000;">
        <div>
            <div class="d-flex align-items-center gap-2 mb-5 text-white fw-bolder fs-5" style="letter-spacing: 1px;">
                Bank Sampah
            </div>
            
            <ul class="nav flex-column gap-1">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 fw-medium text-white" style="background-color: #153527; text-decoration: none;" href="#">
                        Dashboard Nasabah
                    </a>
                </li>
            </ul>
        </div>

        <div>
            <a class="d-flex align-items-center gap-2 px-2 text-decoration-none fw-bold" style="color: #8da296;" href="{{ route('logout') }}" onclick="return confirm('Apakah Anda yakin ingin logout?')">
                LOG OUT
            </a>
        </div>
    </div>

    <div class="flex-grow-1 p-4 p-md-5" style="margin-left: 260px;">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-5">
            <div>
                <h3 class="fw-bold text-dark m-0">Halo, {{ session('nama_warga') }}</h3>
                <small class="text-muted">Selamat datang di panel tabungan lingkungan Anda</small>
            </div>
            
            <div class="d-flex align-items-center justify-content-end gap-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 40px; height: 40px; background-color: #0c231a;">
                        {{ strtoupper(substr(session('nama_warga'), 0, 1)) }}
                    </div>
                    <div>
                        <p class="mb-0 fw-bold lh-1 text-dark" style="font-size: 14px;">{{ session('nama_warga') }}</p>
                        <small class="text-muted" style="font-size: 12px;">Anggota Nasabah Aktif</small>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">{{ session('success') }}</div>
        @endif
        
        @if(session('status') == 'sukses')
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                <strong>Setoran Berhasil!</strong> Data sampah telah dicatat dan saldo otomatis ditambahkan ke tabungan Anda.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card border-0 rounded-4 p-4 shadow-sm text-white" style="background-color: #0c231a;">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="text-white-50 fw-medium">Total Tabungan Anda</span>
                    </div>
                    <h2 class="fw-extrabold m-0">Rp {{ number_format($t_saldo, 0, ',', '.') }}</h2>
                    <small class="text-success fw-medium d-block mt-2">✓ Saldo siap ditukarkan/dicairkan</small>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card border-0 rounded-4 p-4 shadow-sm bg-white border">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="text-muted fw-medium">Total Sampah Disetor</span>
                    </div>
                    <h2 class="fw-extrabold text-dark m-0">{{ number_format($t_berat, 2) }} <span class="fs-5 fw-normal text-muted">Kg</span></h2>
                    <small class="text-muted d-block mt-2">Kontribusi hijau untuk bumi</small>
                </div>
            </div>
        </div>

        <div class="card border-0 rounded-4 p-4 shadow-sm bg-white">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold text-dark m-0">Riwayat Setoran Sampah</h4>
                    <small class="text-muted">Manifes log seluruh aktivitas timbangan mandiri Anda</small>
                </div>
                <button type="button" class="btn text-white shadow-sm btn-sm px-4 py-2 rounded-pill fw-medium" style="background-color: #0c231a;" data-bs-toggle="modal" data-bs-target="#modalSetorMandi">
                    + Setor Sampah Mandiri
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr class="text-muted small" style="border-bottom: 2px solid #f4f7f5;">
                            <th class="pb-3">TANGGAL</th>
                            <th class="pb-3">ID TRANSAKSI</th>
                            <th class="pb-3">TOTAL BERAT</th>
                            <th class="pb-3">SALDO MASUK</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayat as $t)
                            <tr style="border-bottom: 1px solid #f4f7f5;">
                                <td class="py-3 text-secondary">{{ date('d-m-Y', strtotime($t->tanggal)) }}</td>
                                <td class="py-3">
                                    <span class="badge px-3 py-2 rounded-3 text-dark bg-light fw-medium" style="border: 1px solid #e5e7eb;">
                                        #{{ $t->id_transaksi }}
                                    </span>
                                </td>
                                <td class="py-3 text-dark fw-medium">{{ $t->total_berat }} Kg</td>
                                <td class="py-3 fw-bold text-success">Rp {{ number_format($t->total_saldo, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-5">Belum ada riwayat setoran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="modalSetorMandi" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header text-white border-0 p-4" style="background-color: #0c231a; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                <h5 class="modal-title fw-bold">Form Setor Sampah Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('warga.setor') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Nama Penyetor</label>
                        <input type="text" class="form-control rounded-3 border-0 bg-light py-2" value="{{ session('nama') }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Kategori Sampah</label>
                        <select name="id_jenis" class="form-select rounded-3 py-2" required>
                            <option value="">-- Pilih Jenis Sampah Anda --</option>
                            @foreach($jenis_sampah as $s)
                                <option value="{{ $s->id_jenis }}">{{ $s->nama_sampah }} (Rp {{ number_format($s->harga_perkg, 0, ',', '.') }}/Kg)</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold text-muted">Berat Sampah (Kg)</label>
                        <div class="input-group">
                            <input type="number" step="0.01" name="berat" class="form-control rounded-start-3 py-2" placeholder="Contoh: 1.75" required>
                            <span class="input-group-text rounded-end-3 bg-light text-muted">Kg</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-4 fw-medium" style="background-color: #0c231a;">Simpan Setoran</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection