
<div class="container table-container">
    <div class="card bg-light border-3 border-primary table-card">
        <div class="card-header table-card-header">
            List Peminjam Barang
        </div>
        <div class="card-body table-card-body">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Barang</th>
                        <th>Jumlah Pinjam</th>
                        <th>Tanggal Pinjam</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjaman_details as $peminjaman_detail)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$peminjaman_detail->peminjaman->user->name}}</td>
                            <td>{{$peminjaman_detail->peminjaman->user->NIM_NIDN}}</td>
                            <td>{{$peminjaman_detail->product->nama_barang}}</td>
                            <td>{{$peminjaman_detail->jumlah_barang}}</td>
                            <td>{{$peminjaman_detail->peminjaman->tanggal_peminjaman}}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
        color: black;
        font-weight: 600;
        font-size: 20px;
    }

    th, td{
        border: 2px solid #000000;
        padding: 0 10px;
        text-align: center;
        font-size: 14px;
    }

</style>
