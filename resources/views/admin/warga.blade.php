<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga - Bank Sampah</title>
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
                    <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 fw-medium text-white" style="background-color: #153527; text-decoration: none;" href="{{ route('admin.warga') }}">
                        Data Warga
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 fw-medium text-white-50" style="text-decoration: none;" href="{{ route('admin.sampah') }}">
                        Jenis Sampah
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 rounded-3 fw-medium text-white-50" style="text-decoration: none;" href="{{ route('admin.transaksi') }}">
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

        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm alert-dismissible fade show rounded-4 mb-4" role="alert">
                <ul class="m-0 small fw-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card border-0 rounded-4 p-4 shadow-sm bg-white">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold text-dark m-0">Daftar Warga / Nasabah</h4>
                    <small class="text-muted">Kelola data profil, alamat, dan informasi kontak nasabah aktif</small>
                </div>
                <button type="button" class="btn text-white shadow-sm btn-sm px-4 py-2 rounded-pill fw-medium" style="background-color: #0c231a;" data-bs-toggle="modal" data-bs-target="#modalWarga">
                    + Tambah Warga
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr class="text-muted small" style="border-bottom: 2px solid #f4f7f5;">
                            <th class="pb-3">ID WARGA</th>
                            <th class="pb-3">NAMA LENGKAP</th>
                            <th class="pb-3">ALAMAT</th>
                            <th class="pb-3">NO. HP</th>
                            <th class="pb-3">EMAIL</th>
                            <th class="pb-3 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($warga as $row)
                            <tr style="border-bottom: 1px solid #f4f7f5;">
                                <td class="py-3">
                                    <span class="badge px-3 py-2 rounded-3 text-dark bg-light fw-medium" style="border: 1px solid #e5e7eb;">
                                        {{ $row->id_warga }}
                                    </span>
                                </td>
                                <td class="py-3 fw-semibold text-dark">{{ $row->nama }}</td>
                                <td class="py-3 text-secondary">{{ $row->alamat }}</td>
                                <td class="py-3 text-dark fw-medium">{{ $row->no_hp }}</td>
                                <td class="py-3 text-secondary">{{ $row->email }}</td>
                                
                                <td class="py-3 text-center">
                                    <form action="{{ route('admin.warga.delete', $row->id_warga) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus warga {{ $row->nama }}? Semua data riwayat transaksi terkait mungkin akan ikut terpengaruh.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger rounded-3 p-2" title="Hapus Data" style="border: 1px solid #f3f4f6;">
                                            <span class="small fw-bold d-none d-md-inline-block ms-1">Hapus</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">Belum ada data warga.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="modalWarga" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header text-white border-0 p-4" style="background-color: #0c231a; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                <h5 class="modal-title fw-bold">Form Tambah Warga</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.warga.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">ID Warga (Format: W00X)</label>
                        <input type="text" name="id_warga" class="form-control rounded-3" value="{{ old('id_warga') }}" placeholder="Contoh: W004" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control rounded-3" value="{{ old('nama') }}" placeholder="Nama lengkap warga" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Alamat</label>
                        <input type="text" name="alamat" class="form-control rounded-3" value="{{ old('alamat') }}" placeholder="Alamat tinggal" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">No. Handphone</label>
                        <input type="text" name="no_hp" class="form-control rounded-3" value="{{ old('no_hp') }}" placeholder="Contoh: 0812345..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Email</label>
                        <input type="email" name="email" class="form-control rounded-3" value="{{ old('email') }}" placeholder="alamat@email.com" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold text-muted">Password Akun</label>
                        <input type="password" name="password" class="form-control rounded-3" required>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white rounded-pill px-4 fw-medium" style="background-color: #0c231a;">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>