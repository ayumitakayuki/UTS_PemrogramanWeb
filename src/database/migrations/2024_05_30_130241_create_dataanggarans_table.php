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
        Schema::create('dataanggarans', function (Blueprint $table) {
            $table->id();
            $table->string('Kategori_pengeluaran')->nullable();
            $table->bigInteger('Alokasi_anggaran')->nullable();
            $table->bigInteger('Penggunaan_anggaran')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dataanggarans');
    }
};