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

<script type="text/JavaScript">

    $(document).ready(function(){
        //fungsi untuk menentukan redirect kemana
        $("#simpan_baru").click(function(){
            $("#redirect_to").val("/home");
            $("#form_cari").submit();
        });

        // fungsi untuk melakukan pencarian data pelanggan
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

        //inisialisasi fungsi
        dinamis_field(count);
        show_grand_total(
            hitung_grand_total(count)
        );

        function dinamis_field(number){
            var html = '<tr id="baris'+number+'" class="td">';
            html += '<td><input type="hidden" id="produk_id'+number+'" name="produk_id[]"></input><input id="produkName'+number+'" type="text" class="form-control" placeholder="Ketuk untuk mencari" /></td>';
            html += '<td><input type="number" name="qty[]" value="1" class="form-control" id="qty'+number+'" /></td>';
            html += '<td><input id="harga'+number+'" type="text" name="harga[]" value="0" class="form-control" /></td>';
            html += '<td><input id="sub'+number+'" type="hidden" value="0" class="form-control" /></td>';

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

                $('#sub'+number).val(sub_total(number));
                show_grand_total(hitung_grand_total(count));
            };

            function onAutocomppletedProduct(ev, suggestion) {
                $("#produk_id"+number).val(suggestion.product_id);
                $("#harga"+number).val(suggestion.product_harga);
                fix_produk[number] = suggestion.product_name;

                $('#sub'+number).val(sub_total(number));
                show_grand_total(hitung_grand_total(count));
            };

            function onChangeProduct(event) {
                $("#produkName"+number).val(fix_produk[number]);
            };

            //event untuk menampilkan grand total
            $("#qty"+number).on("change", function(event){
                $('#sub'+number).val(sub_total(number));
                show_grand_total(hitung_grand_total(count));
            });

            $("#harga"+number).on("change", function(event){
                $('#sub'+number).val(sub_total(number));
                show_grand_total(hitung_grand_total(count));
            });
        }

        $('#tambah').click(function(){
            count++;
            last_count = count;
            dinamis_field(count);
        });

        $(document).on('click', '.hapus', function(){
            var button_id = $(this).parent().attr('id');

            // var kode = button_id.substring(5); 
            // var min = $('#sub'+kode).val();
            // var now = $('#grand_total_input').val();
            // var total_now = now - min;
            show_grand_total(
                hitung_grand_total(count)
            ); 

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
              format: 'yyyy-mm-dd',
              autoclose: true,
              todayHighlight: true,
        });

        //fungsi untuk menghitung sub total
        function sub_total(baris){
            var qty = [];
            var harga = [];
            var sub_total = [];

            qty[baris] = $('#qty'+baris).val();
            harga[baris] = $('#harga'+baris).val();
            sub_total[baris] = parseInt(qty[baris]) * parseInt(harga[baris]);
            return sub_total[baris];
        }

        function hitung_grand_total(row) {
            var total = 0;
            var subtotal = [];
            for (var i = 1; i <= row; i++) {
                subtotal[i] = parseInt($("#sub"+i).val());
                if (subtotal[i] > 0) {
                    total = total + subtotal[i];
                }
            }
            return total;
        }

        //fungsi untuk grand total
        function show_grand_total(value) {
            $('#grand_total_value').remove();
            $('#grand_total').html('<h3 id="grand_total_value"> Total '+value+'</h3>');
            $('#grand_total_input').val(value);
        }

        $('#grand_total_value').autoNumeric('init');

    });
    </script>
@endsection
