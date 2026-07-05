<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Transaksi - Bank Sampah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">🍃 Bank Sampah</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.warga') }}">Data Warga</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.sampah') }}">Jenis Sampah</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('admin.transaksi') }}">Transaksi</a></li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger btn-sm text-white px-3 ms-lg-2" href="{{ route('logout') }}" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('status') == 'sukses')
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <strong>Berhasil!</strong> Transaksi baru telah berhasil disimpan.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-success fw-bold m-0">Riwayat Transaksi Penimbangan</h4>
                <a href="{{ route('admin.transaksi.create') }}" class="btn btn-success shadow-sm btn-sm">
                    + Tambah Transaksi
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-success">
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Nama Warga</th>
                            <th>Tanggal</th>
                            <th>Total Berat</th>
                            <th>Total Saldo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $row)
                            <tr>
                                <td><span class="badge bg-secondary">{{ $row->id_transaksi }}</span></td>
                                <td class="fw-semibold">{{ $row->warga->nama ?? 'Tidak Diketahui' }}</td>
                                <td>{{ date('d-m-Y', strtotime($row->tanggal)) }}</td>
                                <td>{{ $row->total_berat }} Kg</td>
                                <td class="text-success fw-bold">Rp {{ number_format($row->total_saldo, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('admin.transaksi.detail', $row->id_transaksi) }}" class="btn btn-outline-success btn-sm px-3">
                                        Detail
                                    </a>
                                    <!-- Jika id primary key di database Anda adalah 'id', ubah $row->id_transaksi menjadi $row->id -->
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">Belum ada riwayat transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>