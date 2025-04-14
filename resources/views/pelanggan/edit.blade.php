<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggan</title>
    <!-- Menambahkan link ke file CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #b3d9ff; /* Biru muda */
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Pelanggan</h1>
        <form action="{{ route('pelanggan.update', $pelanggan->Pelangganid) }}" method="POST">
            @csrf
            @method('PUT') 
            <div class="mb-3">
                <label for="NamaPelanggan" class="form-label">Nama:</label>
                <input type="text" class="form-control" name="NamaPelanggan" value="{{ $pelanggan->NamaPelanggan }}" required>
            </div>
            <div class="mb-3">
                <label for="Alamat" class="form-label">Alamat:</label>
                <input type="text" class="form-control" name="Alamat" value="{{ $pelanggan->Alamat }}">
            </div>
            <div class="mb-3">
                <label for="NomorTelepon" class="form-label">Nomor Telepon:</label>
                <input type="text" class="form-control" name="NomorTelepon" value="{{ $pelanggan->NomorTelepon }}">
            </div>
            <button type="submit" class="btn btn-primary">Perbarui</button>
        </form>
    </div>

    <!-- Menambahkan script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
