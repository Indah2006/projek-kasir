@extends('pages.dashboard')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan</title>
    <!-- Menambahkan link ke file CSS Bootstrap dengan tema biru -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #d0e1ff; /* Biru muda */
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #4a90e2;
            border-color: #4a90e2;
        }
        .btn-primary:hover {
            background-color: #357abd;
            border-color: #357abd;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Tambah Pelanggan</h1>
        <form action="{{ route('pelanggan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="NamaPelanggan" class="form-label">Nama:</label>
                <input type="text" class="form-control" name="NamaPelanggan" required>
            </div>
            <div class="mb-3">
                <label for="Alamat" class="form-label">Alamat:</label>
                <input type="text" class="form-control" name="Alamat">
            </div>
            <div class="mb-3">
                <label for="NomorTelepon" class="form-label">Nomor Telepon:</label>
                <input type="number" class="form-control" name="NomorTelepon">
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan</button>
        </form>
    </div>

    <!-- Menambahkan script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
