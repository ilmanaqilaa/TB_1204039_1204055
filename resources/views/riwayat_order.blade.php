<html>
@php $halaman='riwayat_order_p'; @endphp

<head>
    <!-- Web Head (Include Dependencies) -->
    @include('head')
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        @include('sidebar')

        <!-- Page Content -->
        <div id="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 20px;">
                        <div class="text-center">
                            <h2>Riwayat Peminjaman</h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table id="fresh-table" class="table">
                            <thead>
                                <th data-field="No" data-sortable="true">#</th>
                                <th data-field="Peminjam" data-sortable="true">Peminjam</th>
                                <th data-field="Barang_Pinjaman" data-sortable="true">Barang Pinjaman</th>
                                <th data-field="Tanggal_Pinjam" data-sortable="true">Tanggal Pinjam</th>
                                <th data-field="Tanggal_Pinjam" data-sortable="true">Tanggal Kembali</th>
                                <th data-field="Keterangan" data-sortable="true">Keterangan</th>
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
                                    <td>{{ date('d/m/Y', strtotime($p->tgl_kembali)) }}</td>
                                    <td>{{ $p->keterangan }}</td>
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

    <!-- jQuery -->
    @include('footer')
</body>

</html>