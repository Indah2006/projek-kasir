@extends('pages.dashboard')

@section('content')
<div class="container">
    <h2>Tambah Produk</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produk.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="NamaProduk">Nama Produk</label>
            <input type="text" name="NamaProduk" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="Harga">Harga</label>
            <input type="number" step="0.01" name="Harga" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="Stok">Stok</label>
            <input type="number" name="Stok" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
