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
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('no_kk');
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->string('pendidikan');
            $table->string('pekerjaan');
            $table->string('status');
            $table->string('status_keluarga');
            $table->string('golongan_darah')->nullable();
            $table->string('kewarganegaraan');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->foreign('no_kk')->references('no_kk')->on('KK')->onDelete('cascade');
            // Relasi ke tabel KK


            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};
