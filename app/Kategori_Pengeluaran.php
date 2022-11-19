<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori_Pengeluaran extends Model
{
    protected $table = 'kategori_pengeluaran';

    public function pengeluaran(){
    	return $this->hasMany('App\Pengeluaran','id_kategori');
    }
}
