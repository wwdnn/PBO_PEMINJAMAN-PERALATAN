@extends('petugas_peralatan.index')
@section('content-petugas')
<div class="align-content-center petugas">
    <h1 class="judul_petugas"><span class="badge role_judul_petugas">Petugas Peralatan</span></h1>
    <h1 class="nama_petugas">
        <i class='bx bxs-user-circle' ></i>
        {{ $petugas->nama_petugas }}
    </h1>
</div>

<div class="d-flex">
    <div class="card" style="width: 22rem;">
        <img class="card-img-top" src="https://images.unsplash.com/photo-1597484661643-2f5fef640dd1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1079&q=80" alt="Card image cap">
        <div class="card-header justify-content-center card_jumlah_barang">
            Jumlah Barang
        </div>
        <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>

    <div class="card" style="width: 22rem;">
        <img class="card-img-top" src="https://images.unsplash.com/photo-1597484661643-2f5fef640dd1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1079&q=80" alt="Card image cap">
        <div class="card-header justify-content-center card_jumlah_barang">
            Jumlah Dosen
        </div>
        <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>

    <div class="card" style="width: 22rem;">
        <img class="card-img-top" src="https://images.unsplash.com/photo-1597484661643-2f5fef640dd1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1079&q=80" alt="Card image cap">
        <div class="card-header justify-content-center card_jumlah_barang">
            Jumlah Mahasiswa
        </div>
        <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>

    <div class="card" style="width: 22rem;">
        <img class="card-img-top" src="https://images.unsplash.com/photo-1597484661643-2f5fef640dd1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1079&q=80" alt="Card image cap">
        <div class="card-header justify-content-center card_jumlah_barang">
            Jumlah Peminjam
        </div>
        <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>
</div>

<footer class="footer-login test">
    <div class="waves">
      <div class="wave" id="wave1"></div>
      <div class="wave" id="wave2"></div>
      <div class="wave" id="wave3"></div>
      <div class="wave" id="wave4"></div>
    </div>
</footer>

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

    .card_jumlah_barang {
        background-color: #77D970 !important;
    }

    .role_judul_petugas{
        background-color: #1C6758;
    }

    .role_judul_petugas:hover{
        background-color: #3D8361;
    }

    .card{
        margin-right: 5rem;
    }

    .card:hover{
        box-shadow: 0 0 10px red;
    }

    .footer-login{
  position: relative;
  width: 95%;
  background: #1d1b31;
  height: 100px;
  padding: 20px 50px;
}

.footer-login .wave{
  position: absolute;
  top: -80px;
  left: 0;
  width: 100%;
  height: 100px;
  background:url(../assets/wave.png);
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

.test{
    margin-top: 120px;
}
</style>
