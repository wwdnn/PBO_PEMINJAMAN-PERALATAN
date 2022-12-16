@extends('pageUser')
@section("isiContent")

<div class="row">
  @foreach ($products as $product)
  <div class="col">
    <div class="card my-4 card-produk">
      <img src="{{url('upload')}}/{{$product->gambar_barang}}" class="img-produk card-img-top justify-content-center">
      <div class="card-body content-produk">
        <h2 class="card-title text-center pt-4">{{$product->nama_barang}}</h2>
        <h3 class="card-text">Stok :  <span>{{$product->stok_barang}} </span></h3>
        <a href="{{url('detail-barang')}}/{{$product->id}}" class="btn">DETAIL</a>
      </div>
    </div>
  </div>
  @endforeach

  @if(Route::getCurrentRoute()->uri() == 'dashboard-user')
  <div class="d-flex justify-content-center">
    {{ $products->links() }}
  </div>
  @endif
</div>

@endsection
