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
    Schema::create('penempatan_kamars', function (Blueprint $table) {
    $table->id();
    $table->foreignId('permintaan_rawat_inap_id')->constrained('permintaan_rawat_inaps')->onDelete('cascade');
    $table->foreignId('kamar_id')->constrained('kamar')->onDelete('restrict');
    $table->string('nomor_tempat_tidur');
    $table->dateTime('tanggal_masuk')->nullable();
    $table->string('status')->default('menunggu');
    $table->timestamps();
        });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penempatan_kamars');
    }
};
