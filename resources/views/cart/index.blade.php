@extends('pageUser')
@section('isiContent')
<div class="detail-pinjaman">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-detail-pinjaman">
                    <div class="card-detail-pinjaman-body">
                        <h3>Detail Pinjaman</h3>
                        @if(!empty($peminjaman))
                        <p align="right">Tanggal Pinjam : {{ $peminjaman->tanggal_peminjaman }}</p>
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Pinjam</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($pinjaman_details as $pinjaman_detail)
                                <tr class="text-center">
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
                            </tbody>
                        </table>
                        
                        <div class="button-konfirmasi" align='right'>
                            <button class="btn-konfirmasi-pinjam">
                                <a href="{{ url('konfirmasi-pinjaman') }}" onclick="return confirm('Anda yakin akan pinjam ?');">
                                    Pinjam
                                </a>
                            </button>
                        </div>
                        @endif
                        <div class="button-kembali mt-4" align='right'>
                            <button class="btn-kembali" type="submit"><a href="{{url('dashboard-user')}}"> kembali</a></button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection