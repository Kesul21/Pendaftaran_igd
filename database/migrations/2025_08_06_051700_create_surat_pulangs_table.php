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
        Schema::create('surat_pulangs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('penempatan_kamar_id')->constrained()->onDelete('cascade');
    $table->date('tanggal_pulang');
    $table->string('diagnosa');
    $table->string('tindakan');
    $table->string('nama_petugas');
    $table->string('nip_petugas')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_pulangs');
    }
};
