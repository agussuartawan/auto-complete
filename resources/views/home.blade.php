@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Transaksi Penjualan</strong></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('transaksi.store') }}" method="POST" id="form_cari">
                        @csrf
                        <input id="customer_id" name="customer_id" type="hidden">
                        <div class="container">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <!-- form untuk input data pelanggan -->
                                    <div class="row">
                                        <div class="col-6">                                                      
                                            <label><strong>*Pelanggan</strong></label>
                                            <div class="input-group mb-3">
                                                <input type="text" id="typeahead" class="form-control" placeholder="Ketuk untuk mencari">
                                                <input type="hidden" value="{{ route('cari_customer') }}" id="url_customer" />
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <label><strong>Tanggal</strong></label>
                                            <div class="input-group mb-3">
                                                <input id="datePicker" type="text" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}">
                                                <div class="input-group-append">
                                                    <label class="input-group-text" id="basic-addon2" for="datePicker"><i class="fas fa-th"></i></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="input-group mb-3">
                                                <textarea class="form-control" id="alamat" readonly></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- form untuk input data barang -->
                                    <div class="table-responsive">
                                        <form action="{{ url('/store') }}" method="POST" class="form" id="form_input">
                                            <span id="hasil"></span>
                                            <table class="table table-light table-responsive table-striped" id="tabel_input">
                                                <thead>
                                                    <tr>
                                                        <th width="55%">*Produk</th>
                                                        <th width="20%">Qty</th>
                                                        <th width="20%">Harga</th>
                                                        <th width="5%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <input type="hidden" value="{{ route('cari_produk') }}" id="url_product" >
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th><a href="#" id="tambah" name="tambah">(+)Tambah form</a></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </form>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input id="grand_total_input" type="hidden" value="0" name="grand_total">
                                        </div>
                                        <div class="col-md-6 float-right" id="grand_total">
                                            
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- Example split danger button -->
                                    <div class="btn-group dropup float-right">
                                    <input id="redirect_to" type="hidden" value="/" name="redirect_to" readonly>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="#" id="simpan_baru" class="dropdown-item">Simpan dan Baru</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('js/home.js') }}"></script>
@endpush
