<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

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

        <form action="{{ route('cari_customer') }}" method="POST" id="form_cari">
            {{ csrf_field() }}
            <div class="container">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="remote" class="form-group">
                          <input class="typeahead form-control" name="name" type="text" placeholder="Ketik untuk mencari pelanggan" autocomplete="off">
                        </div>                        
                      <input type="text" name="piutang" class="form-control" placeholder="Masukan piutang">
                    </div>
                </div>
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
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script> -->
    <script src="{{ url('/typeahead/bootstrap3-typeahead.min.js') }}"></script>

    <script type="text/javascript">

        // var route = "{{ route('cari_customer') }}";
        // $('#remote .typeahead').typeahead({
        //   source: function(query, process){
        //         return $.get(route, { query : query }, function (data) {
        //             return process(data);
        //         });
        //   },
        //   autoSelect: true
        // });

        $.get("{{ route('cari_customer') }}", function(data){
          $("#remote .typeahead").typeahead({ source:data });
        },'json');
        //example_collection.json
        // ["item1","item2","item3"]
    </script>
  </body>
</html>