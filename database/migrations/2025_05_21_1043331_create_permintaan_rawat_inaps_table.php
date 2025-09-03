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
        Schema::create('permintaan_rawat_inaps', function (Blueprint $table) {
    $table->id(); // unsignedBigInteger, primary key
    $table->foreignId('pendaftaran_igd_id')->constrained('pendaftaran_igds')->onDelete('cascade');
    $table->dateTime('waktu_permintaan');
    $table->string('status');
    $table->text('catatan')->nullable();
    $table->string('file_surat')->nullable();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_rawat_inaps');
    }
};
