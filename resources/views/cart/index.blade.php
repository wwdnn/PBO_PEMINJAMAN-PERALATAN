@extends('pageUser')
@section('isiContent')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-5">
            <a href="{{ url('dashboard-user') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3>Pinjam</h3>
                    @if(!empty($peminjaman))
                    <p align="right">Tanggal Pinjam : {{ $peminjaman->tanggal_peminjaman }}</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Pinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($pinjaman_details as $pinjaman_detail)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                    <img src="{{ url('upload') }}/{{ $pinjaman_detail->product->gambar_barang }}" width="100">
                                </td>
                                <td>{{ $pinjaman_detail->product->nama_barang }}</td>
                                <td class="">{{ $pinjaman_detail->jumlah_barang }}</td>
                                <td>
                                    <form action="{{ url('cart-peminjaman') }}/{{ $pinjaman_detail->id }}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin akan menghapusnya?');"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td>
                                    <a href="{{ url('konfirmasi-pinjaman') }}" class="btn btn-success" onclick="return confirm('Anda yakin akan pinjam ?');">
                                        Pinjam
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection