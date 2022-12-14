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
        Schema::create('petugas_peralatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_petugas', 50)->unique()->comment('Nama petugas peralatan')->nullable(false);
            $table->string('username', 30)->unique()->comment('Username petugas peralatan')->nullable(false);
            $table->string('password', 500)->unique()->comment('Password petugas peralatan')->nullable(false);
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
        Schema::dropIfExists('petugas_peralatan');
    }
};
