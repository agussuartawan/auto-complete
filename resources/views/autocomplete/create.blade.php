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

        <form action="{{ url('/store') }}" method="POST">
            {{ csrf_field() }}
            <table class="table">
                <thead class="bg-primary">
                    <th></th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                </thead>

                <tbody>
                    <tr>
                        <td></td>
                        <td><input class="form-control" type="text" name="name"></td>
                        <td><input class="form-control" type="text" name="addres"></td>
                        <td><input class="form-control" type="text" name="phone"></td>
                    </tr>
                </tbody>
            </table>
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