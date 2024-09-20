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
    Schema::create('stok', function (Blueprint $table) {
        $table->id(); // Menggunakan unsignedBigInteger sebagai primary key
        $table->unsignedInteger('barang_id'); // Menggunakan unsignedInteger karena tabel Barang memiliki increments('id')
        $table->integer('jumlah_stok');
        $table->timestamps();

        // Relasi foreign key ke tabel barang
        $table->foreign('barang_id')->references('id')->on('Barang')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stok');
    }
};
