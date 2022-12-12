@extends('adminlte::page')

@section('title', 'List barang')

@section('content_header')
    <h1 class="m-0 text-dark">List barang</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{route('barangs.create')}}" class="btn btn-primary mb-2">
                        Tambah
                    </a>

                    <table class="table table-hover table-bordered table-stripped" id="ajax-crud-table">
                        <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Barang</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div>
        <a href="{{route('mpdf')}}" class="btn btn-primary mb-2" onclick="return confirm('Apakah anda ingin mendownload');">
            Download PDF
        </a>
    </div>
@stop

@push('js')
    <form action="" id="delete-form" method="post">
        @method('delete')
        @csrf
    </form>
    <script>
        //yajra
        $(function () {
            $('#ajax-crud-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('barangs.index') }}",
                columns: [
                    {data: 'kode_barang', name: 'kode_barang'},
                    {data: 'nama_barang', name: 'nama_barang'},
                    {data: 'stok_barang', name: 'stok_barang'},
                    {data: 'status_barang', name: 'status_barang'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });

        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menghapus data ? ')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            }
        }

    </script>
@endpush
