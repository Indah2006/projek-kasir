@extends('pages.dashboard')

@section('content')
<div class="container my-4">
    <h1>Tambah Penjualan</h1>
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('penjualan.store') }}" method="POST">
    @csrf

        <div class="mb-3">
            <label class="form-label">Pilih Pelanggan:</label>
            <select name="Pelangganid" class="form-control" required>
    <option value="" disabled selected>-- Pilih Pelanggan --</option>
    @foreach ($pelanggans as $pelanggan)
        <option value="{{ $pelanggan->Pelangganid }}">{{ $pelanggan->NamaPelanggan }}</option>
    @endforeach
</select>

</select>

        </div>
        
        <div class="mb-3">
            <label class="form-label">Tanggal Penjualan</label>
            <input type="date" name="TanggalPenjualan" class="form-control" required>
            @error('TanggalPenjualan') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        <h5>Detail Penjualan</h5>
        <div id="detail-container">
            <div class="row mb-3 detail-row">
                <div class="col-md-4">
                    <label class="form-label">Produk</label>
                    <select name="produkid[]" class="form-control produkid" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($produk as $item)
                            <option value="{{ $item->Produkid }}" data-harga="{{ $item->Harga }}">
                                {{ $item->NamaProduk }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah_produk[]" class="form-control jumlah_produk" min="1" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Subtotal</label>
                    <input type="number" name="subtotal[]" class="form-control subtotal" readonly>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-row">X</button>
                </div>
            </div>
        </div>

        <button type="button" id="add-row" class="btn btn-success mb-3">Tambah Produk</button>

        <div class="mb-3">
            <label class="form-label">Total Harga</label>
            <input type="number" name="TotalHarga" id="total_harga" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Uang Bayar</label>
            <input type="number" name="UangBayar" id="uang_bayar" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Uang Kembali</label>
            <input type="number" name="UangKembali" id="uang_kembali" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Menambah baris baru
    document.getElementById('add-row').addEventListener('click', function () {
        let newRow = document.querySelector('.detail-row').cloneNode(true);
        
        // Reset nilai input pada baris baru
        newRow.querySelector('.produkid').value = "";
        newRow.querySelector('.jumlah_produk').value = "";
        newRow.querySelector('.subtotal').value = "";

        document.getElementById('detail-container').appendChild(newRow);
    });

    // Update subtotal ketika produk atau jumlah berubah
    document.addEventListener('input', function (e) {
        if (e.target.classList.contains('produkid') || e.target.classList.contains('jumlah_produk')) {
            let row = e.target.closest('.detail-row');
            updateSubtotal(row);
        }
    });

    // Hapus baris produk
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('.detail-row').remove();
            calculateTotal();
        }
    });

    // Hitung uang kembali saat input uang bayar berubah
    document.getElementById('uang_bayar').addEventListener('input', function () {
        calculateChange();
    });
});

// Fungsi menghitung subtotal per produk
function updateSubtotal(row) {
    let selectProduk = row.querySelector('.produkid');
    let jumlahInput = row.querySelector('.jumlah_produk');
    let subtotalInput = row.querySelector('.subtotal');

    let harga = parseFloat(selectProduk.selectedOptions[0].dataset.harga) || 0;
    let jumlah = parseInt(jumlahInput.value) || 0;
    let subtotal = harga * jumlah;
    subtotalInput.value = subtotal.toFixed(2);

    calculateTotal();
}

// Fungsi menghitung total harga semua produk
function calculateTotal() {
    let total = 0;
    document.querySelectorAll('.subtotal').forEach(input => {
        total += parseFloat(input.value) || 0;
    });
    document.getElementById('total_harga').value = total.toFixed(2);
    calculateChange();
}

// Fungsi menghitung uang kembali
function calculateChange() {
    let totalHarga = parseFloat(document.getElementById('total_harga').value) || 0;
    let uangBayar = parseFloat(document.getElementById('uang_bayar').value) || 0;
    let change = uangBayar - totalHarga;
    document.getElementById('uang_kembali').value = change >= 0 ? change.toFixed(2) : 0;
}
</script>
@endsection
