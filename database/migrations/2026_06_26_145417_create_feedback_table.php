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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peserta_sesi_id');
            $table->tinyInteger('komunikasi');
            $table->tinyInteger('penguasaan_materi');
            $table->tinyInteger('kejelasan_penyampaian');
            $table->text('komentar'); 
            $table->timestamps();

            $table->foreign('peserta_sesi_id')->references('id')->on('peserta_sesis')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
