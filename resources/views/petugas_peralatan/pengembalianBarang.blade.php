@extends('master')
@section('title', 'Pengembalian Barang')
@section('content')
<div class="pengembalian-barang">
  <div class="container">
    <div class="table">
      <div class="table-header">
        <h3>Pengembalian Barang</h3>
      </div>
      <div class="table-body">
        <table class="table">
          <thead>
            <tr class="text-center">
              <th>No</th>
              <th>Nama Peminjam</th>
              <th>Tanggal Peminjaman</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            @foreach($peminjamans as $peminjam)
            <tr class="text-center">                     
              <td>{{ $no++ }}</td>
              <td>{{$peminjam->id}}-{{ $peminjam->User->name }}</td>
              <td>{{ $peminjam->tanggal_peminjaman }}</td>
              {{-- <td>{{ $peminjam->PinjamanDetail->id_pinjaman}}</td> --}}
              <td>
                <a href="{{url('petugas_peralatan/pengembalian-detail')}}/{{$peminjam->id}}" class="btn">Detail</a>
              </td>
            </tr>
            @endforeach
    </div>
  </div>
</div>
@endsection