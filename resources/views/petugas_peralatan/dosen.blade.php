@extends('petugas_peralatan.index')

@section('content-petugas')
    <div class="container table-container">
        <div class="card bg-light border-3 border-primary table-card">
            <div class="card-header table-card-header">Data Dosen</div>
            <div class="card-body table-card-body">
                {{ $dataTable->table() }}
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
</style>

@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
    </script>
@endpush
