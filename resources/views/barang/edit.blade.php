@extends('petugas_peralatan.index')

@section('title', 'Tambah barang')

@section('content_header')
    <h1 class="m-0 text-dark">Edit barang</h1>
@stop

@section('content-petugas')
<div class="container create-container">
    <form action="{{route('barang.update', $barang)}}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf

    @if (session('error_message'))
        <div class="alert alert-danger" role="alert">
            {{session('error_message')}}
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card bg-light border-3 border-info table-card">
                <div class="card-header">
                    Tambah Barang
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Kode Barang</label>
                        <input type="text" class="form-control @error('kode_barang') is-invalid @enderror" name="kode_barang" value="{{$barang->kode_barang ?? old('kode_barang')}}">
                        @error('kode_barang') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" id="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" value="{{$barang->nama_barang ?? old('nama_barang')}}">
                        @error('nama_barang') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Stok Barang</label>
                        <input type="number" class="form-control @error('stok_barang') is-invalid @enderror" name="stok_barang" value="{{$barang->stok_barang ?? old('stok_barang')}}">
                        @error('stok_barang') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <!--<div class="form-group">
                        <label>Status Barang</label>
                        <select class="form-select form-control @error('status_barang') is-invalid @enderror" name="status_barang">
                            <option selected>Tersedia</option>
                            <option value="1">Tidak Tersedia</option>
                        </select>
                        @error('status_barang') <span class="text-danger">{{$message}}</span> @enderror
                    </div>-->

                    <div class="form-group">
                        <label>Gambar Barang</label>
                        <input type="file" class="form-control @error('gambar_barang') is-invalid @enderror" name="gambar_barang" id="gambar_barang" value="{{$barang->gambar_barang}}">
                        @error('gambar_barang') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="col-md-12 mb-2">
                        <img id="preview-image-before-upload" src="{{$barang->gambar_barang ?? old('gambar_barang')}}"
                            alt="preview image" class="image-preview">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('barang.index')}}" class="btn btn-warning ms-3">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection

<style>
    .create-container{
        padding-top: 80px;
    }

    .form-group{
        margin-bottom: 25px;
    }

    .form-control{
        border-radius: 0px;
    }
    
    .card-header{
        font-weight: 600;
        font-size: 20px;
        justify-content: center;
        color: blue;
    }

    .card-footer{
        margin-bottom: 10px !important;
    }

    .image-preview{
        width: 200px;
        height: 200px;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
    }
</style>

@push('scripts')
    <script>
        $(document).ready(function (e) {
            $('#gambar_barang').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => { 
                    $('#preview-image-before-upload').attr('src', e.target.result); 
                }
                reader.readAsDataURL(this.files[0]); 
            });
        });
    </script>
@endpush