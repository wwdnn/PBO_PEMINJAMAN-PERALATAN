@extends('master')
@section('title', 'Page User')
@section('content')

<!-- banner bg main start -->
<div class="banner_bg_main">
  <!-- header top section start -->
  <div class="container">
     <div class="header_section_top mb-5">
        <div class="row">
           <div class="col-sm-12">
              <div class="custom_menu">
                 <h1 class="text-white">PEMINJAMAN BARANG JTK</h1>
              </div>
           </div>
        </div>
     </div>
  </div>
  <!-- header top section start -->
  <!-- header section start -->
  <div class="header_section">
     <div class="container">
        <div class="containt_main mt-5 mb-5">
           <div id="mySidenav" class="sidenav">
               <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
               <a class="text-decoration-none" href="{{url('dashboard-user')}}">
                  <i class='bx bx-home' ></i>
                  <span class="link_name me-5">Dashboard</span>
               </a>
               <a class="text-decoration-none" href="{{url('cart-peminjaman')}}">
                  <i class='bx bxs-shopping-bags' ></i>
                  <span class="link_name me-5">Keranjang</span>
               </a>
            
           </div>
           <span class="toggle_icon" onclick="openNav()"><img src="{{url('assets')}}/toggle-icon.png"></span>
          
           <div class="main">
              <!-- Another variation with a button -->
              <div class="input-group justify-content-center">
               <form action="{{url('search')}}" method="GET" class="form-control-search d-flex">
                 <input type="search" name="search" class="form-control-search-input" placeholder="Cari Barang">
                 <div class="input-group-append">
                    <button class="btn-search btn-secondary" type="button">
                    <i class="fa fa-search"></i>
                    </button>
                 </div>
               </form>
              </div>
           </div>

           <div class="header_box">
              <div class="login_menu align-items-center">
                 <ul>
                  <li class="nav-item dropdown">

                     <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                           <i class="fa fa-user"></i> <span class="caret"></span>
                        </a>
                      
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                           <p class="nama-user text-center">{{Auth::user()->name}}</p>
  
                           <a class="dropdown-item btn-logout text-center" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                               {{ __('Logout') }}
                           </a>
  
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                               @csrf
                           </form>
                        </div>  
                     </div>
                 </li>
                    <li class="">
                        <?php
                           $pinjaman_utama = \App\Models\Peminjaman::where('id_user', Auth::user()->id)->where('status_peminjaman', 'Konfirmasi')->first();

                           if(!empty($pinjaman_utama)){
                              $notif = \App\Models\PinjamanDetail::where('id_pinjaman', $pinjaman_utama->id)->count();
                           }
                        ?>
                        <a class="text-decoration-none" href="{{url('cart-peminjaman')}}">
                           <i class="fa fa-shopping-cart text-black" aria-hidden="true"></i>
                           @if(!empty($notif))
                           <span class="badge bg-danger">{{ $notif }}</span>
                           @endif  
                        </a>
                    </li>
                 </ul>
              </div>
           </div>
        </div>
     </div>
  </div>
  <!-- header section end -->
</div>
<!-- content start -->
<main class="main-content col-lg-10 px-md-5">
   <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      
   </div>
   
   <!-- Isi Content -->
   @yield("isiContent")
   <!-- Akhir Isi Content -->
</main>
<!-- banner bg main end -->

@endsection
