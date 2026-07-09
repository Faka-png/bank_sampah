<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi - Bank Sampah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
</head>
<body style="background-color: #f4f7f5; font-family: 'Inter', sans-serif;">

<div class="d-flex min-vh-100">

    <div class="d-none d-lg-flex flex-column justify-content-between p-4 position-fixed top-0 bottom-0 start-0" style="width: 260px; background-color: #0c231a; z-index: 1000;">
        <div>
            <div class="d-flex align-items-center gap-2 mb-5 text-white fw-bolder fs-5" style="letter-spacing: 1px;">
                Bank Sampah
            </div>
            
            <ul class="nav flex-column gap-1">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 fw-medium text-white-50" style="text-decoration: none;" href="{{ route('admin.dashboard') }}">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 fw-medium text-white-50" style="text-decoration: none;" href="{{ route('admin.warga') }}">
                        Data Warga
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 fw-medium text-white-50" style="text-decoration: none;" href="{{ route('admin.sampah') }}">
                        Jenis Sampah
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 fw-medium text-white" style="background-color: #153527; text-decoration: none;" href="{{ route('admin.transaksi') }}">
                        Transaksi
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
                <h3 class="fw-bold text-dark m-0">Halo, {{ session('nama_admin') }}</h3>
                <small class="text-muted">Selamat datang di panel tabungan lingkungan Anda</small>
            </div>
            
            <div class="d-flex align-items-center justify-content-end gap-4">
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

        <div class="d-flex justify-content-center">
            <div class="card border-0 rounded-4 p-4 p-md-5 shadow-sm bg-white w-100" style="max-width: 600px;">
                <div class="mb-4 text-center">
                    <h4 class="fw-bold text-dark m-0">Input Transaksi Baru</h4>
                    <small class="text-muted">Pencatatan setor sampah warga secara real-time dan transparan</small>
                </div>
                
                <form action="{{ route('admin.transaksi.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">ID Transaksi (Format: T00X)</label>
                        <input type="text" name="id_transaksi" class="form-control rounded-3" placeholder="Contoh: T001" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Pilih Warga / Nasabah</label>
                        <select name="id_warga" class="form-select rounded-3" required>
                            <option value="">-- Pilih Nasabah --</option>
                            @foreach($warga as $w)
                                <option value="{{ $w->id_warga }}">{{ $w->id_warga }} - {{ $w->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Tanggal Transaksi</label>
                        <input type="date" name="tanggal" class="form-control rounded-3" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Pilih Jenis Sampah</label>
                        <select name="id_jenis" class="form-select rounded-3" required>
                            <option value="">-- Pilih Jenis Sampah --</option>
                            @foreach($jenis_sampah as $j)
                                <option value="{{ $j->id_jenis }}">{{ $j->nama_sampah }} (Rp {{ number_format($j->harga_perkg,0,',','.') }}/kg)</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted">Berat Sampah (Kg)</label>
                        <input type="number" step="0.01" name="berat" class="form-control rounded-3" placeholder="Contoh: 5.5" required>
                    </div>

                    <div class="d-flex gap-3 pt-2">
                        <a href="{{ route('admin.transaksi') }}" class="btn btn-light w-50 rounded-pill fw-medium py-2">Kembali</a>
                        <button type="submit" class="btn text-white w-50 rounded-pill fw-medium py-2" style="background-color: #0c231a;">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>