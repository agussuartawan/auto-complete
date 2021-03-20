@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-9">
                            <p class="font-weight-bold">Data Produk</p>
                        </div>
                        <div class="col-3">
                            <div class="row float-right">
                                <div class="col-9 float-right">
                                    <a href="{{ route('products.create') }}" class="float-right btn btn-small btn-primary modal-show" title="Tambah Produk"><i class="fas fa-plus"></i>Tambah</a>
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
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <input type="hidden" id="url" value="{{ route('product.table') }}">
                        </tbody>
                        <tfoot class="thead-light">
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
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
<script src="{{ asset('js/product/index.js') }}"></script>
@endpush