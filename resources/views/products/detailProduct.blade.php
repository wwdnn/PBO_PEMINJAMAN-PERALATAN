@extends('pageUser')
@section("isiContent")
<div class="container-fluid mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">

                        <!-- Tampilan Gambar -->
                        <div class="images p-3">
                            <div class="text-center p-4"> 
                                <img src="{{url('upload')}}/{{$products->gambar_barang}}" class="img-fluid" style="max-height: 300px; max-width: 500px">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center p-4"> 
                            <a href="{{url('dashboard-user')}}" class="btn btn-primary">Kembali</a>
                          </div>
                        </div>
                      <!--  -->
                        <div class="product p-4">
                            <!-- Judul Barang -->
                            <div class="mt-4 mb-3"> 
                              <h1 class="text-uppercase">{{$products->nama_barang}}</h1>
                            </div>
                            
                            <!-- Form Jumlah Barang -->
                            <form action="{{url('pinjam-barang')}}/{{$products->id}}" method="post">
                              @csrf
                              <div class="form-group">
                                <label for="jumlah_barang">Jumlah Barang</label>
                                <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" placeholder="Masukkan Jumlah Barang" required>
                              </div>
                              
                              <div class="cart mt-4 align-items-center"> 
                                <button class="btn btn-danger text-uppercase mr-2 px-4"> Add to cart</button>
                              </div>

                              @if(\Session::has('alert'))
                              <div class="alert alert-danger mt-3">
                                  <div>{{Session::get('alert')}}</div>
                              </div>
                              @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection