@extends('pages.dashboard')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e6f2ff;
        }
        .btn-success {
            background-color: #3385ff !important;
            border-color: #3385ff !important;
        }
        .btn-success:hover {
            background-color: #005ce6 !important;
            border-color: #005ce6 !important;
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
        thead th, tbody td {
            color: black !important;
        }
        td button, td a {
            color: black !important;
        }
        thead th {
            background-color: white;
            color: black;
            border: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center" style="color: #005ce6;">📦 Daftar Produk</h1>
        @if(Auth::check() && Auth::user()->role == 'admin')
        <a href="{{ route('produk.create') }}" class="btn btn-success mb-3">Tambah Produk</a>
        @endif

        @if (session('success'))
            <div id="success-alert" class="alert alert-success" role="alert">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if($search)
            <p class="text-muted">Menampilkan hasil pencarian untuk:
                <strong>{{ $search }}</strong>
            </p>
        @endif

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    @if(Auth::check() && Auth::user()->role == 'admin')
                    <th>Aksi</th>
                    @endif
                
                </tr>
            </thead>
            <tbody>
                @foreach ($produks as $produk)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $produk->NamaProduk }}</td>
                        <td>Rp {{ number_format($produk->Harga, 0, ',', '.') }}</td>
                        <td>{{ $produk->Stok }}</td>
                        @if(Auth::check() && Auth::user()->role == 'admin')
                        <td>
                            <a href="{{ route('produk.edit', $produk->Produkid) }}" class="btn btn-warning btn-sm">✏️</a>
                            <form action="{{ route('produk.destroy', $produk->Produkid) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Pindahkan ke Tong Sampah?')">🗑️</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide alert sukses
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.style.display = 'none', 500);
            }, 2000);
        }
    </script>
</body>
</html>
@endsection
