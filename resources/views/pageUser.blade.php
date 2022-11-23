@extends('master')
@section('title', 'Page User')
@section('content')

<div class="container-fluid">
  <div class="row">
    <!-- SideBar -->
    <div class="col-2">
      <div class=" p-3 sticky-top bg-white">
        <a href="#" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none">
          <span class="fs-5 fw-bold">Peminjaman JTK</span>
        </a>
        <ul class="list-unstyled ps-0">

          <li>
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" type="button" data-bs-toggle="modal" data-bs-target="#keranjangModal">
              Keranjang Peminjaman
            </button>
          </li>

          <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
              Kategori Barang
            </button>
            <div class="collapse show" id="home-collapse">
              <ul class="btn-toggle-nav list-unstyled ps-5">
                <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Dekstop</a></li>
                <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Monitor</a></li>
                <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Penyimpanan Data</a></li>
                <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Komponen Network</a></li>
                <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Laptop</a></li>
                <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Keyboard</a></li>
                <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Mouse</a></li>
                <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Audio</a></li>
              </ul>
            </div>
          </li>

          <li>
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed">
              Histori Peminjaman
            </button>
          </li>

        </ul>
      </div>
    </div>
    <!-- Akhir SideBar -->

    <div class="col-10">
      <!-- Header -->
      <header class="p-3">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-end justify-content-lg-end">
            <a href="#" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
              <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
            </a>

            <div class="dropdown text-end">
              <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                <span>Wildan Setya Nugraha</span>
              </a>
              
              <ul class="dropdown-menu text-small">

                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
              </ul>
            </div>
          </div>
        </div>
      </header>
      <!-- Akhir Header -->

      <!-- Content -->
      <div class="produk">
        <div class="container">
          <div class="title">
            <h4 class="mb-5">Kategori Barang</h4>
          </div>

          <div class="row ">
            @foreach($products as $product)
            <div class="col-md-3 mt-4">
              <div class="card" style="width: 15rem;">
                <img src="{{url('upload')}}/{{$product->gambar_barang}}" class="card-img-top" alt="..." style="max-height: 200px">
                <div class="card-body">
                  <h5 class="card-title">{{$product->nama_barang}}</h5>
                  <p class="card-text"><strong>Stok Barang </strong>: {{$product->stok_barang}}</p>
                
                  <a 
                        href="javascript:void(0)"
                        id="show-product"
                        data-url="{{ route('pageUser.show', $product->id) }}"
                        class="btn btn-info"
                        >Detail</a>
                </div>
              </div>
            </div>
            @endforeach
            
          </div>
        </div>
      </div>
      <!-- Akhir Content -->
    </div>
  </div>
</div>



<!-- Modal Detail Produk -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Barang</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <img src="" class="card-img-top" id="image-product" alt="..." style="max-height: 200px">
          </div>

          <div class="col">
            <h5 class="card-title" id="nama-product"></h5>
            <input type="hidden" id="post_id">

            <p><strong>Stok Barang:</strong> <span id="stok-product"></span></p>
      
            <div class="input-group">
              <span class="input-group-text">Jumlah Barang: </span>
              <input type="text" class="form-control" id="jumlah-barang">
            </div>
          
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ga Jadi</button>
        <button type="button" class="btn btn-primary" id="pinjam-product">Pinjam</button>
      </div>
    </div>
  </div>
</div>
<!-- Akhir Modal Detail Produk -->

<!-- Modal keranjang -->
<div class="modal fade" id="keranjangModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Keranjang</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="table-wrapper-scroll-y my-custom-scrollbar">

          <table class="table table-bordered table-striped mb-0">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
              </tr>
              <tr>
                <th scope="row">4</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr>
              <tr>
                <th scope="row">5</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>
              <tr>
                <th scope="row">6</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hapus Semua</button>
        <button type="button" class="btn btn-primary">Pinjam</button>
      </div>
    </div>
  </div>
</div>
<!-- Akhir Modal keranjang -->


@section('script')
<script type="text/javascript">
       
    $(document).ready(function () {
        
        $('body').on('click', '#show-product', function () {
          var userURL = $(this).data('url');
          $.get(userURL, function (data) {
              $('#post_id').val(data.id);
              $('#image-product').attr('src', '{{url('upload')}}/'+ data.gambar_barang);
              $('#modal').modal('show');
              $('#nama-product').text(data.nama_barang);
              $('#stok-product').text(data.stok_barang);
          })
       });

       $('body').on('click', '#pinjam-product', function () {
          var userURL = $(this).data('url');
          let jumlah_barang = $('#jumlah-barang').val();
          
          $.post(userURL, function (data){

          })
        
       });
        
    });
   
</script>
@endsection

<!-- <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Peminjaman JTK</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
    <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle d-flex" style="width: 50px;" alt="Avatar" />
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
              <span data-feather="home" class="align-text-bottom"></span>
              Keranjang Peminjaman
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
              <span data-feather="home" class="align-text-bottom"></span>
              kategori
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file" class="align-text-bottom"></span>
              Histori Peminjaman
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Halo, Selamat Datang </h1>
        <div class="btn-toolbar mb-2 mb-md-0">

        </div>
      </div>

        <div class="row">
          @foreach($products as $product)
          <div class="col-2">
            <div class="card" style="max-width: 18rem;">
              <img src="{{ url('upload') }}/{{ $product->gambar_barang }}" class="card-img-top" alt="..." style="max-height: 150px">
              <div class="card-body">
                <h5 class="card-title text-center">{{ $product->nama_barang }}</h5> 
                <p class="card-text mt-5">Stok Barang : {{ $product->stok_barang }}</p>
                <p class="card-text">Status Barang : {{ $product->status_barang }}</p>
                <a href="#" class="btn btn-primary">Pinjam</a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
       
      </div>
    </main>
  </div>
</div> -->

@endsection