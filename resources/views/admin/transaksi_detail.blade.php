<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi #{{ $master->id_transaksi }}</title>
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

        <div class="mb-4">
            <a href="{{ route('admin.transaksi') }}" class="btn btn-sm btn-light border rounded-pill px-3 fw-medium shadow-sm text-muted">
                ← Kembali ke Riwayat
            </a>
        </div>

        <div class="card border-0 rounded-4 p-4 p-md-5 shadow-sm bg-white">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-4 mb-4">
                <div>
                    <h4 class="fw-bold text-dark m-0">Nota Transaksi Penimbangan</h4>
                    <small class="text-muted">Data manifes setoran sampah digital warga terverifikasi</small>
                </div>
                <span class="badge px-3 py-2 rounded-pill fs-6 text-white" style="background-color: #0c231a;">Sukses</span>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-sm-6 col-md-3">
                    <small class="text-muted fw-bold d-block mb-1" style="font-size: 11px; letter-spacing: 0.5px;">ID TRANSAKSI</small>
                    <span class="fw-bold text-dark fs-5">#{{ $master->id_transaksi }}</span>
                </div>
                <div class="col-sm-6 col-md-3">
                    <small class="text-muted fw-bold d-block mb-1" style="font-size: 11px; letter-spacing: 0.5px;">TANGGAL</small>
                    <span class="fw-semibold text-dark">{{ date('d F Y', strtotime($master->tanggal)) }}</span>
                </div>
                <div class="col-sm-6 col-md-3">
                    <small class="text-muted fw-bold d-block mb-1" style="font-size: 11px; letter-spacing: 0.5px;">NAMA NASABAH</small>
                    <span class="fw-semibold text-dark">{{ $master->warga->nama ?? 'Tidak Diketahui' }}</span>
                </div>
                <div class="col-sm-6 col-md-3">
                    <small class="text-muted fw-bold d-block mb-1" style="font-size: 11px; letter-spacing: 0.5px;">EMAIL</small>
                    <span class="text-secondary text-truncate d-block">{{ $master->warga->email ?? '-' }}</span>
                </div>
            </div>

            <h5 class="fw-bold text-dark mb-3">Rincian Item Sampah</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr class="text-muted small" style="border-bottom: 2px solid #f4f7f5;">
                            <th class="pb-3 ps-0">JENIS SAMPAH</th>
                            <th class="pb-3 text-end">BERAT</th>
                            <th class="pb-3 text-end pe-0">SUBTOTAL SALDO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($details as $detail)
                            <tr style="border-bottom: 1px solid #f4f7f5;">
                                <td class="py-3 ps-0 fw-semibold text-dark">
                                    {{ $detail->jenisSampah->nama_sampah ?? 'Jenis Sampah Terhapus' }}
                                </td>
                                <td class="py-3 text-end fw-medium text-secondary">
                                    {{ $detail->berat }} Kg
                                </td>
                                <td class="py-3 text-end pe-0 fw-bold" style="color: #122c20;">
                                    Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="pt-4 ps-0 fw-bold text-dark">TOTAL RINGKASAN</td>
                            <td class="pt-4 text-end fw-bold text-dark fs-5">{{ $master->total_berat }} Kg</td>
                            <td class="pt-4 text-end pe-0 fw-extrabold fs-4" style="color: #122c20;">
                                Rp {{ number_format($master->total_saldo, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>