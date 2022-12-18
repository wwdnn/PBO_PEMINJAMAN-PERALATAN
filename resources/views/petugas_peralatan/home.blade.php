@extends('petugas_peralatan.index')
@section('content-petugas')
<div class="container">
    <div class="align-content-center petugas">
        <h1 class="judul_petugas"><span class="badge role_judul_petugas">Petugas Peralatan</span></h1>
        <h1 class="nama_petugas">
            <i class='bx bxs-user-circle' ></i>
            {{ $petugas->nama_petugas }}
        </h1>
    </div>

    <div class="d-flex card-wrapper">
        <div class="card" style="width: 22rem;">
            <img class="card-img-top" src="https://images.unsplash.com/photo-1597484661643-2f5fef640dd1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1079&q=80" alt="Card image cap">
            <div class="card-header justify-content-center card_jumlah">
                Jumlah Barang
            </div>
            <div class="card-body">
                <p class="card-text">Tersedia : {{$barang->tersedia}}</p>
                <p class="card-text">Habis : {{$barang->habis}}</p>
            </div>
            <div class="card-footer">
                Total: {{$barang->tersedia + $barang->habis}}
            </div>
        </div>

        <div class="card" style="width: 22rem;">
            <img class="card-img-top" src="https://plus.unsplash.com/premium_photo-1661573111481-da21c4137d0b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTN8fGxlY3R1cmVyfGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60" alt="Card image cap">
            <div class="card-header justify-content-center card_jumlah">
                Jumlah Dosen
            </div>
            <div class="card-body">
                <p class="card-text">Aktif : {{$dosen->aktif}}</p>
                <p class="card-text">Nonaktif : {{$dosen->nonaktif}}</p>
            </div>
            <div class="card-footer">
                Total: {{$dosen->aktif + $dosen->nonaktif}}
            </div>
        </div>

        <div class="card" style="width: 22rem;">
            <img class="card-img-top" src="https://images.unsplash.com/photo-1581474859688-82ea214f852c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8bGVjdHVyZXxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60" alt="Card image cap">
            <div class="card-header justify-content-center card_jumlah">
                Jumlah Mahasiswa
            </div>
            <div class="card-body">
                <p class="card-text">Aktif : {{$mahasiswa->aktif}}</p>
                <p class="card-text">Nonaktif : {{$mahasiswa->nonaktif}}</p>
            </div>
            <div class="card-footer">
                Total: {{$mahasiswa->aktif + $mahasiswa->nonaktif}}
            </div>
        </div>

        <div class="card" style="width: 22rem;">
            <img class="card-img-top" src="https://www.empiremerchantfunding.com/wp-content/uploads/2021/12/5-Easy-Loans-to-Apply-for.jpg" alt="Card image cap">
            <div class="card-header justify-content-center card_jumlah">
                Jumlah Peminjam
            </div>
            <div class="card-body">
                <p class="card-text">Terpinjam: {{$peminjam->terpinjam}}</p>
                <p class="card-text">Dikembalikan: {{$peminjam->dikembalikan}}</p>
            </div>
            <div class="card-footer">
                Total: {{$peminjam->terpinjam + $peminjam->dikembalikan}}
            </div>
        </div>
    </div>

    <footer class="footer-login ombak">
        <div class="waves">
        <div class="wave" id="wave1"></div>
        <div class="wave" id="wave2"></div>
        <div class="wave" id="wave3"></div>
        <div class="wave" id="wave4"></div>
        </div>
    </footer>
</div>

@endsection

<style scoped>
    .petugas{
        margin-top: 5rem;
        margin-bottom: 1.5rem;
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

    .card_jumlah {
        background-color: #77D970 !important;
        color: black !important;
        font-weight: 600;
    }

    .card-footer{
        font-weight: 500;
    }

    .card-text{
        font-size: 15px;
    }

    .role_judul_petugas{
        background-color: #1C6758;
    }

    .role_judul_petugas:hover{
        background-color: #3D8361;
    }

    .card-img-top{
        height: 12rem;
    }

    .card{
        margin-right: 5rem;
        color: black !important;
        box-shadow: rgba(137, 0, 0, 0.19) 0px 10px 20px, rgba(137, 0, 0, 0.23) 0px 6px 6px !important;
        transition: 0.3s;
    }

    .card:hover{
        box-shadow: rgba(206, 0, 0, 0.3) 0px 19px 38px, rgba(206, 0, 0, 0.22) 0px 15px 12px !important;
    }

    .card-footer{
        background-color: #FFE15D !important;
    }

    .footer-login{
        position: relative;
        width: 95%;
    }

    .footer-login .wave{
        position: absolute;
        overflow: hidden;
        top: -80px;
        left: 0;
        width: 100%;
        height: 100px;
        background:url(../assets/wave_.png);
        background-size: 1000px 100px;
    }

    .footer-login .waves #wave1{
        z-index: 1000;
        opacity: 1;
        bottom: 0;
        animation: animateWave 4s linear infinite;
    }

    .footer-login .waves #wave2{
        z-index: 999;
        opacity: 0.5;
        bottom: 10px;
        animation: animateWave_02 4s linear infinite;
    }

    @keyframes animateWave{

        0%{
        background-position-x: 1000px;
        }

        100%{
            background-position-x: 0px;
        }
    }

    @keyframes animateWave_02{

        0%{
        background-position-x: 0px;
        }

        100%{
            background-position-x: 1000px;
        }
    }

    .ombak{
        margin-top: 11rem;
    }

    .card-body{
        background-color: #F5F5F5 !important;
    }

    .card-wrapper{
        margin-top: 3rem;
    }
</style>
