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
        Schema::create('peserta_sesis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sesi_id');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->enum('status', ['terdaftar', 'hadir', 'dibatalkan', 'tidak_hadir'])->default('terdaftar');
            $table->timestamp('tanggal_daftar')->useCurrent();
            $table->timestamps();

            $table->foreign('sesi_id')->references('id')->on('sesi_mentorings')->onDelete('cascade');
            $table->foreign('mahasiswa_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['sesi_id', 'mahasiswa_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_sesis');
    }
};
