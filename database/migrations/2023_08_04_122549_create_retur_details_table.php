<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retur_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_barang');
            $table->unsignedBigInteger('id_retur');

            $table->integer('jumlah');
            $table->string('satuan');
            $table->integer('harga');
            
            $table->foreign('id_barang')->references('id')->on('barangs')->onDelete('cascade');
           
            $table->foreign('id_retur')->references('id')->on('returs')->onDelete('cascade');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retur_details');
    }
};
