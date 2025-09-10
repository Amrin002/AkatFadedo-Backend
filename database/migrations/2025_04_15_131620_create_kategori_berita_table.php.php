<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_berita', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            $table->string('icon')->nullable(); // kolom untuk simpan gambar/logo kategori
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_berita');
    }
};
