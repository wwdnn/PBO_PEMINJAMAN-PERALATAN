@extends('petugas_peralatan.index')

@section('content-petugas')

<div class="container">
    <div class="card border border-info border-5">
        <div class="card-header">
            Log Details
        </div>

        <div class="card-body back">
            <i class='bx bx-arrow-back'></i>
            <a href="{{ route('petugas_peralatan.log') }}">Kembali</a>
        </div>

        <div class="card-body">
            <span class="badge bg-primary">Nama Log</span></h1>
            </br>
            <span class="border border-2 border-dark bg-light">{{$log->log_name}}</span>
        </div>

        <div class="card-body">
            <span class="badge bg-primary">Deskripsi</span></h1>
            </br>
            <span class="border border-2 border-dark bg-light">{{$log->description}}</span>
        </div>

        <div class="card-body">
            <span class="badge bg-success">Tipe Subjek</span></h1>
            </br>
            <span class="border border-2 border-dark bg-light">{{$log->subject_type}}</span>
        </div>

        <div class="card-body">
            <span class="badge bg-success">ID Subjek</span></h1>
            </br>
            <span class="border border-2 border-dark bg-light">{{$log->subject_id}}</span>
        </div>

        <div class="card-body">
            <span class="badge bg-success">Nama Subjek</span></h1>
            </br>
            <span class="border border-2 border-dark bg-light">{{$log->subject_name}}</span>
        </div>

        <div class="card-body">
            <span class="badge bg-danger">Tipe Pelaku</span></h1>
            </br>
            <span class="border border-2 border-dark bg-light">{{$log->causer_type}}</span>
        </div>

        <div class="card-body">
            <span class="badge bg-danger">ID Pelaku</span></h1>
            </br>
            <span class="border border-2 border-dark bg-light">{{$log->causer_id}}</span>
        </div>

        <div class="card-body">
            <span class="badge bg-danger">Nama Pelaku</span></h1>
            </br>
            <span class="border border-2 border-dark bg-light">{{$log->causer_name}}</span>
        </div>

        <div class="card-body">
            <span class="badge bg-warning">Data</span></h1>
            </br>
            <span class="border border-2 border-dark bg-light">
                <!-- read all properties name and value -->
                @foreach($log->properties as $key => $value)
                <div class="d-flex flex-row bd-highlight mb-1">
                    <div class="p-2 bd-highlight">{{$key}} :</div>
                    <div class="p-2 bd-highlight">{{$value}}</div>
                </div>
                @endforeach
            </span>
        </div>
    </div>
</div>

@endsection

<style scoped>
    .card {
        margin-top: 20px;
    }

    .card-header {
        font-size: 25px;
        font-weight: 600;
        justify-content: center;
    }

    .badge{
        font-size: 16px !important;
    }

    .border{
        font-size: 14px !important;
        margin-top: 10px;
        padding: 5px;
        display: block;
    }

    .back{
        font-size: 18px;
        margin-top: 10px;
    }
</style>

@push('scripts')
<script>
</script>
@endpush