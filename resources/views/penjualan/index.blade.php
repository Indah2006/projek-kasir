@extends('pages.dashboard')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e6f2ff;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        thead th {
            background-color: white !important;
            color: black !important;
            border: 1px solid #dee2e6 !important;
        }
        tbody td {
            border: 1px solid #dee2e6 !important;
        }
        .btn-primary {
            background-color: #1a75ff !important;
            border: none;
        }
        .btn-primary:hover {
            background-color: #005ce6 !important;
        }
        .btn-warning {
            background-color: #ffa726 !important;
            border: none;
        }
        .btn-warning:hover {
            background-color: #fb8c00 !important;
        }
        .btn-danger {
            background-color: #e53935 !important;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c62828 !important;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center" style="color: #1a75ff;">📜 Daftar Transaksi Penjualan</h1>
        
        <a href="{{ route('penjualan.create') }}" class="btn btn-primary mb-3">Tambah Penjualan</a>

        @if (session('success'))
            <div class="alert alert-success" id="success-message">
                ✅ {{ session('success') }}
            </div>
        @endif

        <table class="table text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Penjualan</th>
                    <th>Total Harga</th>
                    <th>Nama Pelanggan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualans as $penjualan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $penjualan->TanggalPenjualan }}</td>
                        <td>Rp {{ number_format($penjualan->TotalHarga, 0, ',', '.') }}</td>
                        <td>{{ $penjualan->pelanggan->NamaPelanggan ?? 'Tidak Diketahui' }}</td>
                        <td>
                            <a href="{{ route('penjualan.struk', $penjualan->Penjualanid) }}" class="btn btn-info btn-sm">📄 Lihat Struk</a>
                            <form action="{{ route('penjualan.destroy', $penjualan->Penjualanid) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Pindahkan ke Tong Sampah?')">
                                    🗑️ 
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if(isset($penjualan_detail))
    <!-- Struk Penjualan -->
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h2>🧾 Struk Transaksi Penjualan</h2>
            </div>
            <div class="card-body">
                <p><strong>ID Transaksi:</strong> {{ $penjualan_detail->Penjualanid }}</p>
                <p><strong>Tanggal:</strong> {{ $penjualan_detail->TanggalPenjualan }}</p>
                <p><strong>Nama Pelanggan:</strong> {{ $penjualan_detail->pelanggan->NamaPelanggan ?? 'Tidak Diketahui' }}</p>
                <p><strong>Total Harga:</strong> <span class="badge bg-success">Rp {{ number_format($penjualan_detail->TotalHarga, 0, ',', '.') }}</span></p>
                <hr>
                <p class="text-center">Terima kasih telah berbelanja! 😊</p>
            </div>
        </div>
        <div class="text-center mt-3">
            <button onclick="window.print()" class="btn btn-primary">🖨️ Cetak Struk</button>
            <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">🔙 Kembali</a>
        </div>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.onload = function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.opacity = '0';
                    setTimeout(() => successMessage.style.display = 'none', 500);
                }, 2000);
            }
        };
    </script>
</body>
</html>
@endsection
