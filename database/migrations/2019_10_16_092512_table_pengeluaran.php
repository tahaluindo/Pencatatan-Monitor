<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablePengeluaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pengeluaran');
            $table->unsignedBigInteger('id_kategori');
            $table->text('deskripsi');
            $table->foreign('id_kategori')->references('id')->on('kategori_pengeluaran')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengeluaran');
    }
}
