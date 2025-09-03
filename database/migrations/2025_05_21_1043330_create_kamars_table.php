<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('kamars', function (Blueprint $table) {
    $table->id(); // ini = unsignedBigInteger
    $table->string('nama'); // tambahkan ini jika diperlukan
    $table->string('kode_kamar');
    $table->string('kelas');
    $table->integer('kapasitas');
    $table->integer('kapasitas_tersedia');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
