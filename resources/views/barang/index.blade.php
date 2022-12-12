@extends('petugas_peralatan.index')

@section('title', 'List barang')

@section('content_header')
    <h1 class="m-0 text-dark">List barang</h1>
@stop

@section('content-petugas')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Users</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@stop

@push('scripts')
    {{ $dataTable->scripts() }}
    <form action="" id="delete-form" method="post">
        @method('delete')
        @csrf
    </form>
    <script>
        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menghapus data ? ')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            }
        }

    </script>
@endpush
