@extends('master')
@section('title', 'Page User')
@section('content')

<!-- Header -->
<header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow" style="height: 60px">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><h1>PEMINJAMAN ALAT</h1></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <h5 class="text-white">{{Auth::user()->name}}</h5>
      <form action="{{url('logout')}}" method="POST">
        @csrf
        <button class="btn btn-danger" type="submit">Logout</button>
      </form>

    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">

    <!-- SideBar -->
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">

          <li class="nav-item">
            <button class="btn">
              <a class="text-decoration-none" href="{{url('dashboard-user')}}">
              Dashboard
              </a>
            </button>
          </li>
          
          <li class="nav-item">
            <button class="btn" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
              Kategori Barang
            </button>

            <div class="collapse show" id="home-collapse">
              <ul class="btn-toggle-nav list-unstyled ps-5">
                <li><a href="#" class="d-inline-flex text-decoration-none rounded mb-2">Dekstop</a></li>
                <li><a href="#" class="d-inline-flex text-decoration-none rounded mb-2">Monitor</a></li>
                <li><a href="#" class="d-inline-flex text-decoration-none rounded mb-2">Penyimpanan Data</a></li>
                <li><a href="#" class="d-inline-flex text-decoration-none rounded mb-2">Komponen Network</a></li>
                <li><a href="#" class="d-inline-flex text-decoration-none rounded mb-2">Laptop</a></li>
                <li><a href="#" class="d-inline-flex text-decoration-none rounded mb-2">Keyboard</a></li>
                <li><a href="#" class="d-inline-flex text-decoration-none rounded mb-2">Mouse</a></li>
                <li><a href="#" class="d-inline-flex text-decoration-none rounded mb-2">Audio</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <?php
              $pinjaman_utama = \App\Models\Peminjaman::where('id_user', Auth::user()->id)->where('status_peminjaman', 0)->first();

              if(!empty($pinjaman_utama)){
                $notif = \App\Models\PinjamanDetail::where('id_pinjaman', $pinjaman_utama->id)->count();
              }
            ?>
            <button class="btn">
              <a class="text-decoration-none" href="{{url('cart-peminjaman')}}">
              Peminjaman 
              @if(!empty($notif))
              <span class="badge bg-danger">{{ $notif }}</span>
              @endif
              </a>
            </button>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Content -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="title-page">Dashboard</h1>
      </div>
     
      <!-- Isi Content -->
      @yield("isiContent")
      <!-- Akhir Isi Content -->
    </main>
  </div>
</div>
@endsection