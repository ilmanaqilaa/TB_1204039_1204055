<html>

<head>
    <title>Laporan Peminjaman BengRPL</title>
</head>

<style>
    h3 {
        text-align: center;
        margin-bottom: 48px;
    }

    table,
    th,
    td {
        border: 1px solid rgb(133, 133, 133);
        border-collapse: collapse;
    }

    th {
        text-align: center;
        padding: 10px 5px;
        background-color: rgb(98, 152, 214)
    }

    td {
        padding: 10px 5px;
        text-align: left;
    }
</style>

<body>

    <h3>LAPORAN PEMINJAMAN BENGRPL</h3>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Barang Pinjaman</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach($peminjaman as $p)
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
</body>

</html>