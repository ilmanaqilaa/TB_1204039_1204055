<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Inventaris_controller extends Controller
{
    public function index(Request $request){
        //pengecekan session
        if($request->session()->get('userlogin')){
            //Menampilkan view home jika session not null

            //Mengambil data inventaris
            $list_inventaris = DB::table('tb_inventaris')
            ->join('tb_kategori_invetaris','kategori','=','tb_kategori_invetaris.id_kategori')
            ->select('tb_inventaris.*','tb_kategori_invetaris.nama_kategori')
            ->get();
            
            return view('inventaris',['list_inventaris' => $list_inventaris]);
        }else{
            //menampilkan view login jika session null
            return view('login');
        }
    }
}
