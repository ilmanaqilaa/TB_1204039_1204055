<!DOCTYPE html>
@php $halaman='peminjam'; @endphp
<html lang="en">
<head>
    @include('head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BengRPL - Data Peminjam</title>
</head>
<body>
    <div class="wrapper">
        @include('sidebar')
        <div id="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Judul Halaman -->
                    <div class="col-md-12" style="margin-bottom: 20px;">
                        <div class="text-center">
                            <h2>Data Peminjam</h2>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-primary" onclick="modalPeminjamBaru()"><i class="fa fa-plus pr-3"></i>Tambah User</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Tabel Data Peminjam -->
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <th>#</th>
                                <th>Nomor User</th>
                                <th>Nama User</th>
                                <th>Jenis User</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @php  
                                $i = 1;
                                @endphp
                                @foreach($list_peminjam as $l)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $l->nomor_user }}</td>
                                    <td>{{ $l->nama_user }}</td>
                                    <td>{{ $l->jenis_user }}</td>
                                    <td>{{ $l->email }}</td>
                                    <td>{{ $l->telpon }}</td>
                                    <td>
                                        <button class="btn btn-success" onclick="modalEditPeminjam({{ $l->nomor_user }})">Edit</button>
                                        <button class="btn btn-danger" onclick="modalHapusPeminjam({{ $l->nomor_user }})">Hapus</button>
                                    </td>
                                </tr>
                                @php $i++; @endphp
                                @endforeach()
                            </tbody>
                        </table>
                        <!-- Modal Tambah Peminjaman -->
                        <div class="modal fade" id="modalTambahPeminjam" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Data Peminjam Baru</h5>
                                        <button class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/peminjam/add" method="POST" onsubmit="return cekKolModKosong()">
                                        @csrf
                                            <label>Nama Peminjam</label><br>
                                            <input type="text" class="form-control mb-3" name="kolNamaPeminjam" id="kolNamaPeminjam">

                                            <label>Email Peminjam</label><br>
                                            <input type="email" class="form-control mb-3" name="kolEmail" id="kolEmailPeminjam">

                                            <label>Telepon Peminjam</label><br>
                                            <input type="number" class="form-control mb-3" name="kolTelepon" id="kolTeleponPeminjam">

                                            <label>Jenis Peminjam</label><br>
                                            <select class="form-control mb-3" name="pilihJenis" id="pilihJenis">
                                                <option>---Silakan Pilih---</option>
                                                <option value="Murid">Murid</option>
                                                <option value="Guru">Guru</option>
                                                <option value="Mahasiswa">Mahasiswa</option>
                                                <option value="Dosen">Dosen</option>
                                            </select>

                                            <label>Password Peminjam</label><br>
                                            <input type="password" class="form-control mb-3" name="kolPasswordPeminjam" id="kolPasswordPeminjam">

                                            <label>Konfirmasi Password Peminjam</label><br>
                                            <input type="password" class="form-control mb-1" name="kolKonfirmasiPasswordPeminjam" id="kolKonfirmasiPasswordPeminjam">
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <input type="submit" class="btn btn-primary" value="Simpan">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Tambah Peminjaman -->
                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEditPeminjam" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Ubah Data Peminjam</h5>
                                        <button class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/peminjam/edit" method="POST" onsubmit="return cekKolModKosong2()">
                                        @csrf
                                            <label>Nama Peminjam</label><br>
                                            <input type="text" class="form-control mb-3" name="kolNamaPeminjam" id="kolNamaPeminjam2">
                                            <input type="hidden" value="" id="kolID" name="kolID">

                                            <label>Email Peminjam</label><br>
                                            <input type="email" class="form-control mb-3" name="kolEmail" id="kolEmail">

                                            <label>Telepon Peminjam</label><br>
                                            <input type="number" class="form-control mb-3" name="kolTelepon" id="kolTelepon">

                                            <label>Jenis Peminjam</label><br>
                                            <select class="form-control mb-3" name="pilihJenis" id="pilihJenis2">
                                                <option>---Silakan Pilih---</option>
                                                <option value="Murid">Murid</option>
                                                <option value="Guru">Guru</option>
                                                <option value="Mahasiswa">Mahasiswa</option>
                                                <option value="Dosen">Dosen</option>
                                            </select>

                                            <label>Password Peminjam</label><br>
                                            <input type="password" class="form-control mb-3" name="kolPasswordPeminjam" id="kolPasswordPeminjam2">

                                            <label>Konfirmasi Password Peminjam</label><br>
                                            <input type="password" class="form-control mb-1" name="kolKonfirmasiPasswordPeminjam" id="kolKonfirmasiPasswordPeminjam2">
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <input type="submit" class="btn btn-primary" value="Simpan">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function stringContainsNumber(_string) {
            return /\d/.test(_string);
        }

        function modalPeminjamBaru(){
            $('#modalTambahPeminjam').modal('toggle');
        }

        function modalEditPeminjam(id){
            $.ajax({url: "/peminjam/"+id, success: function(result){
                document.getElementById('kolID').value = result['nomor_user'];
                document.getElementById('kolNamaPeminjam2').value = result['nama_user'];
                document.getElementById('kolEmail').value = result['email'];
                document.getElementById('kolTelepon').value = result['telpon'];
                document.getElementById('pilihJenis2').value = result['jenis_user'];
                document.getElementById('kolPasswordPeminjam2').value = result['password'];
                document.getElementById('kolKonfirmasiPasswordPeminjam2').value = result['password'];
            }});       
            $('#modalEditPeminjam').modal('toggle');
        }

        function modalHapusPeminjam(id){
            var idUser = id;
            swal({
                title: "Hapus Data?",
                text: "Anda yakin ingin menghapus data peminjam ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((result) => {
                    $.ajax({url: "/peminjam/delete/"+id, success: function(result){
                        location.reload()
                    }});    
            });
        }

        function cekKolModKosong(){
            var namaPeminjam = document.getElementById('kolNamaPeminjam').value;
            var jenisPeminjam = document.getElementById('pilihJenis').value;
            var passwordPeminjam = document.getElementById('kolPasswordPeminjam').value;
            var konfPasswordPeminjam = document.getElementById('kolKonfirmasiPasswordPeminjam').value;

            if(cek(namaPeminjam,'Nama Peminjam Belum Diisi!')){
                if(!stringContainsNumber(namaPeminjam)) {      
                    if(cek(jenisPeminjam,'Jenis Peminjam Belum Diisi!')){
                        if(cek(passwordPeminjam,'Password Peminjam Belum Diisi!')){
                            if(cek(konfPasswordPeminjam,'Konfirmasi Password Peminjam Belum Diisi!')){
                                if(passwordPeminjam != konfPasswordPeminjam) {
                                    swal("Peringatan","Password tidak cocok! Silakan periksa kembali",'warning');
                                    return false;
                                }
                                else {
                                    return true;
                                }
                            }
                        }
                    }
                }else {
                    swal("Peringatan","Nama tidak boleh mengandung angka!",'warning');
                    return false;
                }
            }

            return false;
        }

        function cekKolModKosong2(){
            var namaPeminjam = document.getElementById('kolNamaPeminjam2').value;
            var jenisPeminjam = document.getElementById('pilihJenis2').value;
            var passwordPeminjam = document.getElementById('kolPasswordPeminjam2').value;
            var konfPasswordPeminjam = document.getElementById('kolKonfirmasiPasswordPeminjam2').value;

            if(cek(namaPeminjam,'Nama Peminjam Belum Diisi!')){
                if(!stringContainsNumber(namaPeminjam)) {      
                    if(cek(jenisPeminjam,'Jenis Peminjam Belum Diisi!')){
                        if(cek(passwordPeminjam,'Password Peminjam Belum Diisi!')){
                            if(cek(konfPasswordPeminjam,'Konfirmasi Password Peminjam Belum Diisi!')){
                                if(passwordPeminjam != konfPasswordPeminjam) {
                                    swal("Peringatan","Password tidak cocok! Silakan periksa kembali",'warning');
                                    return false;
                                }
                                else {
                                    return true;
                                }
                            }
                        }
                    }
                }else {
                    swal("Peringatan","Nama tidak boleh mengandung angka!",'warning');
                    return false;
                }
            }

            return false;
        }

        function cek(namaKolom, pesan){
            if(namaKolom.length == 0 || namaKolom == '---Silakan Pilih---'){
                swal("Peringatan",pesan,'warning');
                return false;
            }   
            return true;
        }
    </script>
    @include('footer')
</body>
</html>