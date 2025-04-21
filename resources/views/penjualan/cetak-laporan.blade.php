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
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Laporan Penjualan - {{ date('F Y', mktime(0, 0, 0, $bulan, 1, $tahun)) }}</h2>

        @if ($minggu !== 'all')
            <h3 class="text-center">Minggu ke-{{ $minggu }}</h3>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Pelanggan</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalKeseluruhan = 0; @endphp
                    @foreach ($penjualans as $index => $penjualan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ date('d-m-Y', strtotime($penjualan->TanggalPenjualan)) }}</td>
                            <td>{{ $penjualan->pelanggan->NamaPelanggan ?? '-' }}</td>
                            <td>
                                @if ($penjualan->detailPenjualan->isNotEmpty())
                                    <ul class="text-start mb-0" style="list-style: none; padding-left: 0;">
                                        @foreach ($penjualan->detailPenjualan as $detail)
                                        <li>
    {{ $detail->produk->NamaProduk ?? '-' }}
</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </td>
                            @if ($penjualan->detailPenjualan->isNotEmpty())
        <ul class="text-start mb-0" style="list-style: none; padding-left: 0;">
            @foreach ($penjualan->detailPenjualan as $detail)
                <li> {{$detail->jumlah_produk}}
                  
                </li>
            @endforeach
        </ul>
    @else
        -
    @endif
</td>
                        <td> 
    @if ($penjualan->detailPenjualan->isNotEmpty())
        <ul class="text-start mb-0" style="list-style: none; padding-left: 0;">
            @foreach ($penjualan->detailPenjualan as $detail)
                <li> {{ number_format($detail->produk->Harga ?? 0, 0, ',', '.') }}
                  
                </li>
            @endforeach
        </ul>
    @else
        -
    @endif
</td>
                            <td>Rp {{ number_format($penjualan->TotalHarga, 0, ',', '.') }}</td>
                        </tr>
                        @php $totalKeseluruhan += $penjualan->TotalHarga; @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6" class="text-end">Total Keseluruhan:</th>
                        <th>Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>
</html>
