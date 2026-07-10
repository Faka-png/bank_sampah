<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi - Bank Sampah</title>
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
                        <small class="text-muted" style="font-size: 12px;">Admin bank Sampah Aktif</small>
                    </div>
                </div>
            </div>
        </div>

        @if(session('status') == 'sukses')
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                <strong>Berhasil!</strong> Transaksi baru telah berhasil disimpan.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card border-0 rounded-4 p-4 shadow-sm bg-white">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold text-dark m-0">Riwayat Transaksi Penimbangan</h4>
                    <small class="text-muted">Pencatatan riwayat masuk data setoran timbangan nasabah aktif</small>
                </div>
                <a href="{{ route('admin.transaksi.create') }}" class="btn text-white shadow-sm btn-sm px-4 py-2 rounded-pill fw-medium" style="background-color: #0c231a; text-decoration: none;">
                    + Tambah Transaksi
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr class="text-muted small" style="border-bottom: 2px solid #f4f7f5;">
                            <th class="pb-3">ID TRANSAKSI</th>
                            <th class="pb-3">NAMA WARGA</th>
                            <th class="pb-3">TANGGAL</th>
                            <th class="pb-3">TOTAL BERAT</th>
                            <th class="pb-3">TOTAL SALDO</th>
                            <th class="pb-3 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $row)
                            <tr style="border-bottom: 1px solid #f4f7f5;">
                                <td class="py-3">
                                    <span class="badge px-3 py-2 rounded-3 text-dark bg-light fw-medium" style="border: 1px solid #e5e7eb;">
                                        #{{ $row->id_transaksi }}
                                    </span>
                                </td>
                                <td class="py-3 fw-semibold text-dark">{{ $row->warga->nama ?? 'Tidak Diketahui' }}</td>
                                <td class="py-3 text-secondary">{{ date('d-m-Y', strtotime($row->tanggal)) }}</td>
                                <td class="py-3 fw-medium text-dark">{{ $row->total_berat }} Kg</td>
                                <td class="py-3 fw-bold" style="color: #122c20;">Rp {{ number_format($row->total_saldo, 0, ',', '.') }}</td>
                                <td class="py-3 text-center">
                                    <a href="{{ route('admin.transaksi.detail', $row->id_transaksi) }}" class="btn btn-sm rounded-pill px-3 fw-medium btn-outline-secondary" style="font-size: 13px;">
                                        Detail Nota
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">Belum ada riwayat transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>