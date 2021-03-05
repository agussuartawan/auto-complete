<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

    <title>Hello, world!</title>
  </head>
  <body>

    <div class="container">
        
    <div class="card">
        <h5 class="card-header">Featured</h5>
        <div class="card-body">

        <form action="">
            <div class="container">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Cari Nama Ibu Kota Provinsi:</label>
                        <div>
                        <select name="ibukota" class="selectpicker form-control" data-live-search="true">
                            @foreach ($customers as $customer)
                                <option>{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                </div>
                </div>


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
  </body>
</html>