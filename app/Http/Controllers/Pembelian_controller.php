<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Pembelian_controller extends Controller
{
    public function index(Request $request){
        //Ambil data pembelian
        $list_pemb = DB::table('tb_pembelian')
        ->select('tb_pembelian.id_inventaris', 'tb_inventaris.nama_inventaris', 'tb_kategori_invetaris.nama_kategori', 'tb_pembelian.tgl_pembelian')
        ->join('tb_inventaris','tb_inventaris.id_inventaris','=','tb_pembelian.id_inventaris')
        ->join('tb_kategori_invetaris','id_kategori','=','kategori')
        ->orderBy('tgl_pembelian')
        ->get();
        
        //Ambil data kategori inventaris
        $list_kategori_inv = DB::table('tb_kategori_invetaris')
        ->select('nama_kategori')
        ->orderBy('nama_kategori')
        ->get();

        return view('pembelian',['list_pembelian' => $list_pemb, 'list_kategori_inv' => $list_kategori_inv]);
    }
    public function tambah_pembelian(Request $request){
        
        //Ambil data input pembelian
        $kategoriInv = $request->pilihKategori;
            //Ambil id_kategori
            $kategoriInv = DB::table('tb_kategori_invetaris')
            ->select('id_kategori')
            ->where('nama_kategori',$kategoriInv)
            ->get();
                //Keluarin value dari obj hasil query builder
                foreach($kategoriInv as $k){
                    $kategoriInv = $k;
                }
                foreach($kategoriInv as $k){
                    $kategoriInv = $k;
                }
        $namaInv = $request->kolNamaInv;
        $tglBeliInv = date_create($request->kolTglBeli);
            //Reformat tgl
            $tglBeliInv = date_format($tglBeliInv,'Y-m-d');
        $hargaInv = $request->kolHargaInv;
        $satuanInv = $request->pilihSatuanInv;
        $jumlahInv = $request->kolJumlahInv;

        //Buat id_pembelian baru
        $idPembelianTerakhir = DB::table("tb_pembelian")
        ->select('id_pembelian')
        ->orderBy('id_pembelian','desc')
        ->limit(1)
        ->get();
        $idpembterakhir = '';
        foreach($idPembelianTerakhir as $id){
            $idpembterakhir = $id->id_pembelian;
        }

        if(empty($idpembterakhir)){
            $idPembelianBaru = 'BL0001';
        }
        else{
            //Mengambil angka dari string id yang diambil
            preg_match_all('!\d+!', $idpembterakhir, $angkanyabeli);
            //Nested array loop
            foreach($angkanyabeli as $angka){
                $angkatambahbeli = $angka;
            }
            foreach($angkatambahbeli as $angka){
                $idIncrementBeli = $angka;
            }

            $idIncrementBeli += 1;
            $idPembelianBaru = str_pad($idIncrementBeli, 4, '0', STR_PAD_LEFT);
            $idPembelianBaru = "BL".$idPembelianBaru;
        }

        //Buat id_inventaris baru
        $idInventarisTerakhir = DB::table("tb_inventaris")
        ->select('id_inventaris')
        ->orderBy('id_inventaris','desc')
        ->limit(1)
        ->get();
        $idinvterakhir = '';
        foreach($idInventarisTerakhir as $id){
            $idinvterakhir = $id->id_inventaris;
        }

        if(empty($idinvterakhir)){
            $idInventarisBaru = 'BR0001';
        }
        else{
            //Mengambil angka dari string id yang diambil
            preg_match_all('!\d+!', $idinvterakhir, $angkanyainv);
            //Nested array loop
            foreach($angkanyainv as $angka){
                $angkatambahinv = $angka;
            }
            foreach($angkatambahinv as $angka){
                $idIncrementInv = $angka;
            }

            $idIncrementInv += 1;
            $idInventarisBaru = str_pad($idIncrementInv, 4, '0', STR_PAD_LEFT);
            $idInventarisBaru = "BR".$idInventarisBaru;
        }

        //Input ke tb_inventaris
        DB::table('tb_inventaris')
        ->insert([
            'id_inventaris' => $idInventarisBaru,
            'nama_inventaris' => $namaInv,
            'kategori' => $kategoriInv,
            'satuan' => $satuanInv,
            'jumlah' => $jumlahInv,
            'status' => 'Tersedia'
        ]);

        //Input ke tb_pembelian
        DB::table('tb_pembelian')
        ->insert([
            'id_pembelian' => $idPembelianBaru,
            'id_inventaris' => $idInventarisBaru,
            'id_petugas' => $request->session()->get('nologin'),
            'tgl_pembelian' => $tglBeliInv,
            'satuan' => $satuanInv,
            'jumlah' => $jumlahInv,
            'harga' => $hargaInv
        ]);

        return redirect('/pembelian');
    }
}
