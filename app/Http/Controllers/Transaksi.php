<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemasukan;
use App\Kategori_Pemasukan as KPM;
use App\Kategori_Pengeluaran as KPR;
use App\Pengeluaran;

class Transaksi extends Controller
{

    public function index(Request $request)
    {   
        if($request->has('_token')){
            $pemasukan = Pemasukan::whereDate('updated_at','>=',$request->mulai)->whereDate('updated_at','<=',$request->akhir)->get();
            $pengeluaran = Pengeluaran::whereDate('updated_at','>=',$request->mulai)->whereDate('updated_at','<=',$request->akhir)->get();
            $caption = 'Tanggal '.date('d F Y',strtotime($request->mulai)).' - '.date('d F Y',strtotime($request->akhir));
        }else{
            $pemasukan = Pemasukan::whereMonth('updated_at','=',date('m'))->get();
            $pengeluaran = Pengeluaran::whereMonth('updated_at','=',date('m'))->get();
            $caption = 'Bulan '.date('F');
        }
        $total_masuk = Pemasukan::sum('pemasukan');
        $total_keluar = Pengeluaran::sum('pengeluaran');
        $saldo = $total_masuk - $total_keluar;
        $kpm = KPM::all();
        $kpr = KPR::all();
        return view('contents.transaksi.list_transaksi',['title'=>'List Transaksi','saldo'=>$saldo,'pemasukan'=>$pemasukan,'pengeluaran'=>$pengeluaran,'caption'=>$caption,'kpm'=>$kpm,'kpr'=>$kpr]);
    }

    public function show(Request $request, $id){
        $request->validate(['tipe'=>'required']);
        try{
            if($request->tipe=='pemasukan'){
                $response = Pemasukan::find($id);
            }elseif($request->tipe=='pengeluaran'){
                $response = Pengeluaran::find($id);
            }else{
                $response = false;
            }
            return $response;
        }catch(\Exception $e){
            return false;
        }
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'jenis_transaksi' => 'required',
            'kategori' => 'required',
            'nominal' => 'required',
            'deskripsi' => 'required'
        ]);
        try{
            if($request->jenis_transaksi=='pemasukan'){
                $store = new Pemasukan;
                $store->pemasukan = $request->nominal;
            }else{
                $store = new Pengeluaran;
                $store->pengeluaran = $request->nominal;
            }
            $store->id_kategori = $request->kategori;
            $store->deskripsi = $request->deskripsi;
            $store->save();
            $alert = "Berhasil";
        }catch(\Exception $e){
            $alert = "Gagal";
        }
        return redirect('transaksi')->with('alert',$alert);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tipe' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'nominal' => 'required'
        ]);
        try{
            if($request->tipe=='pemasukan'){
                $update = Pemasukan::find($id);
                $update->pemasukan = $request->nominal;
            }elseif($request->tipe=='pengeluaran'){
                $update = Pengeluaran::find($id);
                $update->pengeluaran = $request->nominal;
            }else{
                return redirect('transaksi')->with('alert','Gagal');
            }
            $update->id_kategori = $request->kategori;
            $update->deskripsi = $request->deskripsi;
            $update->save();
            $alert = 'Berhasil';
        }catch(\Exception $e){
            $alert = 'Gagal';
        }        
        return redirect('transaksi')->with('alert',$alert);
    }

    public function destroy(Request $request, $id)
    {
        $request->validate(['tipe'=>'required']);
        if($request->tipe=='pemasukan'){
            try{
                Pemasukan::destroy($id);
                $alert = 'Berhasil';
            }catch(\Exception $e){
                $alert = 'Gagal';
            }
        }elseif($request->tipe=='pengeluaran'){
            try{
                Pengeluaran::destroy($id);
                $alert = 'Berhasil';
            }catch(\Exception $e){
                $alert = 'Gagal';
            }
        }
        return redirect('transaksi')->with('alert',$alert);
    }
}
