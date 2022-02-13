<!-- Card Order User -->
<div class="row">
    <div class="col-md-12" style="margin-bottom: 20px;">
        <div class="text-center">
            <h2>Peminjaman Anda</h2>
        </div>
    </div>
</div>

<!-- Pemisah Card -->
<div class="row">
    <div class="col-md-12 mb-2">
        <h5>Order Dipinjam</h5>
        <hr class="col-12">
    </div>
</div>

<!-- Tampil Card Peminjamann Dipinjam -->
<div class="row">
    @foreach($list_peminjaman_dipinjam as $p)
    <div class="col-md-6 mb-4">
        <div class="card w-100 shadow-sm">
            <div class="card-body">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="card-text"><span class="font-weight-bold">Nama
                                    Barang</span><br>{{ $p->nama_inventaris }}</p>
                            <hr>
                            <small class="text-muted">{{ $p->keterangan }}</small>
                        </div>
                        <div class="col-md-6 mt-auto mb-auto">
                            @if($p->status == 'Dipinjam')
                            <div class="float-right">
                                <button class="btn btn-primary btn-sm"
                                    onclick="modalKembali('{{ $p->barang_pinjaman }}','{{ $p->id_peminjaman }}');">Kembalikan</button>
                            </div>
                            @elseif($p->status == 'Diperiksa')
                            <div class="float-right">
                                <button class="btn btn-secondary btn-sm" disabled>Diperiksa</button>
                            </div>
                            @else
                            <div class="float-right">
                                <button class="btn btn-success btn-sm" disabled>Kembali</button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- Pemisah Card -->
<div class="row">
    <div class="col-md-12 mb-2 mt-4">
        <h5>Order Kembali</h5>
        <hr class="col-12">
    </div>
</div>

<!-- Tampil Card Peminjamann Kembali -->
<div class="row">
    @foreach($list_peminjaman_kembali as $p)
    <div class="col-md-6 mb-4">
        <div class="card w-100 shadow-sm">
            <div class="card-body">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="card-text"><span class="font-weight-bold">Nama
                                    Barang</span><br>{{ $p->nama_inventaris }}</p>
                            <hr>
                            <small class="text-muted">{{ $p->keterangan }}</small>
                        </div>
                        <div class="col-md-6 mt-auto mb-auto">
                            @if($p->status == 'Dipinjam')
                            <div class="float-right">
                                <button class="btn btn-primary btn-sm"
                                    onclick="modalKembali('{{ $p->barang_pinjaman }}','{{ $p->id_peminjaman }}');">Kembalikan</button>
                            </div>
                            @elseif($p->status == 'Diperiksa')
                            <div class="float-right">
                                <button class="btn btn-secondary btn-sm" disabled>Diperiksa</button>
                            </div>
                            @else
                            <div class="float-right">
                                <button class="btn btn-success btn-sm" disabled>Kembali</button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- Modal Kembalikan Order -->
<div class="modal fade" id="modalKembaliOrder" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pengembalian Barang</h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/home/return" method="GET">
                    <input type="hidden" class="form-control" name="kolIdKembali" id="kolIdKembali" value="">
                    <input type="hidden" class="form-control" name="kolIdPenjKemb" id="kolIdPenjKemb" value="">
                    <label>Anda yakin akan mengembalikan barang ini?</label>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <input type="submit" class="btn btn-primary" value="Ya, Barang Kembali">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Modal Kembalikan Order -->
<!-- Javascript Embed -->
<script>
    //Function Munculin Modal Kembali
    function modalKembali(idInventaris, idPenj) {
        $('#modalKembaliOrder').modal('toggle');
        $('#kolIdKembali').val(idInventaris);
        $('#kolIdPenjKemb').val(idPenj);
    }
</script>
<!-- /Javascript Embed -->
<!-- /Card Order User -->