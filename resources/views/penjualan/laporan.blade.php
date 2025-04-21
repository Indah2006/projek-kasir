@extends('pages.dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Laporan Penjualan</h2>

    <!-- Tombol Cetak -->
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('penjualan.cetakLaporan', ['tanggal_masuk'=> request('tanggal_masuk'), 'tanggal_keluar' => request('tanggal_keluar')]) }}" class="btn btn-danger">Cetak PDF</a>
    </div>

    <!-- Form Filter Tanggal -->
    <form action="{{ route('penjualan.laporan') }}" method="GET" class="card p-4 shadow-sm">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Tanggal Masuk:</label>
                <input type="date" name="tanggal_masuk" class="form-control" value="{{ request('tanggal_masuk') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Tanggal Keluar:</label>
                <input type="date" name="tanggal_keluar" class="form-control" value="{{ request('tanggal_keluar') }}">
            </div>
        </div>
    </form>

    <!-- Tabel Laporan -->
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-striped">
            <thead class="bg-white text-dark">
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
                                        {{ $detail->produk->NamaProduk ?? '-' }} - 
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

<style>
    .table th, .table td {
        color: black !important;
    }
</style>
@endsection
