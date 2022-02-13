<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PDF;

use App\Exports\PeminjamanExcel;
use App\Exports\PembelianExcel;
use Maatwebsite\Excel\Facades\Excel;

class Laporan_controller extends Controller
{
    public function index(Request $request){

        //query ambil kategori barang filter laporan

        $list_kategori = DB::table('tb_kategori_invetaris')->get();
        return view('laporan',['list_kategori' => $list_kategori]);
    }

    public function l_peminjaman(Request $request){

        //Pengambilan value dari form card peminjaman
        $kategori = $request->pilihKategori1;
        $tgl_awal = $request->pilihTglAwal1;
        $tgl_akhir = $request->pilihTglAkhir1;
        $formatEks = $request->radPeminjaman;

        //Check form jika value default
        if($kategori == "---Semua---"){
            $kategori = "";
        }

        //Query buat laporan
        $list_laporan = DB::table('tb_peminjaman')
        ->select('nama_user','nama_inventaris','tanggal_pinjam','tgl_kembali','keterangan')
        ->join('tb_inventaris','barang_pinjaman','=','id_inventaris')
        ->join('tb_user','id_peminjam','nomor_user')
        ->join('tb_pengembalian','tb_pengembalian.id_peminjaman','=','tb_peminjaman.id_peminjaman')
        ->join('tb_kategori_invetaris','kategori','=','id_kategori')
        ->where('nama_kategori','like','%'.$kategori.'%')
        ->whereBetween('tanggal_pinjam',[$tgl_awal,$tgl_akhir])
        ->orderBy('tb_peminjaman.id_peminjaman')
        ->get();

        //dd($list_laporan);
        
        //pengecekan format eksport
        if($formatEks == 'PDF'){
            $pdf = PDF::loadview('l_peminjaman_pdf',['peminjaman' => $list_laporan]);
            return $pdf->stream();
        }
        else if($formatEks == 'EXCEL'){
            $dataExport = [
                'kategori' => $kategori,
                'tgl_awal' => $tgl_awal,
                'tgl_akhir' => $tgl_akhir
            ];

            return Excel::download(new PeminjamanExcel($dataExport), 'Laporan Peminjaman BengRPL.xlsx');
        }
    
    }

    public function l_pembelian(Request $request){
        //Pengambilan value dari form card peminjaman
        $kategori = $request->pilihKategori2;
        $tgl_awal = $request->pilihTglAwal2;
        $tgl_akhir = $request->pilihTglAkhir2;
        $formatEks = $request->radPembelian;

        //Check form jika value default
        if($kategori == "---Semua---"){
            $kategori = "";
        }

        //Query buat laporan
        $list_laporan = DB::table('tb_pembelian')
        ->select('nama_inventaris','nama_kategori','nama_petugas','tgl_pembelian','tb_pembelian.satuan','tb_pembelian.jumlah','harga')
        ->join('tb_inventaris','tb_pembelian.id_inventaris','=','tb_inventaris.id_inventaris')
        ->join('tb_petugas','tb_petugas.id_petugas','=','tb_pembelian.id_petugas')
        ->join('tb_kategori_invetaris','kategori','=','id_kategori')
        ->where('nama_kategori','like','%'.$kategori.'%')
        ->whereBetween('tgl_pembelian',[$tgl_awal,$tgl_akhir])
        ->orderBy('tb_pembelian.id_pembelian')
        ->get();

        //pengecekan format eksport
        if($formatEks == 'PDF'){
            $pdf = PDF::loadview('l_pembelian_pdf',['pembelian' => $list_laporan]);
            return $pdf->stream();
        }
        else if($formatEks == 'EXCEL'){
            $dataExport = [
                'kategori' => $kategori,
                'tgl_awal' => $tgl_awal,
                'tgl_akhir' => $tgl_akhir
            ];
            return Excel::download(new PembelianExcel($dataExport), 'Laporan Pembelian BengRPL.xlsx');
        }
    }
}
