<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

    <title>Belajar PHP Ajax</title>
  </head>
  <body>

    <div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="card">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/customer/create') }}">Add Customers</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="card-body">

        <form action="{{ url('/store') }}" method="POST" id="form_cari">
            {{ csrf_field() }}
            <div class="container">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group" id="form_cari">
                            <select name="customers_id" id="select_customer" class="selectpicker form-control" data-live-search="true">
                                <option value="">~Pilih Pelanggan~</option>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="text" name="piutang" class="form-control" placeholder="Masukan piutang">
                <br><input type="submit" value="Save" class="btn">
            </div>
        </form>

        </div>
    </div>
    
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            cari_data();

            $('#form_cari input[type="text"]').keyup(function(){
                var query = $(this).val();
                // cari_data(query);
                console.log(query);
            });

            function cari_data(query = ''){
                $.ajax({
                    url: "{{ route('cari_customer') }}",
                    method: "GET",
                    data: {query:query},
                    dataType: "JSON",
                    success: function(data){
                        $('#select_customer').append(data.hasil).selectpicker('refresh');
                    }
                });
            }

        });
    </script>
  </body>
</html>