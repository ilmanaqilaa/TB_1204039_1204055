<html>
    @php $halaman='pembelian'; @endphp
<head>
    <!-- Web Head (Include Dependencies) -->
    @include('head')
    <title>BengRPL - Pembelian</title>
</head>
<body>
    <div class="wrapper">
        <!-- Include Sidebar -->
        @include('sidebar')

        <!-- Page Content -->
        <div id="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Judul Halaman -->
                    <div class="col-md-12" style="margin-bottom: 20px;">
                        <div class="text-center">
                            <h2>Pembelian</h2>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-primary" onclick="modalPembelianBaru();"><i class="fa fa-plus pr-3"></i>Tambah Pembelian</button>
                        </div>
                    </div>
                    <!-- Tabel Pembelian -->
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <th>#</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Tanggal Pembelian</th>
                                <!--<th>Rincian</th>-->
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @foreach($list_pembelian as $l)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $l->id_inventaris }}</td>
                                    <td>{{ $l->nama_inventaris }}</td>
                                    <td>{{ $l->nama_kategori }}</td>
                                    <td>{{ date('d/m/Y', strtotime($l->tgl_pembelian)) }}</td>
                                    <!--<td><button class="btn-sm btn-primary"><i class="fa fa-hamburger"></i></button></td>-->
                                </tr>
                                @php $i++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Pembelian -->
    <div class="modal fade" id="modalTambahPembelian" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pembelian Inventaris Baru</h5>
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="/pembelian/tambah" method="GET" onsubmit="return cekKolModKosong()">
                        <label>Kategori Barang</label><br>
                        <select class="form-control" name="pilihKategori" id="pilihKategori">
                            <option>---Silakan Pilih---</option>
                            @foreach($list_kategori_inv as $kt)
                                <option>{{ $kt->nama_kategori }}</option>
                            @endforeach
                        </select>
                        
                        <label class="label-modal">Nama Barang</label><br>
                        <input type="text" class="form-control" name="kolNamaInv" id="kolNamaInv" placeholder="Isi nama inventaris baru di sini">

                        <label class="label-modal">Tanggal Pembelian</label><br>
                        <input type="date" class="form-control" name="kolTglBeli" id="kolTglBeli" onchange="cekRangeTanggal()">

                        <label class="label-modal">Harga Beli</label><br>
                        <input type="number" class="form-control" name="kolHargaInv" id="kolHargaInv">
                
                        <label class="label-modal">Satuan Barang</label><br>
                        <select class="form-control" name="pilihSatuanInv" id="pilihSatuanInv">
                            <option>---Silakan Pilih---</option>
                            <option>Unit</option>
                            <option>Set</option>
                        </select>

                        <label class="label-modal">Jumlah</label><br>
                        <input type="number" class="form-control" name="kolJumlahInv" id="kolJumlahInv">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-primary" value="Simpan">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- JS -->
    <script>
        function modalPembelianBaru(){
            $('#modalTambahPembelian').modal('toggle');
        }

        function cekKolModKosong(){
            var kategoriI = document.getElementById('pilihKategori').value;
            var namaI = document.getElementById('kolNamaInv').value;
            var tglI = document.getElementById('kolTglBeli').value;
            var hargaI = document.getElementById('kolHargaInv').value;
            var satuanI = document.getElementById('pilihSatuanInv').value;
            var jumlahI = document.getElementById('kolJumlahInv').value;

            var getTgl = document.getElementById("kolTglBeli").value

            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;

            if (getTgl > today) {
                swal('Peringatan','Rentang Tanggal Tidak Benar!','warning');
                console.log(getTgl+"|"+today)
                return false;
            }

            if(cek(kategoriI,'Kategori Inventaris Belum Dipilih!')){
                if(cek(namaI,'Nama Inventaris Belum Diisi!')){
                    if(cek(tglI,'Tanggal Pembelian Belum Diisi!')){
                        if(cek(hargaI,'Harga Beli Inventaris Belum Diisi!')){
                            if(hargaI >= 0) {       
                                if(cek(satuanI,'Satuan Barang Belum Diisi!')){
                                    if(cek(jumlahI,'Jumlah Barang Belum Diisi!')){
                                        if(jumlahI >= 0) {
                                            return true;
                                        }else {
                                            swal("Peringatan","Jumlah barang tidak bisa minus!",'warning');
                                            return false;
                                        }
                                    }
                                }
                            }else {
                                swal("Peringatan","Harga tidak bisa minus!",'warning');
                                return false;
                            }
                        }
                    }
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

        function cekRangeTanggal() {
            var getTgl = document.getElementById("kolTglBeli").value

            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;

            if (getTgl > today) {
                swal('Peringatan','Rentang Tanggal Tidak Benar!','warning');
                console.log(getTgl+"|"+today)
                return false;
            }
        }
    </script>
    <!-- Jquery -->
    @include('footer')
</body>
</html>