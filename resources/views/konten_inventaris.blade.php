<!-- Content Halaman Admin -->
@section('tabel_inventaris')
<div class="row">
    <div class="col-md-12" style="margin-bottom: 20px;">
        <div class="text-center">
            <h2>Data Inventaris</h2>
        </div>
    </div>
    <!-- Modal Pinjam -->
    <div class="modal fade" id="modal-pinjam" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>hi</h4>
                </div>
                <div class="modal-body">
                    dada
                </div>
                <div class="modal-footer">
                    da
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal Pinjam -->
    <!-- Tabel Inventaris -->
    <div class="col-md-12">
        <div class="fresh-table toolbar-color-blue">
            <div class="toolbar">
            </div>
            <table id="fresh-table" class="table">
                <thead>
                    <th data-field="No" data-sortable="true">#</th>
                    <th data-field="Peminjam" data-sortable="true">Nama Barang</th>
                    <th>Jumlah Barang</th>
                    <th data-field="Barang_Pinjaman" data-sortable="true">Status Barang</th>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach($list_inventaris as $l)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $l->nama_inventaris }}</td>
                        <td>{{ $l->jumlah }}</td>
                        <td>{{ $l->status }}</td>
                    </tr>
                    @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /Tabel Inventaris -->
</div>
@endsection
<!-- /Content Halaman Admin -->

<!---------------------------------------------------------------------------->

<!-- Content Halaman Peminjam -->
@section('card_inventaris')
<div class="row">
    <div class="col-md-12" style="margin-bottom: 20px;">
        <h2 class="text-center">Daftar Inventaris Bengkel</h2>
    </div>
</div>

<!-- Modal Pinjam Barang -->
<div class="modal fade" id="modalOrderPeminjaman" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="idPinjaman">Id Barang</h5>
                <button type="button" class="close" onclick="clearModal()" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/home/add" method="GET" onsubmit="return cekkolom()">
                    <label class="font-weight-bold">Nama Barang</label>
                    <br>
                    <label id="namaPinjaman">Nama Barang</label>
                    <input type="hidden" id="kolIdPinjaman" name="kolIdPinjaman">
                    <br><br>
                    <label class="font-weight-bold">Keterangan Peminjaman</label>
                    <textarea class="form-control" id="areaKeterangan" name="areaKeterangan"
                        placeholder="Isi keterangan di sini"></textarea>
                
                <script>
                    function cekkolom() {
                        var kol = document.getElementById('areaKeterangan').value;
                        if (kol.length < 1) {
                            swal('Peringatan', 'Kolom Keterangan Masih Kosong!', 'warning');
                            return false;
                        }
                        else {
                            return true;
                        }
                    }
                </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    onclick="clearModal()">Batal</button>
                <input type="submit" class="btn btn-primary" value="Pinjam Inventaris">
            </form>
            </div>
        </div>
    </div>
</div>
<script>
    function clearModal() {
        $('#areaKeterangan').val('');
    }
</script>
<!-- /Modal Pinjam Barang -->

<div class="row">
    @foreach($list_inventaris as $l)
    <div class="col-md-3 mt-4">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{ $l->nama_inventaris }}</h5>
                <p class="card-text">{{ $l->nama_kategori }}</p>
                @if($l->status == 'Dipinjam')
                <button href="#" class="btn btn-primary" disabled>Dipinjam</button>
                @else
                <button href="#" class="btn btn-primary"
                    onclick="modalPinjam('{{ $l->id_inventaris }}','{{ $l->nama_inventaris }}')">Pinjam</button>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
<script>
    //Function Muncul Modal Pinjam Barang Yang Diklik
    function modalPinjam(idInventaris, namaInventaris) {
        $('#modalOrderPeminjaman').modal('toggle');
        $('#idPinjaman').html(idInventaris);
        $('#namaPinjaman').html(namaInventaris);
        $('#kolIdPinjaman').val(idInventaris);
    }
</script>
@endsection
<!-- /Content Halaman Peminjam -->