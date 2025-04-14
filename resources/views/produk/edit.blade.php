<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <!-- Menambahkan link ke file CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e6f2ff; /* Biru muda */
        }
        .btn-primary {
            background-color: #4d94ff !important; /* Biru */
            border-color: #4d94ff !important;
        }
        .btn-primary:hover {
            background-color: #1a75ff !important;
            border-color: #1a75ff !important;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #1a75ff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Edit Produk</h1>
        <form action="{{ route('produk.update', $produk->Produkid) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="NamaProduk" class="form-label">Nama Produk:</label>
                <input type="text" name="NamaProduk" id="NamaProduk" value="{{ $produk->NamaProduk }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="Harga" class="form-label">Harga:</label>
                <input type="text" name="Harga" id="Harga" value="{{ $produk->Harga }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="Stok" class="form-label">Stok:</label>
                <input type="number" name="Stok" id="Stok" value="{{ $produk->Stok }}" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Perbarui</button>
        </form>
    </div>

    <!-- Menambahkan script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>