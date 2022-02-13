<!DOCTYPE html>
<html>
    <head>
        <title>Gagal Login</title>
    </head>
    <body>
        <script>
             alert('Kasih');
             swal('Peringatan','Anda Gagal Login. Silakan Coba Lagi!','warning');
             history.go(-1);
        </script>
    <script src="{{url('js/jquery-3.4.1.js')}}"></script>
    <script src="{{url('js/sweetalert.min.js')}}"></script>
    </body>
</html>
