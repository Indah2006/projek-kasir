<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #cce5ff;
        }
        .btn-primary {
            background-color: #3399ff !important;
            border-color: #3399ff !important;
        }
        .btn-primary:hover {
            background-color: #0073e6 !important;
            border-color: #0073e6 !important;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center" style="color: #0073e6;">Edit Transaksi Penjualan</h1>
        <form action="{{ route('penjualan.update', $penjualan->Penjualanid) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="TanggalPenjualan" class="form-label">Tanggal Penjualan:</label>
                <input type="date" name="TanggalPenjualan" class="form-control" value="{{ $penjualan->TanggalPenjualan }}" required>
            </div>
            <div class="mb-3">
                <label for="Pelangganid" class="form-label">Pelanggan:</label>
                <select name="Pelangganid" class="form-control" required>
                    @foreach ($pelanggans as $pelanggan)
                        <option value="{{ $pelanggan->id }}" {{ $penjualan->Pelangganid == $pelanggan->id ? 'selected' : '' }}>
                            {{ $pelanggan->NamaPelanggan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <h4>Daftar Produk</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="produk-list">
                    @foreach ($penjualan->detailPenjualan as $detail)
                    <tr>
                        <td>
                            <select name="Produkid[]" class="form-select produk-select" required>
                                <option value="">Pilih Produk</option>
                                @foreach ($produks as $produk)
                                    <option value="{{ $produk->Produkid }}" data-harga="{{ $produk->Harga }}" 
                                        {{ $detail->Produkid == $produk->Produkid ? 'selected' : '' }}>
                                        {{ $produk->NamaProduk }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" class="form-control harga-produk" value="{{ $detail->produk->Harga }}" readonly></td>
                        <td><input type="number" name="JumlahProduk[]" class="form-control jumlah-produk" value="{{ $detail->JumlahProduk }}" min="1" required></td>
                        <td><input type="text" class="form-control subtotal" value="{{ $detail->Subtotal }}" readonly></td>
                        <td><button type="button" class="btn btn-danger btn-remove">Hapus</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="button" class="btn btn-success" id="tambah-produk">Tambah Produk</button>
            <hr>
            <div class="mb-3">
                <label for="TotalHarga" class="form-label">Total Harga:</label>
                <input type="text" id="TotalHarga" name="TotalHarga" class="form-control" value="{{ $penjualan->TotalHarga }}" readonly required>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function hitungTotal() {
                let total = 0;
                document.querySelectorAll(".subtotal").forEach(function (el) {
                    total += parseFloat(el.value) || 0;
                });
                document.getElementById("TotalHarga").value = total;
            }

            function updateSubtotal(row) {
                let harga = parseFloat(row.querySelector(".harga-produk").value) || 0;
                let jumlah = parseFloat(row.querySelector(".jumlah-produk").value) || 0;
                let subtotal = harga * jumlah;
                row.querySelector(".subtotal").value = subtotal.toFixed(2);
                hitungTotal();
            }

            document.getElementById("produk-list").addEventListener("change", function (event) {
                if (event.target.classList.contains("produk-select")) {
                    let row = event.target.closest("tr");
                    let harga = event.target.selectedOptions[0].dataset.harga || 0;
                    row.querySelector(".harga-produk").value = harga;
                    updateSubtotal(row);
                }
            });

            document.getElementById("produk-list").addEventListener("input", function (event) {
                if (event.target.classList.contains("jumlah-produk")) {
                    let row = event.target.closest("tr");
                    updateSubtotal(row);
                }
            });

            document.getElementById("tambah-produk").addEventListener("click", function () {
                let newRow = document.querySelector("#produk-list tr").cloneNode(true);
                newRow.querySelector(".harga-produk").value = "";
                newRow.querySelector(".jumlah-produk").value = "";
                newRow.querySelector(".subtotal").value = "";
                document.getElementById("produk-list").appendChild(newRow);
            });

            document.getElementById("produk-list").addEventListener("click", function (event) {
                if (event.target.classList.contains("btn-remove")) {
                    event.target.closest("tr").remove();
                    hitungTotal();
                }
            });

            hitungTotal();
        });
    </script>
</body>
</html>
