<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Riwayat_order_controller extends Controller
{
    public function index(Request $request){
        //pengecekan session
        if($request->session()->get('userlogin') == 'Admin'){
            //menampilkan view home jika session not null
            $list_peminjaman = DB::table('tb_peminjaman')
            ->select('nama_user','nama_inventaris','tanggal_pinjam','keterangan','tgl_kembali')
            ->join('tb_user','id_peminjam','=','nomor_user')
            ->join('tb_inventaris','barang_pinjaman','=','id_inventaris')
            ->join('tb_pengembalian','tb_pengembalian.id_peminjaman','=','tb_peminjaman.id_peminjaman')
            ->where('tb_peminjaman.status','=','Kembali')
            ->get();
            return view('riwayat_order',['list_peminjaman' => $list_peminjaman]);
        }
        else if($request->session()->get('userlogin') != 'Admin'){
            //menampilkan view home jika session not null
            $list_peminjaman = DB::table('tb_peminjaman')
            ->select('nama_user','nama_inventaris','tanggal_pinjam','keterangan')
            ->join('tb_user','id_peminjam','=','nomor_user')
            ->join('tb_inventaris','barang_pinjaman','=','id_inventaris')
            ->where('tb_peminjaman.status','=','Kembali')
            ->where('nomor_user','=',$request->session()->get('nologin'))
            ->get();
            return view('riwayat_order',['list_peminjaman' => $list_peminjaman]);
        }
        else if(!$request->session()->get('userlogin')){
            //menampilkan view login jika session null
            return view('login');
        }
    }
}
