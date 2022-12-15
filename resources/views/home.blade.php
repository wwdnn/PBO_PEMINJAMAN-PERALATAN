@extends('master')
@section('title', 'Home')
@section('content')
<div class="home">
    <div class="hero">
        <div class="row">
            <div class="left-sec">
                <div class="content text-center">
                    <h1>JTK</h1>
                    <h3>Politeknik Negeri Bandung</h3>
                    <button ><a href="{{url('login-peminjaman')}}""> Mulai Pinjam Barang </a></button>
                </div>
            </div>

            <div class="right-sec">
                <div class="produk-img">
                    <div><img src="{{url('upload')}}/infocus.png" alt=""></div>
                    <div><img src="{{url('upload')}}/Komputer.png" alt=""></div>
                    <div><img src="{{url('upload')}}/Mouse.png" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
