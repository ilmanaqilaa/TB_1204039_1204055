<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PembelianExcel implements FromCollection, WithHeadings
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

        return $list_laporan = DB::table('tb_pembelian')
        ->select(DB::raw('nama_inventaris, nama_kategori, nama_petugas, DATE_FORMAT(tgl_pembelian, "%d/%m/%Y"), tb_pembelian.satuan, tb_pembelian.jumlah, harga'))
        ->join('tb_inventaris','tb_pembelian.id_inventaris','=','tb_inventaris.id_inventaris')
        ->join('tb_petugas','tb_petugas.id_petugas','=','tb_pembelian.id_petugas')
        ->join('tb_kategori_invetaris','kategori','=','id_kategori')
        ->where('nama_kategori','like','%'.$kategori.'%')
        ->whereBetween('tgl_pembelian',[$tgl_awal,$tgl_akhir])
        ->orderBy('tb_pembelian.id_pembelian')
        ->get();
    }
    public function headings(): array
    {
        return [
            'Nama Inventaris',
            'Kategori Barang',
            'Penanggung Jawab',
            'Tanggal Pembelian',
            'Satuan',
            'Jumlah',
            'Harga'
        ];
    }
}
