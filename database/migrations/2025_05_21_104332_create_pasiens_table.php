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
        Schema::create('pasiens', function (Blueprint $table) {
        $table->id();
        $table->string('no_rekam_medis')->unique();
        $table->string('nama');
        $table->string('nik')->unique();
        $table->enum('jenis_kelamin', ['L', 'P']);
        $table->date('tanggal_lahir');
        $table->string('no_hp')->nullable();
        $table->text('alamat')->nullable();
        $table->enum('jenis_pembayaran', ['Bpjs', 'Umum'])->default('Umum');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
