<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo text-center">
    <a href="#" class="app-brand-link">
      <span class="app-brand-logo demo">
      <img src="{{ asset('assets/img/favicon/SkinCare_Indah.png') }}" alt="toko" class="logo-img" width="50">
      </span>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1 mt-4"> <!-- Menambah margin top agar Dashboard turun -->
    <!-- Dashboard -->
    <li class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
      <a href="{{ route('home') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div>Dashboard</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Pages</span>
    </li>


    <li class="menu-item {{ request()->routeIs('pelanggan.index') ? 'active' : '' }}">
      <a href="{{ route('pelanggan.index') }}" class="menu-link no-underline">

        <i class="menu-icon tf-icons bx bx-group"></i>
        <div>Pelanggan</div>
      </a>
    </li>

    <li class="menu-item {{ request()->routeIs('penjualan.index') ? 'active' : '' }}">
      <a href="{{ route('penjualan.index') }}" class="menu-link no-underline">
        <i class="menu-icon tf-icons bx bx-cart"></i>
        <div>Penjualan</div>
      </a>
    </li>

    <li class="menu-item {{ request()->routeIs('produk.index') ? 'active' : '' }}">
      <a href="{{ route('produk.index') }}" class="menu-link no-underline">
        <i class="menu-icon tf-icons bx bx-package"></i>
        <div>Produk</div>
      </a>
    </li>

    <li class="menu-item {{ request()->routeIs('penjualan.laporan') ? 'active' : '' }}">
      <a href="{{ route('penjualan.laporan') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-file"></i>
        <div>Laporan</div>
      </a>
    </li>

    <li class="menu-item">
      <form action="{{ route('logout') }}" method="post" style="margin: 0;">
        @csrf
        <a href="javascript:void(0);" class="menu-link" onclick="event.preventDefault(); this.closest('form').submit();">
          <i class="menu-icon tf-icons bx bx-log-out"></i>
          <div>Keluar</div>
        </a>
      </form>
    </li>
  </ul>
</aside>
<style>/* Ukuran Logo Lebih Besar dan Tidak Terpotong */
.logo-img {
  width: 180px; /* Perbesar gambar */
  height: auto;
  max-width: 100%;
  display: block;
  margin: 0 auto; /* Tengah */
}

/* Pastikan area logo cukup tinggi */
.app-brand {
  min-height: 150px; /* Tambah tinggi minimum */
  padding-top: 20px; /* Tambah ruang atas */
  padding-bottom: 40px; /* Tambah ruang bawah agar tidak tertutup */
  text-align: center;
  overflow: visible; /* Pastikan gambar tidak terpotong */
}

/* Geser Menu ke Bawah */
.menu-inner {
  margin-top: 60px; /* Tambah jarak agar tidak menutupi logo */
}

/* Hilangkan Underline */
.menu-link {
  text-decoration: none !important;
}

</style>