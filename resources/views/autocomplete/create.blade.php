<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Belajar PHP Ajax</title>
  </head>
  <body>

    <div class="container">
        
    <div class="card">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('/index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/customer/create') }}">Add Customers</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="card-body">
            <div class="table-responsive">
                <form action="{{ url('/store') }}" method="POST" class="form" id="form_input">
                    <span id="hasil"></span>
                    <table class="table table-light table-responsive table-striped" id="tabel_input">
                        <thead>
                            <tr>
                                <th width="30%">Name</th>
                                <th width="30%">Address</th>
                                <th width="30%">Phone</th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row"></i></td>
                                <td><input type="text" name="name" id="" class="form-control"></td>
                                <td><input type="text" name="address" id="" class="form-control"></td>
                                <td><input type="text" name="phone" id="" class="form-control"></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            @csrf
                            <tr width>
                                <td>
                                    <input type="submit" id="simpan" class="btn btn-primary" value="Simpan">
                                </td>
                                <td colspan="2" align="right">&nbsp;</td>
                                <td colspan="2" align="right">&nbsp;</td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
    </div>
    
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function(){

            var count = 1;

            dinamis_field(count);

            function dinamis_field(number){
                var html = '<tr>';
                html += '<td><input type="text" name="name[]" class="form-control" /></td>';
                html += '<td><input type="text" name="address[]" class="form-control" /></td>';
                html += '<td><input type="text" name="phone[]" class="form-control" /></td>';

                if (number > 1){
                    html += '<td><a id="hapus" href="#"><i class="fa fa-minus" aria-hidden="true"></a></td></tr>';
                    $('tbody').append(html);
                } else {
                    html += '<td><a href="#" id="tambah" name="tambah" class="btn btn-success">Tambah form</a></td></tr>';
                    $('tbody').html(html);
                }
            }

            $('#tambah').click(function(){
                count++;
                dinamis_field(count);
            });

            $(document).on('click', '#hapus', function(){
                count--;
                dinamis_field(count);
            });

        });
    </script>


  </body>
</html>