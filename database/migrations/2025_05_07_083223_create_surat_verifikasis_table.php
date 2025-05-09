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
        Schema::create('surat_verifikasis', function (Blueprint $table) {
            $table->id();
            $table->string('type_surat');
            $table->string('nama_pemohon');
            $table->string('nomor_surat')->unique();
            $table->date('tanggal_terbit');
            $table->string('status')->default('TERVERIFIKASI'); // bisa 'TERVERIFIKASI', 'TIDAK VALID'

            // Pejabat penandatangan
            $table->string('nama_pejabat');
            $table->string('nip')->nullable();
            $table->string('jabatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_verifikasis');
    }
};
