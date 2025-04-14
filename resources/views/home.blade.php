@extends('pages.dashboard')

@section('content')

<!-- Pastikan sudah menyertakan Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    /* Ukuran card sesuai konten */
.card {
    border-radius: 15px;
    padding: 20px;
    display: inline-block;
}

/* Ukuran gambar */
.role-img {
    width: 80px; /* Sesuaikan ukuran gambar */
    height: auto;
    max-width: 100%;
}

/* Style teks */
.card-title {
    font-size: 24px;
    font-weight: bold;
}

.card-text {
    font-size: 18px;
}

.badge {
    font-size: 14px;
    padding: 5px 10px;
}

    .dashboard-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        padding: 20px;
    }
    
    .card {
        background: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 15px;
        text-align: center;
        transition: transform 0.3s ease;
        width: 100%;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card h2 {
        color: #555;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .card p {
        font-size: 24px;
        font-weight: bold;
        margin: 5px 0;
    }

    .card .icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 auto 10px;
        font-size: 24px;
        color: white;
    }

    /* Warna Elemen */
    .air { background: #A0E7E5; color: #0077B6; } /* Biru Muda */
    .api { background: #FF6F61; color: #B71C1C; } /* Merah Api */
    .bumi { background: #C3B091; color: #5A422A; } /* Coklat Bumi */


</style><div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-auto"> <!-- Menggunakan col-auto agar lebar sesuai konten -->
            <div class="card shadow-lg p-4">
                <div class="d-flex align-items-center">
                    <!-- Teks Selamat Datang -->
                    <div>
                        <h3 class="card-title">Selamat Datang!</h3>
                        <p class="card-text">
                            @if(auth()->user()->role == 'admin')
                                Halo <strong>{{ auth()->user()->name }}</strong>, Anda masuk sebagai 
                                <span class="badge bg-primary">Admin</span>.
                            @elseif(auth()->user()->role == 'kasir')
                                Halo <strong>{{ auth()->user()->name }}</strong>, Anda masuk sebagai 
                                <span class="badge bg-success">Kasir</span>.
                            @else
                                Halo <strong>{{ auth()->user()->name }}</strong>, Anda masuk sebagai 
                                <span class="badge bg-secondary">User</span>.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="dashboard-container">
    <!-- Card Elemen Air (Produk) -->
    <div class="card">
        <div class="icon air">
            <i class="fas fa-box"></i> <!-- Ikon Box untuk Produk -->
        </div>
        <h2>Jumlah Produk</h2>
        <p>{{ $jumlahProduk }}</p>
    </div>

    <!-- Card Elemen Api (Penjualan) -->
    <div class="card">
        <div class="icon api">
            <i class="fas fa-shopping-cart"></i> <!-- Ikon Keranjang untuk Penjualan -->
        </div>
        <h2>Jumlah Penjualan</h2>
        <p>{{ $jumlahPenjualan }}</p>
    </div>

    <!-- Card Elemen Bumi (Pelanggan) -->
    <div class="card">
        <div class="icon bumi">
            <i class="fas fa-users"></i> <!-- Ikon Users untuk Pelanggan -->
        </div>
        <h2>Jumlah Pelanggan</h2>
        <p>{{ $jumlahPelanggan }}</p>
    </div>
</div>

@endsection
