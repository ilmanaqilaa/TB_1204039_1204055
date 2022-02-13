<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Login_controller extends Controller
{
    public function index(Request $request){
        //pengecekan session
        if($request->session()->get('userlogin')){
            //menampilkan view home jika session not null
            return redirect('/home');
        }else{
            //menampilkan view login jika session null
            return view('login');
        }
    }

    public function login(Request $request){
        $this->validate($request, [
            'nouser'=>'required',
            'passuser'=>'required',
        ]);

        if($request->radioLogin == "Petugas"){
            $dataget = DB::table('tb_petugas')
                ->where('id_petugas',$request->nouser)
                ->where('password',$request->passuser)
                ->get();
        }
        else if($request->radioLogin == "Peminjam"){
            $dataget = DB::table('tb_user')
            ->where('nomor_user',$request->nouser)
            ->where('password',$request->passuser)
            ->get();
        }
        
        $row = $dataget->count();
        if($row == 1){
            foreach($dataget as $data){
                $request->session()->put('userlogin',$data->jenis_user);
                if($request->radioLogin == "Petugas"){
                    $request->session()->put('nologin',$data->id_petugas);
                }
                else{
                    $request->session()->put('nologin',$data->nomor_user);
                }
                
            }
            return redirect('/home');
        }else{
            $request->session()->flash('message','Username atau Password salah!');
            return redirect('/login');
        }
    }

    public function gagal_login(){
        return view('gagal_login');
    }
}
