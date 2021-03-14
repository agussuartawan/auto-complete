@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ url('/store') }}" method="POST" id="form_cari">
                        @csrf
                        <input id="customer_id" name="customers_id" type="hidden">
                        <div class="container">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <!-- form untuk input data pelanggan -->
                                    <div class="row">
                                        <div class="col-6">                                                      
                                            <label><strong>*Pelanggan</strong></label>
                                            <div class="input-group mb-3">
                                                <input type="text" id="typeahead" class="form-control" placeholder="Ketuk untuk mencari">
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <label><strong>Tanggal</strong></label>
                                            <div class="input-group mb-3">
                                                <input id="datePicker" type="text" name="tanggal" class="form-control" value="{{ date('d-m-Y') }}">
                                                <div class="input-group-append">
                                                    <label class="input-group-text" id="basic-addon2" for="datePicker"><i class="fas fa-th"></i></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="input-group mb-3">
                                                <textarea readonly="readonly" class="form-control" id="alamat"></textarea>
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
                                                        <th width="40%">*Produk</th>
                                                        <th width="15%">Qty</th>
                                                        <th width="30%">Harga</th>
                                                        <th width="5%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
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
                                    <hr>
                                    <input value="Simpan" class="btn float-right btn-success">
                                </div>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/JavaScript">
    // fungsi untuk melakukan pencarian data pelanggan
    $(document).ready(function(){
        //untuk customer
        var fix_name;
        var customers = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.whitespace,
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          remote: {
            url: "{{ route('cari_customer') }}?find=%FIND%",
            wildcard: "%FIND%",
            filter: function(customers){
                return $.map(customers, function(customer){
                    return {
                        customer_id: customer.id,
                        customer_name: customer.name,
                        customer_addres: customer.addres
                    }
                })
            }
          }
        });

        //untuk produk
        var fix_produk = [];
        var produk = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.whitespace,
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          remote: {
            url: "{{ route('cari_produk') }}?query=%QUERY%",
            wildcard: "%QUERY%",
            filter: function(products){
                return $.map(products, function(product){
                    return {
                        product_id: product.id,
                        product_code: product.kode_produk,
                        product_name: product.nama_produk,
                        product_harga: product.harga
                    }
                })
            }
          }
        });        

        //untuk customer
        $("#typeahead").typeahead(null,{
            name: "customers",
            display: "customer_name",
            source: customers,
            limit: 10,
            templates: {
                empty: [
                  '<div class="empty-message form-control">',
                    '<a href="#" data-toggle="modal" data-target="#addCustomer">Ketuk untuk menambah customer baru(new)</a>',
                  '</div>'
                ].join('\n'),
                suggestion: function(data){
                    return '<div class="tt-suggestion tt-selectable"><p class="mb-0"><strong>'+data.customer_name+'</strong><br>Alamat : '+data.customer_addres+'</p></div>';
                }
            }
        })
        .on('typeahead:select', onSelect)  
        .on('typeahead:autocompleted', onAutocomppleted)
        .on('typeahead:change', onChange);  

        function onSelect(ev, suggestion) {
            $("#customer_id").val(suggestion.customer_id);
            $("#alamat").html(suggestion.customer_addres);
            fix_name = suggestion.customer_name;
        };

        function onAutocomppleted(ev, suggestion) {
            $("#customer_id").val(suggestion.customer_id);
            $("#alamat").html(suggestion.customer_addres);
            fix_name = suggestion.customer_name;
        };

        function onChange(event) {
            $("#typeahead").val(fix_name);
        };

        //fungsi untuk menambah form barang
        var count = 1;

        dinamis_field(count);

        function dinamis_field(number){
            var html = '<tr id="baris'+number+'" class="td">';
            html += '<td><input type="hidden" id="produk_id'+number+'" name="produk_id[]"></input><input id="produkName'+number+'" type="text" class="form-control" placeholder="Ketuk untuk mencari" /></td>';
            html += '<td><input type="number" name="qty[]" value="1" class="form-control" /></td>';
            html += '<td><input id="harga'+number+'" type="text" name="harga[]" class="form-control" /></td>';

            if (number > 1){
                html += '<td class="hapus"><a href="#"><i class="fa fa-minus" aria-hidden="true"></a></td></tr>';
                $('tbody').append(html);
            } else {
                html += '<td></td></tr>';
                $('tbody').html(html);
            }

            //untuk produk
            $("#produkName"+number).typeahead(null,{
                name: "produk",
                display: "product_name",
                source: produk,
                limit: 10,
                templates: {
                    empty: [
                      '<div class="empty-message form-control">',
                        '<a href="#" data-toggle="modal" data-target="#addCustomer">Ketuk untuk menambah produk baru(new)</a>',
                      '</div>'
                    ].join('\n'),
                    suggestion: function(hasil){
                        return '<div class="tt-suggestion tt-selectable"><p class="mb-0"><strong>'+hasil.product_code+' | '+hasil.product_name+'</strong></p></div>';
                    }
                }
            })
            .on('typeahead:select', onSelectProduct)  
            .on('typeahead:autocompleted', onAutocomppletedProduct)
            .on('typeahead:change', onChangeProduct);  

            function onSelectProduct(ev, suggestion) {
                $("#produk_id"+number).val(suggestion.product_id);
                $("#harga"+number).val(suggestion.product_harga);
                fix_produk[number] = suggestion.product_name;
            };

            function onAutocomppletedProduct(ev, suggestion) {
                $("#produk_id"+number).val(suggestion.product_id);
                $("#harga"+number).val(suggestion.product_harga);
                fix_produk[number] = suggestion.product_name;
            };

            function onChangeProduct(event) {
                $("#produkName"+number).val(fix_produk[number]);
            };
        }

        $('#tambah').click(function(){
            count++;
            dinamis_field(count);
        });

        $(document).on('click', '.hapus', function(){
            var button_id = $(this).parent().attr('id');
            $('#'+button_id).remove();
        });

        $('.form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:'{{ route("customer.store") }}',
                method:'post',
                data: $(this).serialize(),
                dataType:'json',
                beforeSend:function(){
                    $('#simpan').attr('disabled', 'disabled');
                },
                success:function(data){
                    if (data.error) {
                        var error_html = '';
                        for (var i = 0; i < data.error.length; i++) {
                            error_html += '<p>'+data.error[i]+'</p>';
                        }
                        $('#hasil').html('<div class+"alert alert-danger">'+error_html+'</div>')
                    } else {
                        dinamis_field(1);
                        $('#hasil').html('<div class="alert alert-success">'+data.success+'</div>');
                    }
                    $('#simpan').attr('disabled', false);
                }

            });
        });

        //fungsi untuk mengatur tanggal hari ini
        $("#datePicker").datepicker({
              format: 'dd-mm-yyyy',
              autoclose: true,
              todayHighlight: true,
        });
    });
    </script>
@endsection
