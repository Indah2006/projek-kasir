@extends('pages.dashboard')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan</title>
    <!-- Menambahkan Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e6f2ff; /* Latar belakang biru muda */
        }
        .btn-success {
            background-color: #66b2ff !important; /* Warna biru cerah */
            border-color: #66b2ff !important;
        }
        .btn-success:hover {
            background-color: #3385ff !important;
            border-color: #3385ff !important;
        }
        .btn-warning {
            background-color: #ffcc80 !important;
            border-color: #ffcc80 !important;
        }
        .btn-danger {
            background-color: #ff4d4d !important;
            border-color: #ff4d4d !important;
        }
        .btn-danger:hover {
            background-color: #cc0000 !important;
            border-color: #cc0000 !important;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #3385ff;
        }
        table tbody tr:hover {
            background-color: #f2f9ff; /* Warna hover lebih soft */
        }
        thead th {
            color: black !important; /* Ubah warna teks header jadi hitam */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">📋 Daftar Pelanggan</h1>
        <a href="{{ route('pelanggan.create') }}" class="btn btn-success mb-3">Tambah Pelanggan</a>

        @if (session('success'))
            <div class="alert alert-success" id="success-message">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if($search)
            <p class="text-muted">Menampilkan hasil pencarian untuk:
            <strong>{{ $search }}</strong></p>
        @endif

        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Nomor Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pelanggans as $pelanggan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pelanggan->NamaPelanggan }}</td>
                        <td>{{ $pelanggan->Alamat }}</td>
                        <td>{{ $pelanggan->NomorTelepon }}</td>
                        <td>
                            <a href="{{ route('pelanggan.edit', $pelanggan->Pelangganid) }}" class="btn btn-warning btn-sm">✏️ </a>
                            <form action="{{ route('pelanggan.destroy', $pelanggan->Pelangganid) }}" method="POST" style="display:inline;">
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

    <!-- Menambahkan script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Menghilangkan alert sukses setelah beberapa detik
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.opacity = '0';
                setTimeout(() => successMessage.style.display = 'none', 500);
            }, 2000);
        }
    </script>
</body>
</html>
@endsection
