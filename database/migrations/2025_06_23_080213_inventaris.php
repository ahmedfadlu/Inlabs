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
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id('id_item');
            $table->string('nama_item', 100);
            $table->integer('jumlah');
            $table->string('kondisi', 50);
            $table->unsignedBigInteger('id_lab');
            $table->foreign('id_lab')->references('id_lab')->on('laboratorium')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};
