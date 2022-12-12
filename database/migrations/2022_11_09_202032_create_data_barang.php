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
        Schema::create('data_barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang', 10)->unique()->nullable(false);
            $table->string('nama_barang', 50)->unique()->nullable(false);
            $table->integer('stok_barang')->nullable(false)->default(0);
            $table->enum('status_barang', ['TERSEDIA', 'HABIS', 'RUSAK', 'HILANG'])->nullable(false);
            $table->string('gambar_barang', 255)->nullable(true);
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
        Schema::dropIfExists('data_barang');
    }
};
