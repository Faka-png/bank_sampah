<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi #{{ $master->id_transaksi }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">🍃 Bank Sampah</a>
        </div>
    </nav>

    <div class="container" style="max-width: 800px;">
        <div class="mb-3">
            <a href="{{ route('admin.transaksi') }}" class="btn btn-sm btn-outline-secondary">← Kembali ke Riwayat</a>
        </div>

        <!-- Nota Utama -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-success text-white p-3">
                <h5 class="card-title m-0 fw-bold">Nota Transaksi Penimbangan</h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <small class="text-muted d-block">ID TRANSAKSI</small>
                        <span class="fw-bold text-secondary">#{{ $master->id_transaksi }}</span>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block">TANGGAL</small>
                        <span class="fw-bold">{{ date('d F Y', strtotime($master->tanggal)) }}</span>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block">NAMA NASABAH / WARGA</small>
                        <span class="fw-bold">{{ $master->warga->nama ?? 'Tidak Diketahui' }}</span>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block">EMAIL</small>
                        <span>{{ $master->warga->email ?? '-' }}</span>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Rincian Item Sampah -->
                <h6 class="fw-bold text-success mb-3">Rincian Item Sampah</h6>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Jenis Sampah</th>
                                <th class="text-end">Berat</th>
                                <th class="text-end">Subtotal Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($details as $detail)
                                <tr>
                                    <td class="fw-semibold">{{ $detail->jenisSampah->nama_sampah ?? 'Jenis Sampah Terhapus' }}</td>
                                    <td class="text-end">{{ $detail->berat }} Kg</td>
                                    <td class="text-end text-success fw-bold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light fw-bold">
                            <tr>
                                <td>TOTAL RINGKASAN</td>
                                <td class="text-end">{{ $master->total_berat }} Kg</td>
                                <td class="text-end text-success fs-5">Rp {{ number_format($master->total_saldo, 0, ',', '.') }}</td>
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