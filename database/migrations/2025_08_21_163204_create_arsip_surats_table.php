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
        Schema::create('arsip_surats', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique(); // "01 / SKTM / NA-AF / VIII / 2025"
            $table->string('nama_pemohon');
            $table->date('tanggal_terbit');
            $table->string('status')->default('Terarsip'); // Terarsip, Aktif

            // Polymorphic relation ke surat asli
            $table->string('surat_type'); // 'App\Models\SuratKtm', 'App\Models\SuratKtu', dll
            $table->unsignedBigInteger('surat_id'); // ID dari tabel surat asli

            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Index untuk pencarian cepat
            $table->index(['surat_type', 'tanggal_terbit']);
            $table->index(['nomor_surat']);
            $table->index(['nama_pemohon']);

            // Polymorphic index
            $table->index(['surat_type', 'surat_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_surats');
    }
};
