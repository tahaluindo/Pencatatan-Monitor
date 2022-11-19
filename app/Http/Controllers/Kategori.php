<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori_Pemasukan as KPM;
use App\Kategori_Pengeluaran as KPR;

class Kategori extends Controller
{

    public function index()
    {
        $list_kategori_pemasukan = KPM::all();
        $list_kategori_pengeluaran = KPR::all();
        return view('contents.kategori.list_kategori',['list_kategori_pemasukan'=>$list_kategori_pemasukan,'list_kategori_pengeluaran'=>$list_kategori_pengeluaran,'title'=>'List Kategori']);
    }

    public function show(Request $request, $id){
        try{
            $request->validate([
                'tipe' => 'required'
            ]);
            if($request->tipe=='pemasukan'){
                $kategori = KPM::find($id);
            }elseif($request->tipe=='pengeluaran'){
                $kategori = KPR::find($id);
            }else{
                $kategori = false;
            }
            return $kategori;
        }catch(\Exception $e){
            return false;
        }
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'tipe' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required'
        ]);
        if($request->tipe=='pemasukan'){
            $store = new KPM;
        }else{
            $store = new KPR;
            
        }
        $store->nama_kategori = $request->kategori;
        $store->deskripsi = $request->deskripsi;
        $store->save();
        return redirect('kategori');
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'tipe' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required'
        ]);
        try{
            if($request->tipe=='pemasukan'){
                $update = KPM::find($id);
            }else{
                $update = KPR::find($id);
                
            }
            $update->nama_kategori = $request->kategori;
            $update->deskripsi = $request->deskripsi;
            $update->save();
            $alert = "Berhasil";
        }catch(\Exception $e){
            $alert = "Gagal";
        }        
        return redirect('kategori')->with('alert',$alert);
    }


    public function destroy(Request $request, $id)
    {
        $validation = $request->validate([
            'tipe'=>'required'
        ]);
        if($request->tipe=='pemasukan'){
            try{
                KPM::destroy($id);
                $alert = 'Berhasil';
            }catch(\Exception $e){
                $alert = 'Gagal';
            }    
            return back()->with('alert',$alert);     
        }else{
            try{
                KPR::destroy($id);
                $alert = 'Berhasil';
            }catch(\Exception $e){
                $alert = 'Gagal';
            } 
            return back()->with('alert',$alert);           
        }
    }
}
