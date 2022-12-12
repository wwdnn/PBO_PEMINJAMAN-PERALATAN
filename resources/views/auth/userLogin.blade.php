@extends('master')

@section('title', 'Login')
@section('content')

<div class="login-user">
  <div class="container">
    <div class="row justify-content-center align-items-center vh-100">
      <div class="col-md-3">
        
        @if(\Session::has('alert'))
        <div class="alert alert-danger">
            <div>{{Session::get('alert')}}</div>
        </div>
        @endif

        <div class="card-login">
          <div class="card-header text-center">
            <h3 class="card-title">Haloo</h3>
          </div>

          <div class="card-body mt-3">
            <form action="/login-peminjam" method="post">
              @csrf
              <div class="form-floating mb-4">
                <input type="text" name="nim_nidn" class="form-control-login @error('nim_nidn') is-invalid @enderror" id="NIM_NIDN" autofocus required>
                <label for="NIM_NIDN">NIM/NIDN</label>
                @error('nim_nidn')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
              <button class="w-100 btn btn-lg btn-primary" type="submit">Masuk</button>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>

  <footer class="footer-login">
    <div class="waves">
      <div class="wave" id="wave1"></div>
      <div class="wave" id="wave2"></div>
      <div class="wave" id="wave3"></div>
      <div class="wave" id="wave4"></div>
    </div>
  </footer>
</div>
  



@endsection