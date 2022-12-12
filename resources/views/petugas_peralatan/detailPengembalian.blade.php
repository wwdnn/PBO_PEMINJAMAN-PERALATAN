@extends('petugas_peralatan.index')
@section('content-petugas')
<div class="detail-pengembalian">
  <div class="container">
    <div class="table">
      <div class="table-header">
        <h3>Detail Pengembalian Barang</h3>
        <h3>Atas Nama : {{$peminjaman->User->name}}</h3>
        <h3>ID Peminjaman : {{$peminjaman->id}}</h3>
      </div>

      <button>
        <a href="{{url('petugas_peralatan/pengembalian-barang')}}">Kembali</a>
      </button> 
      
      <div class="table-body">
        <table class="table">
          <thead>
            <tr class="text-center">
              <th>No</th>
              <th>Id Barang</th>
              <th>Nama Barang</th>
              <th>Jumlah Barang Dipinjam</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            @foreach($pinjaman_details as $pinjaman_detail)
            <tr class="text-center">                     
              <td>{{ $no++ }}</td>
              <td>{{ $pinjaman_detail->id_barang }}</td>
              <td>{{ $pinjaman_detail->Product->nama_barang }}</td>
              <td>{{ $pinjaman_detail->jumlah_barang }}</td>
              <td>
                <form action="{{ route('petugas_peralatan.pengembalianBarang', [$pinjaman_detail->id_pinjaman, $pinjaman_detail->id_barang]) }}" method="POST">
                  @csrf
                  <select name="status" id="status">
                    <option value="" disabled selected>Belum Dikembalikan</option>
                    <option value="Dikembalikan">Dikembalikan</option>
                  </select>
                  <input type="submit" value="Submit">
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>  
        
      </div>
  </div>
</div>
@endsection