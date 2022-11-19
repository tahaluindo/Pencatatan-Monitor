<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemasukan;
use App\Pengeluaran;

class Home extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_pemasukan = Pemasukan::sum('pemasukan');
        $total_pengeluaran = Pengeluaran::sum('pengeluaran');
        $saldo = $total_pemasukan - $total_pengeluaran;
        return view('contents.home.home',['title'=>'Home','pemasukan'=>$total_pemasukan,'pengeluaran'=>$total_pengeluaran,'saldo'=>$saldo]);
    }
}
