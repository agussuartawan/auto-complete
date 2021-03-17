@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-9">
                            <p class="font-weight-bold">Data Transaksi</p>
                        </div>
                        <div class="col-3">
                            <div class="row float-right">
                                <div class="col-9 float-right">
                                    <a href="{{ route('home') }}" class="float-right btn btn-small btn-primary"><i class="fas fa-plus"></i>Tambah</a>
                                </div>
                                <div class="col-3 float-right">
                                    <button id="refresh" class="btn btn-success btn-small float-right"><i class="fas fa-sync-alt"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-hover table-bordered" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>No Transaksi</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                        <tfoot class="thead-light">
                            <tr>
                                <th>No Transaksi</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
$(document).ready(function(){
    $('#refresh').click(function(){
        $('#dataTable').DataTable().ajax.reload();
    });

    $('#dataTable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('transaksi.table') }}",
        columns: [
            {data: 'id', name:'transaksi.id'},
            {data: 'name', name:'customers.name'},
            {data: 'grand_total', name:'transaksi.grand_total'},
            {data: 'tanggal', name:'transaksi.tanggal'},
            {data: 'action', name:'action'}
        ],
        "order": [[0,'desc']]
    });
});
</script>
@endpush