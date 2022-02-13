<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamController extends Controller
{
    public function index(Request $request){

        $list_peminjam = DB::table('tb_user')->get();
        return view('peminjam', ['list_peminjam' => $list_peminjam]);
    }

    public function detail($id) {
        $dataPeminjam = DB::table('tb_user')->where('nomor_user',$id)->first();
        return response()->json($dataPeminjam);
    }

    public function add(Request $request){
        DB::table('tb_user')
        ->insert([
            'nomor_user' => rand(100000,999999),
            'nama_user' => $request->kolNamaPeminjam,
            'jenis_user' => $request->pilihJenis,
            'password' => $request->kolKonfirmasiPasswordPeminjam,
        ]);

        return redirect('/peminjam');
    }

    public function edit(Request $request){
        DB::table('tb_user')
        ->where('nomor_user',$request->kolID)
        ->update([
            'nama_user' => $request->kolNamaPeminjam,
            'jenis_user' => $request->pilihJenis,
            'password' => $request->kolPasswordPeminjam
        ]);

        return redirect('/peminjam');
    }

    public function delete($id){
        DB::table('tb_user')
        ->where('nomor_user',$id)
        ->delete();

        return response()->json(['msg' => 'Delete Success']);
    }
}
