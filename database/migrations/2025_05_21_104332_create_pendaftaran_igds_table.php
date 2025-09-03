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
        Schema::create('pendaftaran_igds', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pasiens_id')->constrained('pasiens')->onDelete('cascade');
        $table->timestamp('waktu_daftar');
        $table->text('keluhan')->nullable();
        $table->text('diagnosa')->nullable();
        $table->enum('status', ['Menunggu', 'Dirawat', 'Dipindahkan', 'Pulang'])->default('Menunggu');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_igds');
    }
};
