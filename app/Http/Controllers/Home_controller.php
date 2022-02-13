<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Home_controller extends Controller
{
    public function index(Request $request){
        //pengecekan session
        if($request->session()->get('userlogin') == 'Admin'){
            //menampilkan view home jika session not null
            $list_peminjaman = DB::table('tb_peminjaman')
            ->select('id_peminjaman','nama_user','barang_pinjaman' ,'nama_inventaris','tanggal_pinjam','keterangan','tb_peminjaman.status')
            ->join('tb_user','id_peminjam','=','nomor_user')
            ->join('tb_inventaris','barang_pinjaman','=','id_inventaris')
            ->where('tb_peminjaman.status','!=','Kembali')
            ->orderBy('id_peminjaman','desc')
            ->get();

            $list_inventaris = DB::table('tb_inventaris')
            ->select('nama_inventaris','id_inventaris')
            ->where('status','Tersedia')
            ->orderBy('nama_inventaris')
            ->get();

            $list_peminjam = DB::table('tb_user')
            ->select('nama_user','nomor_user')
            ->orderBy('nama_user')
            ->get();

            return view('home',['list_peminjaman' => $list_peminjaman, 'list_inventaris' => $list_inventaris, 'list_peminjam' => $list_peminjam]);
        }
        else if($request->session()->get('userlogin') != 'Admin'){
            //menampilkan view home jika session not null

            //query data peminjaman yang DIpinjam
            $list_peminjaman_dipinjam = DB::table('tb_peminjaman')
            ->select('id_peminjaman','nama_user','barang_pinjaman','nama_inventaris','tanggal_pinjam','keterangan','tb_peminjaman.status')
            ->join('tb_user','id_peminjam','=','nomor_user')
            ->join('tb_inventaris','barang_pinjaman','=','id_inventaris')
            ->where('id_peminjam','=',$request->session()->get('nologin'))
            ->where('tb_peminjaman.status','=','Dipinjam')
            ->orderBy('id_peminjaman','desc')
            ->get();

            //query data peminjaman yang Kembali
            $list_peminjaman_kembali = DB::table('tb_peminjaman')
            ->select('id_peminjaman','nama_user','barang_pinjaman','nama_inventaris','tanggal_pinjam','keterangan','tb_peminjaman.status')
            ->join('tb_user','id_peminjam','=','nomor_user')
            ->join('tb_inventaris','barang_pinjaman','=','id_inventaris')
            ->where('id_peminjam','=',$request->session()->get('nologin'))
            ->where('tb_peminjaman.status','=','Kembali')
            ->Orwhere('tb_peminjaman.status','=','Diperiksa')
            ->orderBy('id_peminjaman','desc')
            ->get();

            return view('home',['list_peminjaman_dipinjam' => $list_peminjaman_dipinjam, 'list_peminjaman_kembali' => $list_peminjaman_kembali]);
        }
        else if(!$request->session()->get('userlogin')){
            //menampilkan view login jika session null
            return view('login');
        }
    }

    public function logout(Request $request){
        $request->session()->forget('userlogin');
        return redirect('/login');
    }

    public function add_pinjam(Request $request){
        //pengambilan nilai dari kolom keterangan pinjam
        $idPinjam = $request->kolIdPinjaman;
        $namaPinjam = $request->kolNamaPinjaman;
        $keteranganPinjam = $request->areaKeterangan;

        //pembuatan id peminjaman baru
        $idPeminjamanTerakhir = DB::table('tb_peminjaman')
        ->select('id_peminjaman')
        ->orderBy('id_peminjaman','desc')
        ->limit(1)
        ->get();

        foreach($idPeminjamanTerakhir as $id){
            $idterakhir = $id->id_peminjaman;       
        }
        if(empty($idterakhir)){
            $idPeminjamanBaru = "PM0001";
        }
        else{
            //Mengambil angka dari string id yang diambil
            preg_match_all('!\d+!', $idterakhir, $angkanya);
            //Nested array loop
            foreach($angkanya as $angka){
                $angkatambah = $angka;
            }
            foreach($angkatambah as $angka){
                $idIncrement = $angka;
            }

            $idIncrement += 1;
            $idPeminjamanBaru = str_pad($idIncrement, 4, '0', STR_PAD_LEFT);
            $idPeminjamanBaru = "PM".$idPeminjamanBaru;
        }
         
        //insert peminjaman ke tb_peminjaman
        DB::table('tb_peminjaman')->insert([
            'id_peminjaman' => $idPeminjamanBaru,
            'id_peminjam' => $request->session()->get('nologin'),
            'barang_pinjaman' => $request->kolIdPinjaman,
            'tanggal_pinjam' => date('Y-m-d'),
            'keterangan' => $request->areaKeterangan,
            'status' => 'Dipinjam',
        ]);

        //direct ke halaman peminjaman
        return redirect('/home');
    }

    public function add_pinjam_admin(Request $request){
        //pengambilan nilai dari kolom keterangan pinjam
        $barangPinjam = $request->pilihBarang;
        $namaPinjam = $request->pilihPeminjam;
        $tglPinjam = $request->kolTglPinjam;
        $keteranganPinjam = $request->areaKeterangan;

        //pembuatan id peminjaman baru
        $idPeminjamanTerakhir = DB::table('tb_peminjaman')
        ->select('id_peminjaman')
        ->orderBy('id_peminjaman','desc')
        ->limit(1)
        ->get();

        foreach($idPeminjamanTerakhir as $id){
            $idterakhir = $id->id_peminjaman;       
        }
        if(empty($idterakhir)){
            $idPeminjamanBaru = "PM0001";
        }
        else{
            //Mengambil angka dari string id yang diambil
            preg_match_all('!\d+!', $idterakhir, $angkanya);
            //Nested array loop
            foreach($angkanya as $angka){
                $angkatambah = $angka;
            }
            foreach($angkatambah as $angka){
                $idIncrement = $angka;
            }

            $idIncrement += 1;
            $idPeminjamanBaru = str_pad($idIncrement, 4, '0', STR_PAD_LEFT);
            $idPeminjamanBaru = "PM".$idPeminjamanBaru;
        }
         
        //insert peminjaman ke tb_peminjaman
        DB::table('tb_peminjaman')->insert([
            'id_peminjaman' => $idPeminjamanBaru,
            'id_peminjam' => $namaPinjam,
            'barang_pinjaman' => $barangPinjam,
            'tanggal_pinjam' => $tglPinjam,
            'keterangan' => $keteranganPinjam,
            'status' => 'Dipinjam',
        ]);

        //direct ke halaman peminjaman
        return redirect('/home');
    }

    public function add_pengembalian(Request $request){
        //ambil nilai id inventaris yang kembali
        $idInventKemb = $request->kolIdKembali;
        $idPeminjamanKemb = $request->kolIdPenjKemb;
        $idUserLogin = $request->session()->get('nologin');
        
        //pembuatan id_pengembalian baru
        $idPengembalianTerakhir = DB::table("tb_pengembalian")
        ->select('id_pengembalian')
        ->orderBy('id_pengembalian','desc')
        ->limit(1)
        ->get();
        $idkembaliterakhir = '';
        foreach($idPengembalianTerakhir as $id){
            $idkembaliterakhir = $id->id_pengembalian;
        }

        if(empty($idkembaliterakhir)){
            $idPengembalianBaru = 'PB0001';
        }
        else{
            //Mengambil angka dari string id yang diambil
            preg_match_all('!\d+!', $idkembaliterakhir, $angkanyakembali);
            //Nested array loop
            foreach($angkanyakembali as $angka){
                $angkatambahkembali = $angka;
            }
            foreach($angkatambahkembali as $angka){
                $idIncrementKembali = $angka;
            }

            $idIncrementKembali += 1;
            $idPengembalianBaru = str_pad($idIncrementKembali, 4, '0', STR_PAD_LEFT);
            $idPengembalianBaru = "PB".$idPengembalianBaru;
        }

        //insert pengembalian baru ke tb_pengembalian
        DB::table('tb_pengembalian')->insert([
            'id_pengembalian' => $idPengembalianBaru,
            'id_peminjaman' => $idPeminjamanKemb,
            'nomor_user' => $idUserLogin,
            'id_inventaris' => $idInventKemb,
            'id_petugas' => null,
            'tgl_kembali' => date('Y-m-d')
        ]);

        //direct ke halaman home
        return redirect('/home');
    }

    public function confirm_pengembalian(Request $request){
        //ambil id yang diconfirm
        $idConfirm = $request->kolIdKonfirm;

        //ubah status order di tb_peminjaman
        DB::table('tb_peminjaman')
        ->where('id_peminjaman',$idConfirm)
        ->update(['status' => 'Kembali']);

        //isi kolom id_petugas di tb_pengembalian
        DB::table('tb_pengembalian')
        ->where('id_peminjaman',$idConfirm)
        ->update(
            [
                'id_petugas' => $request->session()->get('nologin')
            ]);
        
        return redirect('/home');
    }
}
