<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Transaksi - Bank Sampah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">🍃 Bank Sampah</a>
        </div>
    </nav>

    <div class="container" style="max-width: 600px;">
        <div class="card border-0 shadow-sm p-4">
            <h4 class="text-success fw-bold mb-4 text-center">Input Transaksi Baru</h4>
            
            <form action="{{ route('admin.transaksi.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">ID Transaksi (Format: T00X)</label>
                    <input type="text" name="id_transaksi" class="form-control" placeholder="Contoh: T001" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">Pilih Warga / Nasabah</label>
                    <select name="id_warga" class="form-select" required>
                        <option value="">-- Pilih Nasabah --</option>
                        @foreach($warga as $w)
                            <option value="{{ $w->id_warga }}">{{ $w->id_warga }} - {{ $w->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">Tanggal Transaksi</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">Pilih Jenis Sampah</label>
                    <select name="id_jenis" class="form-select" required>
                        <option value="">-- Pilih Jenis Sampah --</option>
                        @foreach($jenis_sampah as $j)
                            <option value="{{ $j->id_jenis }}">{{ $j->nama_sampah }} (Rp {{ number_format($j->harga_perkg,0,',','.') }}/kg)</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted">Berat Sampah (Kg)</label>
                    <input type="number" step="0.01" name="berat" class="form-control" placeholder="Contoh: 5.5" required>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.transaksi') }}" class="btn btn-light w-50">Kembali</a>
                    <button type="submit" class="btn btn-success w-50">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>