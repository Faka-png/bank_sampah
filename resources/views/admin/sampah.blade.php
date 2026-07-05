<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jenis Sampah - Bank Sampah</title>
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
                    <li class="nav-item"><a class="nav-link active" href="{{ route('admin.sampah') }}">Jenis Sampah</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.transaksi') }}">Transaksi</a></li>
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
                <strong>Berhasil!</strong> Jenis sampah baru berhasil ditambahkan.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-success fw-bold m-0">Daftar Jenis Sampah</h4>
                <button type="button" class="btn btn-success shadow-sm btn-sm" data-bs-toggle="modal" data-bs-target="#modalSampah">
                    + Tambah Jenis Sampah
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-success">
                        <tr>
                            <th>ID Jenis</th>
                            <th>Nama Sampah</th>
                            <th>Harga / Kg</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jenis_sampah as $row)
                            <tr>
                                <td><span class="badge bg-secondary">{{ $row->id_jenis }}</span></td>
                                <td class="fw-semibold">{{ $row->nama_sampah }}</td>
                                <td class="text-success fw-bold">Rp {{ number_format($row->harga_perkg, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">Belum ada data jenis sampah.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Form Tambah Sampah -->
    <div class="modal fade" id="modalSampah" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold">Form Tambah Jenis Sampah</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.sampah.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">ID Jenis (Format: J00X)</label>
                            <input type="text" name="id_jenis" class="form-control" placeholder="Contoh: J001" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nama Sampah</label>
                            <input type="text" name="nama_sampah" class="form-control" placeholder="Contoh: Plastik Bening" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Harga Per Kilogram (Rp)</label>
                            <input type="number" name="harga_perkg" class="form-control" placeholder="Contoh: 3000" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success px-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>