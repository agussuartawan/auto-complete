@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            Data Transaksi
                        </div>
                        <div class="col-2">
                            <a href="{{ route('home') }}" class="btn btn-primary"><i class="fas fa-plus"></i>Tambah</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-hover" id="dataTable">
                        <thead>
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
                        <tfoot>
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

@endpush