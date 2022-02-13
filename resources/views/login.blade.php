<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Page Title -->
    <title>BengRPL - Login</title>
    <!-- Dependencies CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- Custom Style -->
    <style>
        body{
            background-color: white;
        }

        input[type="text"],
        select.form-control {
          background: transparent;
          border: none;
          border-bottom: 2px solid #0193DE;
          -webkit-box-shadow: none;
          box-shadow: none;
          border-radius: 0;
        }

        input[type="password"],
        select.form-control {
          background: transparent;
          border: none;
          border-bottom: 2px solid #0193DE;
          -webkit-box-shadow: none;
          box-shadow: none;
          border-radius: 0;
        }
        
        input[type="text"]:focus,
        select.form-control:focus {
          -webkit-box-shadow: none;
          box-shadow: none;
        }
        input[type="password"]:focus,
        select.form-control:focus {
          -webkit-box-shadow: none;
          box-shadow: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row align-items-center h-100">
            <div class="col-12 mx-auto">
                <div class="card border-white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <p>
                                    <img src="images/logo.png" style="max-width: 150px; max-height: 150px;">
                                    <h2 class="text-left font-weight-bold">
                                        Venon
                                    </h2>
                                    <p class="lead">Pinjam Alat Lebih Mudah.</p>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <!-- <h1 class="mb-5">Login</h1> -->
                                    <form action="{{ url('/login/proseslogin') }}" onsubmit="return cekkolom()">
                                        {{ csrf_field() }}
                                        <h4>Login sebagai : </h4>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" name="radioLogin" id="radioPetugas" value="Petugas">
                                            <label class="custom-control-label" for="radioPetugas">Petugas</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" name="radioLogin" id="radioPeminjam" value="Peminjam">
                                            <label class="custom-control-label" for="radioPeminjam">Peminjam</label>
                                        </div>
                                        @if(session()->has('message'))  
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                {{ session()->get('message') }}
                                            </div>
                                        @endif
                                        <div class="form-group mt-4">     
                                            <label for="inputID">NIS/NIP</label>
                                            <input class="form-control" id="kolusername" name="nouser" type="text">
                                        </div>
                                        <div class="form-group">     
                                            <label for="inputPASS">Password</label>
                                            <input class="form-control" id="kolpassuser" name="passuser" type="password">
                                        </div>
                                        <div class="alert-danger">
                                    
                                        </div>
                                        <div class="form-group mt-1">
                                            <input type="submit" class="btn btn-primary btn-block btn-lg" value="Login">
                                        </div>
                                    </form>
                                    <!-- Script Cek Kolom Kosong -->
                                    <script>
                                        function cekkolom(){
                                            //ambil value tiap kolom
                                            var userlog = document.getElementById("kolusername").value;
                                            var passlog = document.getElementById("kolpassuser").value;
                                            
                                            //cek kolom jika kosong
                                            if(userlog == ''){
                                                swal('Peringatan','Kolom NIS/NIP masih kosong!','warning');
                                                return false;
                                            }
                                            else if(passlog == ''){
                                                swal('Peringatan','Kolom Password masih kosong!','warning');
                                                return false;
                                            }
                                            else{
                                                return true;
                                            }
                                        }
                                    </script>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Include JS -->
    <script src="{{url('js/jquery-3.4.1.js')}}"></script>
    <script src="{{url('js/sweetalert.min.js')}}"></script>
</body>    
</html>