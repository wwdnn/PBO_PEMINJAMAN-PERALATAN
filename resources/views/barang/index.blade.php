@extends('petugas_peralatan.index')

@section('title', 'List barang')

@section('content_header')
    <h1 class="m-0 text-dark">List barang</h1>
@stop

@section('content-petugas')
    <div class="container table-container">
        <div class="card table-card">
            <div class="card-header">Data Barang</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@stop

<style scoped>
    .table-card {
        margin-top : 20px;
        padding-left: 50px;
        padding-right: 50px;
        padding-top: 50px;
    }
</style>

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
