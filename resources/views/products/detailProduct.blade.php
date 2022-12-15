@extends('pageUser')
@section("isiContent")

<div class="detail-produk">
  <div class="container">
    <div class="card-detail-produk">
      <div class="row ">
        <div class="col-md-6 border-end border-dark">
          <div class="images p-3">
            <div class="text-center p-4"> 
              <img src="{{url('upload')}}/{{$products->gambar_barang}}" class="img-fluid" style="max-height: 300px; max-width: 500px">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          
          <!--  -->
          <div class="product p-4">
            <!-- Judul Barang -->
            <div class="mt-4 mb-3"> 
              <h1 class="judul-produk text-uppercase text-center">{{$products->nama_barang}}</h1>
            </div>

            <!-- Stok Barang -->
            <div class="stok-produk text-center">
              <h3>Stok : <span>{{$products->stok_barang}}</span></h3>
            </div>
            
            <!-- Form Jumlah Barang -->
            <form action="{{url('pinjam-barang')}}/{{$products->id}}" method="post">
              @csrf
              <div class="form-group mb-3">
                <label for="jumlah_barang" class="label-jumlah-barang">Jumlah Pinjam Barang :</label>
                <input type="number" name="jumlah_barang" class="form-control @error('jumlah_barang') is-invalid @enderror" id="jumlah_barang" required>
                @error('jumlah_barang')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
              <button class="btn-pinjam" type="submit">Pinjam</button>
              <button class="btn-batal" type="submit"><a href="{{url('dashboard-user')}}"> Batal</a></button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
