@extends('master')

@section('title', 'Login')
@section('content')
  
  <div class="container">
    <div class="row justify-content-center align-items-center vh-100">
      <div class="col-md-3">

      @if(\Session::has('alert'))
      <div class="alert alert-danger">
          <div>{{Session::get('alert')}}</div>
      </div>
      @endif

        <div class="card">
          <div class="card-header text-center">
            <h3 class="card-title">Haloo</h3>
          </div>

          <div class="card-body">
            <form action="/" method="post">
              @csrf
              <div class="form-floating mb-4">
                <input type="text" name="NIM_NIDN" class="form-control" id="NIM_NIDN" autofocus required>
                <label for="NIM_NIDN">NIM/NIDN</label>
              </div>
              <button class="w-100 btn btn-lg btn-primary" type="submit">Masuk</button>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>


@endsection