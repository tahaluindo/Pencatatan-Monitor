<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori_Pemasukan extends Model
{
   	protected $table = 'kategori_pemasukan';

   	public function pemasukan(){
   		return $this->hasMany('App\Pemasukan','id_kategori');
   	}
   	
}
