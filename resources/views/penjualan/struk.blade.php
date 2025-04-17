<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f3f3f3;
        }
        .struk {
            width: 360px;
            padding: 20px;
            border: 2px dashed #555;
            border-radius: 15px;
            background-color: #fff;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.15);
        }
        .judul {
            text-align: center;
            font-size: 22px;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }
        .alamat {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-bottom: 15px;
        }
        .divider {
            border-top: 1px dashed #aaa;
            margin: 12px 0;
        }
        table {
            width: 100%;
            font-size: 14px;
        }
        th, td {
            padding: 6px;
        }
        th {
            text-align: left;
            font-weight: 600;
            border-bottom: 1px dashed #ccc;
        }
        .right {
            text-align: right;
        }
        .total, .bayar, .kembalian {
            font-size: 16px;
            font-weight: 600;
            text-align: right;
            color: #222;
        }
        .center {
            text-align: center;
            font-size: 14px;
            margin-top: 12px;
            font-style: italic;
            color: #555;
        }
        .footer {
            text-align: center;
            font-size: 13px;
            color: #888;
            margin-top: 15px;
        }
        .btn-kembali {
            display: block;
            margin-top: 20px;
            text-align: center;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-kembali:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="struk">
        <div class="judul">🛍️ Indah Skin Care</div>
        <div class="alamat">Jl. Contoh No. 123, Kota ABC</div>
        <div class="divider"></div>
        <p><strong>Tanggal:</strong> {{ $penjualan->TanggalPenjualan }}</p>
        <p><strong>Pelanggan:</strong> {{$penjualan->pelanggan->NamaPelanggan ?? 'Umum' }}</p>
        <div class="divider"></div>
        <table>
            <tr>
                <th>Barang</th>
                <th class="right">Jumlah</th>
                <th class="right">Subtotal</th>
            </tr>
            @foreach ($penjualan->detailPenjualan as $detail)
                <tr>
                    <td>{{ $detail->produk->NamaProduk ?? 'Produk Tidak Ditemukan' }}</td>
                    <td class="right">{{ $detail->jumlah_produk }}</td>
                    <td class="right">Rp{{number_format($detail->subtotal ?? 0, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </table>
        <div class="divider"></div>
        <p class="total">Total: Rp{{number_format($penjualan->TotalHarga ?? 0, 0, ',', '.') }}</p>
        <p class="bayar">Bayar: Rp{{number_format($penjualan->UangBayar ?? 0, 0, ',', '.') }}</p>
        <p class="kembalian">Kembalian: Rp{{number_format($penjualan->UangKembali ?? 0, 0, ',', '.') }}</p>
        <div class="divider"></div>
        <div class="center">✨ Terima Kasih telah berbelanja di Indah Skin Care! ✨</div>
        <div class="footer">📞 Hubungi kami: 0812-3456-7890</div>

        <!-- Tombol Kembali -->
        <a href="javascript:history.back()" class="btn-kembali">Kembali</a>
    </div>

    <script>
        window.onload = function () {
            setTimeout(() => window.print(), 500);
        };
    </script>
</body>
</html>
