<html>
@php $halaman='laporan'; @endphp
<head>
    <!-- Include Dependencies -->
    @include('head')
    <title>BengRPL - Laporan</title>
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
                            <h2>Laporan</h2>
                        </div>
                        <div class="float-right">

                        </div>
                    </div>
                </div>
                <!-- Card Buat Laporan -->
                <div class="row">

                    <!-- Card Laporan Peminjaman -->
                    <div class="col-md-6">
                        <div class="card shadow-lg card-laporan">
                            <div class="card-body">
                                <h5 class="text-center">Laporan Peminjaman</h5>
                                <form action="/laporan/peminjaman" method="get" onsubmit="return cekExport1()" target="_blank">
                                <label class="label-card">Kategori Barang</label class="label-card">
                                <select class="form-control" id="pilihKategori1" name="pilihKategori1">
                                    <option>
                                        ---Semua---
                                    </option>
                                    @foreach($list_kategori as $l)
                                        <option>{{ $l->nama_kategori }}</option>
                                    @endforeach
                                </select>

                                <label class="label-card">Tanggal Awal Peminjaman</label class="label-card">
                                <input type="date" class="form-control" id="pilihTglAwal1" name="pilihTglAwal1">

                                <label class="label-card">Tanggal Akhir Peminjaman</label>
                                <input type="date" class="form-control" id="pilihTglAkhir1" name="pilihTglAkhir1">

                                <label class="label-card">Format Export :</label><br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="radPDF1" name="radPeminjaman" value="PDF">
                                    <label class="custom-control-label" for="radPDF1">PDF</label>
                                </div>

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="radEXCEL1" name="radPeminjaman" value="EXCEL">
                                    <label class="custom-control-label" for="radEXCEL1">Excel (.xlsx)</label>
                                </div>  
                                
                                <input type="submit" class="form-control btn btn-primary mt-4" value="Buat Laporan">
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Script cek kolom  -->
                    <script>
                        function cekExport1(){
                            var tglAwal = document.getElementById('pilihTglAwal1').value;
                            var tglAkhir = document.getElementById('pilihTglAkhir1').value;
                            var rad1 = document.getElementById('radPDF1');
                            var rad2 = document.getElementById('radEXCEL1');

                                if((!tglAwal == '') || !(tglAkhir == '')){
                                    if(rad1.checked == true || rad2.checked == true){
                                        return true;
                                    }else{
                                        swal('Peringatan','Format Export belum dipilih!','warning');
                                        return false;
                                    }
                                }else{
                                    swal('Peringatan','Rentang Tanggal Laporan harus diisi!','warning');
                                    return false;
                                }
                               
                                
                        }
                        function cekExport2(){
                            var tglAwal = document.getElementById('pilihTglAwal2').value;
                            var tglAkhir = document.getElementById('pilihTglAkhir2').value;
                            var rad1 = document.getElementById('radPDF2');
                            var rad2 = document.getElementById('radEXCEL2');

                                if((!tglAwal == '') || !(tglAkhir == '')){
                                    if(rad1.checked == true || rad2.checked == true){
                                        return true;
                                    }
                                }
                                swal('Peringatan','Rentang Tanggal Laporan harus diisi!','warning');
                                return false;
                        }
                    </script>

                    <!-- Card Laporan Pembelian -->
                    <div class="col-md-6">
                        <div class="card shadow-lg card-laporan">
                            <div class="card-body">
                                <h5 class="text-center">Laporan Pembelian</h5>
                                <form action="/laporan/pembelian" method="get" onsubmit="return cekExport2()" target="_blank">
                                <label class="label-card">Kategori Barang</label class="label-card">
                                <select class="form-control" id="pilihKategori2" name="pilihKategori2">
                                    <option>
                                        ---Semua---
                                    </option>
                                    @foreach($list_kategori as $l)
                                        <option>{{ $l->nama_kategori }}</option>
                                    @endforeach
                                </select>

                                <label class="label-card">Tanggal Awal Pembelian</label class="label-card">
                                <input type="date" class="form-control" id="pilihTglAwal2" name="pilihTglAwal2">

                                <label class="label-card">Tanggal Akhir Pembelian</label>
                                <input type="date" class="form-control" id="pilihTglAkhir2" name="pilihTglAkhir2">
 
                                <label class="label-card">Format Export :</label><br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="radPDF2" name="radPembelian" value="PDF">
                                    <label class="custom-control-label" for="radPDF2">PDF</label>
                                </div>

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="radEXCEL2" name="radPembelian" value="EXCEL">
                                    <label class="custom-control-label" for="radEXCEL2">Excel (.xlsx)</label>
                                </div>     
                                
                                <input type="submit" class="form-control btn btn-primary mt-4" value="Buat Laporan">
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery -->
    @include('footer')
</body>

</html>