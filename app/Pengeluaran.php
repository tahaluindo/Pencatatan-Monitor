<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';

    public function kategori(){
    	return $this->belongsTo('App\Kategori_Pengeluaran','id_kategori','id');
    }
}
