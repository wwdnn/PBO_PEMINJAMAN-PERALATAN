@extends('petugas_peralatan.index')

@section('title', 'List Peminjam barang')

@section('content_header')
    <h1 class="m-0 text-dark">List Peminjam barang</h1>
    
@stop

@section('content-petugas')
    <div class="container table-container">
        <div class="card bg-light border-3 border-primary table-card">
            <div class="card-header table-card-header">
              List Peminjam Barang
            </div>
            <div class="card-body table-card-body">
                {{ $dataTable->table() }}
                <div class="queue mt-3">
                  <a href="{{route('queue.index')}}" onclick="return confirm('Anda Yakin Akan Mengirim Ke Semua Petugas?');">Kirim Data Peminjam</a>
                </div>
            </div>
        </div>
    </div>
@stop

<style scoped>
    .table-card {
        margin-top : 20px;
    }

    .table-card-header{
        justify-content: center;
        margin-top: 5px;
        margin-bottom: 5px;
        color: blue;
        font-weight: 600;
        font-size: 20px;
    }

    .queue {
      display: flex;
      justify-content: flex-end;
    }

    .queue a{
      background-color: #1C6758;
      color: white;
      padding: 10px 12px;
      border-radius: 5px;
      text-decoration: none;
    }

    .queue a:hover{
      background-color: #3D8361;
      color: white !important;
    }

</style>

@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
    </script>
@endpush
