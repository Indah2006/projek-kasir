@extends('pages.dashboard')

@section('content')
<div class="container">
    <h2>Detail Penjualan</h2>
    
    <table class="table">
        <tr>
            <th>ID Penjualan:</th>
            <td>{{ $penjualan->Penjualanid }}</td>
        </tr>
        <tr>
            <th>Tanggal:</th>
            <td>{{ $penjualan->TanggalPenjualan }}</td>
        </tr>
        <tr>
            <th>Total Harga:</th>
            <td>Rp {{ number_format($penjualan->TotalHarga, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Uang Bayar:</th>
            <td>Rp {{ number_format($penjualan->UangBayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Uang Kembali:</th>
            <td>Rp {{ number_format($penjualan->UangKembali, 0, ',', '.') }}</td>
        </tr>
    </table>

    <h3>Produk yang Dibeli</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($penjualan->detailPenjualan as $detail)
            <tr>
                <td>{{ $detail->produk->NamaProduk }}</td>
                <td>{{ $detail->jumlah_produk }}</td>
                <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('penjualan.index') }}" class="btn btn-primary">Kembali</a>
</div>
@endsection
