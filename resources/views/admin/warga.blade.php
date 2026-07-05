<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Warga - Bank Sampah</title>
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
                    <li class="nav-item"><a class="nav-link active" href="{{ route('admin.warga') }}">Data Warga</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.sampah') }}">Jenis Sampah</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.transaksi') }}">Transaksi</a></li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger btn-sm text-white px-3 ms-lg-2" href="{{ route('logout') }}" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Notifikasi Error Validasi -->
        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm alert-dismissible fade show" role="alert">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Notifikasi Berhasil -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-success fw-bold m-0">Daftar Warga / Nasabah</h4>
                <button type="button" class="btn btn-success shadow-sm btn-sm" data-bs-toggle="modal" data-bs-target="#modalWarga">
                    + Tambah Warga
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-success">
                        <tr>
                            <th>ID Warga</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat</th>
                            <th>No. HP</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($warga as $row)
                            <tr>
                                <td><span class='badge bg-secondary'>{{ $row->id_warga }}</span></td>
                                <td class='fw-semibold'>{{ $row->nama }}</td>
                                <td>{{ $row->alamat }}</td>
                                <td>{{ $row->no_hp }}</td>
                                <td>{{ $row->email }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">Belum ada data warga.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Form Tambah Warga -->
    <div class="modal fade" id="modalWarga" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold">Form Tambah Warga</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.warga.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">ID Warga (Format: W00X)</label>
                            <input type="text" name="id_warga" class="form-control" value="{{ old('id_warga') }}" placeholder="Contoh: W004" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" placeholder="Nama lengkap warga" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="{{ old('alamat') }}" placeholder="Alamat tinggal" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">No. Handphone</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" placeholder="Contoh: 0812345..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="alamat@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Password Akun</label>
                            <input type="password" name="password" class="form-control" required>
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