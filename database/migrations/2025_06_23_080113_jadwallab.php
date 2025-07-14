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
        Schema::create('jadwallabs', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->unsignedBigInteger('id_lab');
            $table->enum('hari', ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('kegiatan', 255);
            $table->string('dosen_pengampu', 100);
            $table->foreign('id_lab')->references('id_lab')->on('laboratorium')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwallabs');
    }
};
