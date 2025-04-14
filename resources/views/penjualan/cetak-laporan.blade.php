<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan Bulan {{ $bulan }} Tahun {{ $tahun }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #007bff; /* Warna biru */
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Laporan Penjualan - {{ date('F Y', mktime(0, 0, 0, $bulan, 1, $tahun)) }}</h2>
        @if ($minggu !== 'all')
            <h3>Minggu ke-{{ $minggu }}</h3>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>Uang Bayar</th>
                        <th>Uang Kembali</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjualans as $penjualan)
                        <tr>
                            <td>{{ date('d-m-Y', strtotime($penjualan->TanggalPenjualan)) }}</td>
                            <td class="text-end">Rp {{ number_format($penjualan->TotalHarga, 0, ',', '.') }}</td>
                            <td class="text-end">Rp {{ number_format($penjualan->UangBayar, 0, ',', '.') }}</td>
                            <td class="text-end">Rp {{ number_format($penjualan->UangKembali, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
