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
        Schema::create('riwayatpengaduan', function (Blueprint $table) {
             $table->id('id_riwayat');
            $table->unsignedBigInteger('id_pengaduan');
            $table->enum('status_lama', ['menunggu','diproses','selesai']);
            $table->enum('status_baru', ['menunggu','diproses','selesai']);
            $table->dateTime('tanggal_update')->useCurrent();
            $table->unsignedBigInteger('diperbarui_oleh');
            $table->foreign('id_pengaduan')->references('id_pengaduan')->on('pengaduan')->onDelete('cascade');
            $table->foreign('diperbarui_oleh')->references('id_user')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayatpengaduans');
    }
};

