<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $table = 'pemasukan';

    public function kategori(){
    	return $this->belongsTo('App\Kategori_Pemasukan','id_kategori','id');
    }
}
