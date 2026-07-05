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
        Schema::create('sesi_mentorings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelas_id');
            $table->string('topik');
            $table->text('deskripsi');
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai'); 
            $table->integer('kuota'); 
            $table->enum('status', ['dibuka', 'ditutup', 'selesai'])->default('dibuka');
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesi_mentorings');
    }
};
