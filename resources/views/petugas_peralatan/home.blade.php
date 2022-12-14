@extends('petugas_peralatan.index')
@section('content-petugas')
<div class="container-md petugas">
    <h1 class="judul_petugas"><span class="badge bg-success border">Petugas Peralatan</span></h1>
    <h1 class="nama_petugas"> 
        <i class='bx bxs-user-circle' ></i>
        {{ $petugas->nama_petugas }} 
    </h1>
</div>

@endsection

<style scoped>
    .petugas{
        margin-top: 5rem;
        margin-bottom: 5rem;
        justify-content: center;
    }

    .judul_petugas {
        font-size: 2.5rem;
        font-weight: 600;
        padding-top: 15px;
    }

    .nama_petugas {
        font-size: 3rem;
        font-weight: 600;
        padding-top: 10px;
    }
</style>