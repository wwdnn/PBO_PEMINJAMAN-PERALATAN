@extends('petugas_peralatan.index')

@section('content-petugas')
    <div class="container table-container">
        @if (session('success_message'))
            <div class="alert alert-success" role="alert">
                {{session('success_message')}}
            </div>
        @endif

        @if (session('error_message'))
            <div class="alert alert-danger" role="alert">
                {{session('error_message')}}
            </div>
        @endif

        <div class="card bg-light border-3 border-primary table-card">
            <div class="card-header table-card-header">Data Barang</div>
            <div class="card-body table-card-body">
                <div class="row">
                    <div class="col-sm-12 create-button">
                        <a href="{{ route('barang.create') }}" class="btn btn-warning">Tambah Barang</a>
                        <a href="{{ route('barang.mpdf') }}" class="btn btn-primary">PDF</a>
                    </div>
                </div>
                <div>
                    {{ $dataTable->table() }}
                </div>
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

    .create-button{
        margin-bottom: 10px;
    }
</style>

@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
    </script>
@endpush
