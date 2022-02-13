<!-- Tabel Order Admin -->
<div class="row">
    <div class="col-md-12" style="margin-bottom: 20px;">
        <div class="text-center">
            <h2>Data Peminjaman</h2>
        </div>
        <div class="float-right">
            <button class="btn btn-primary" onclick="modalPembelianBaru();"><i class="fa fa-plus pr-3"></i>Tambah Peminjaman</button>
        </div>
    </div>
    <div class="col-md-12">
        <table class="table">
            <thead>
                <th>#</th>
                <th>Peminjam</th>
                <th>Barang Pinjaman</th>
                <th>Tanggal Pinjam</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @php
                $i = 1;
                @endphp
                @foreach($list_peminjaman as $p)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $p->nama_user }}</td>
                    <td>{{ $p->nama_inventaris }}</td>
                    <td>{{ date('d/m/Y', strtotime($p->tanggal_pinjam)) }}</td>
                    <td>{{ $p->keterangan }}</td>
                    <td>
                        @if($p->status == "Dipinjam")
                        <badge class="badge badge-primary">
                        @elseif($p->status == "Diperiksa")
                        <badge class="badge badge-warning">
                        @else
                        <badge class="badge badge-success">
                        @endif
                            {{ $p->status }}                     
                        </badge>
                    </td>
                    <td>
                    @if($p->status == "Diperiksa")
                        <button class="btn btn-primary btn-sm" onclick="modalPeriksaOrder('{{ $p->id_peminjaman }}','{{ $p->nama_inventaris }}','{{ $p->barang_pinjaman }}')"><i class="fa fa-check"></i></button>
                    @endif
                    </td>
                </tr>
                @php $i++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- /Tabel Order Admin -->

<!-- Script Buka Modal pada order yang akan dikonfirmasi -->

<script>
    function modalPeriksaOrder(idOrder,namaBarangKonfirm,idBarang){
        $('#modalPeriksaOrder').modal('toggle');
        $('#kolIdKonfirm').val(idOrder);
        $('#namaBarangKonfirm').html(namaBarangKonfirm);
        $('#kolBarangKonfirm').val(idBarang);
    }
</script>
<!-- JS -->
    <script>
        function modalPembelianBaru(){
            $('#modalTambahPembelian').modal('toggle');
        }

        function cekKolModKosong(){
            var peminjamI = document.getElementById('pilihPeminjam').value;
            var barangI = document.getElementById('pilihBarang').value;
            var tglI = document.getElementById('kolTglPinjam').value;
            var ketI = document.getElementById('areaKeterangan').value;

            if(cek(peminjamI,'Peminjam Barang Belum Diisi!')){
                if(cek(barangI,'Barang Dipinjam Belum Diisi!')){
                    if(cek(tglI,'Tanggal Pinjam Belum Diisi!')){
                        if(cek(ketI,'Keterangan Pinjam Belum Diisi!')){
                            return true;
                        };
                    };
                };
            };

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

<!-- /Script Buka Modal pada order yang akan dikonfirmasi -->
<!-- Modal Periksa Order -->
<div class="modal fade" id="modalPeriksaOrder" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Pengembalian</h5>
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="/home/confirmReturn" method="GET">
                    <h6>Nama Barang</h6>
                    <p id="namaBarangKonfirm"></p>
                    <hr>
                    <input type="hidden" name="kolIdKonfirm" id="kolIdKonfirm" value="">
                    <label>Anda yakin barang sudah dikembalikan oleh peminjam? Pastikan barang sudah ada di bengkel.</label>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <input type="submit" class="btn btn-primary" value="Sudah Kembali">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Modal Periksa Order -->
<!-- Modal Tambah Peminjaman -->
<div class="modal fade" id="modalTambahPembelian" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Peminjaman Inventaris Baru</h5>
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="/home/addadmin" method="GET" onsubmit="return cekKolModKosong()">
                    <label>Nama Peminjam</label><br>
                    <select class="form-control mb-3" name="pilihPeminjam" id="pilihPeminjam">
                        <option>---Silakan Pilih---</option>
                        @foreach($list_peminjam as $lp)
                            <option value="{{ $lp->nomor_user }}">{{ $lp->nama_user }}</option>
                        @endforeach     
                    </select>
                
                    <label>Nama Barang</label><br>
                    <select class="form-control" name="pilihBarang" id="pilihBarang">
                        <option>---Silakan Pilih---</option>
                        @foreach($list_inventaris as $li)
                            <option value="{{ $li->id_inventaris }}">{{ $li->nama_inventaris }}</option>
                        @endforeach
                    </select>

                    <label class="label-modal">Tanggal Pinjam</label><br>
                    <input type="date" class="form-control mb-1" name="kolTglPinjam" id="kolTglPinjam">

                    <label class="label-modal">Keterangan Peminjaman</label>
                    <textarea class="form-control" id="areaKeterangan" name="areaKeterangan"
                        placeholder="Isi keterangan di sini"></textarea>
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
