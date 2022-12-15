@extends('petugas_peralatan.index')

@section('title', 'Tambah barang')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah barang</h1>
@stop

@section('content')
    <form action="{{route('barang.store')}}" method="post">
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="exampleInputKode">Kode Barang</label>
                        <input type="text" class="form-control @error('kode_barang') is-invalid @enderror" id="exampleInputKode" placeholder="..." name="kode_barang" value="{{old('kode_barang')}}">
                        @error('kode_barang') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputNama">Nama Barang</label>
                        <input type="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" id="exampleInputNama" placeholder="..." name="nama_barang" value="{{old('nama_barang')}}">
                        @error('nama_barang') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputStok">Stok Barang</label>
                        <input type="stok_barang" class="form-control @error('stok_barang') is-invalid @enderror" id="exampleInputStok" placeholder="..." name="stok_barang">
                        @error('stok_barang') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputStatus">Status Barang</label>
                        <input type="status_barang" class="form-control @error('status_barang') is-invalid @enderror" id="exampleInputStatus" placeholder="..." name="status_barang">
                        @error('status_barang') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class=

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('barang.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
