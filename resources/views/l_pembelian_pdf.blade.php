<html>

<head>
    <title>Laporan Pembelian BengRPL</title>
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

    <h3>LAPORAN PEMBELIAN BENGRPL</h3>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Inventaris</th>
                <th>Kategori Barang</th>
                <th>Penanggung Jawab</th>
                <th>Tanggal Pembelian</th>
                <th>Satuan</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach($pembelian as $p)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $p->nama_inventaris }}</td>
                <td>{{ $p->nama_kategori }}</td>
                <td>{{ $p->nama_petugas }}</td>
                <td>{{ date('d/m/Y', strtotime($p->tgl_pembelian)) }}</td>
                <td>{{ $p->satuan }}</td>
                <td>{{ $p->jumlah }}</td>
                <td>{{ $p->harga }}</td>
            </tr>
            @php $i++; @endphp
            @endforeach
        </tbody>
    </table>
</body>

</html>