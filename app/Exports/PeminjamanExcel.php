<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PeminjamanExcel implements FromCollection, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    private $dataExport;

    public function __construct($dataExport){
        $this->dataExport = $dataExport;
        
    }

    public function collection()
    {    
        $kategori = $this->dataExport['kategori'];
        $tgl_awal = $this->dataExport['tgl_awal'];
        $tgl_akhir = $this->dataExport['tgl_akhir'];

        return $list_laporan = DB::table('tb_peminjaman')
        ->select(DB::raw('nama_user, nama_inventaris, DATE_FORMAT(tanggal_pinjam, "%d/%m/%Y"), DATE_FORMAT(tgl_kembali, "%d/%m/%Y"), keterangan'))
        ->join('tb_inventaris','barang_pinjaman','=','id_inventaris')
        ->join('tb_user','id_peminjam','nomor_user')
        ->join('tb_pengembalian','tb_pengembalian.id_peminjaman','=','tb_peminjaman.id_peminjaman')
        ->join('tb_kategori_invetaris','kategori','=','id_kategori')
        ->where('nama_kategori','like','%'.$kategori.'%')
        ->whereBetween('tanggal_pinjam',[$tgl_awal,$tgl_akhir])
        ->orderBy('tb_peminjaman.id_peminjaman')
        ->get();
    }
    public function headings(): array
    {
        return [
            'Nama Peminjam',
            'Barang Pinjaman',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Keterangan'
        ];
    }
}
