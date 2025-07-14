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
        Schema::create('laboratorium', function (Blueprint $table) {
            $table->id('id_lab');
            $table->string('nama_lab', 100);
            $table->string('lokasi', 100);
            $table->integer('kapasitas');
            $table->string('gambar_lab', 255)->nullable();
            $table->enum('status', ['tersedia', 'dipakai'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratoria');
    }
};
