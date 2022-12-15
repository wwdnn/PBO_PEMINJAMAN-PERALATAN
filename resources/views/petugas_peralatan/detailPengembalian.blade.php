@extends('petugas_peralatan.index')
@section('content-petugas')
<div class="container table-container">
  <div class="card bg-light border-3 border-primary table-card">
      <div class="card-header table-card-header">List Barang Pinjaman</div>
      <div class="card-body table-card-body">
        <div class=" bg-transparent">
          <div class="table-header">
            <h3>Nama : {{$peminjaman->User->name}}</h3>
          </div>
          
     
          <div class="table-body mt-5">
            <table class="table table-hover table-fixed">
              <thead>
                <tr class="text-center">
                  <th>No</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Jumlah Barang Dipinjam</th>
                  <th>Jumlah Barang Dikembalikan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                @foreach($pinjaman_details as $pinjaman_detail)
                <tr class="text-center">                     
                  <td>{{ $no++ }}</td>
                  <td>{{ $pinjaman_detail->Product->kode_barang }}</td>
                  <td>{{ $pinjaman_detail->Product->nama_barang }}</td>
                  <td>{{ $pinjaman_detail->jumlah_barang }}</td>
                  <form id="pengembalian" action="{{ route('petugas_peralatan.pengembalianBarang', [$pinjaman_detail->id_pinjaman, $pinjaman_detail->id_barang]) }}" method="POST">
                    @csrf
                    <td>
                        <input type="number" name="jumlah_barang_dikembalikan" id="jumlah_barang_dikembalikan" class="input-jumlah-pengembalian">
                    </td>
                    <td>
                        <select name="status" id="status" class="aksi">
                          <option value="" disabled selected>Belum Dikembalikan</option>
                          <option value="Dikembalikan">Dikembalikan</option>
                        </select>
                
                        <input disabled type="submit" value="Submit" class="submit-aksi border-0" id="submit">
                    </td>
                  </form>
                </tr>
                @endforeach
              </tbody>
            </table>

            <button class="btn-kembali ">
              <a href="{{url('petugas_peralatan/pengembalian-barang')}}">Kembali</a>
            </button> 
  
        </div>

        
      </div>
  </div>
</div>


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

    .table{
      border : 2px solid black;
    }

    .input-jumlah-pengembalian{
      border : 2px solid black;
      border-radius: 5px;
      height: 30px;
      width: 70px;
      padding: 0 10px;
    }

    .aksi{
      border : 2px solid black;
      border-radius: 5px;
      height: 30px;
    }

    .submit-aksi{
      border-radius: 5px;
      background-color: #007bff;
      color: white;
      width: 50px;
      height: 30px;
      font-size: 12px;
    }

    .submit-aksi:disabled, .submit-aksi:hover:disabled{
      background-color: #6c757d;
    }

    .submit-aksi:hover{
      background-color: #0069d9;
    }

    .btn-kembali{
      border-radius: 5px;
      background-color: #007bff;
      color: white;
      width: 100px;
      height: 30px;
    }

    .btn-kembali:hover{
      background-color: #0069d9;
    }

    .btn-kembali a{
      text-decoration: none;
      color: white;
    }
</style>

<script>
  const submitButton = document.getElementById('submit');
  const inputNumber = document.getElementById('jumlah_barang_dikembalikan');

  inputNumber.addEventListener('input', () => {
    if(inputNumber.value == '' && selectStatus.value == ''){
      submitButton.disabled = true;
    }else{
      submitButton.disabled = false;
    }
  });

</script>

@endsection