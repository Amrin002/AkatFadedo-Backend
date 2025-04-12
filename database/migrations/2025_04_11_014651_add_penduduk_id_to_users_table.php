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
        Schema::table('users', function (Blueprint $table) {
            //
            // Tambahkan kolom nik dulu
            $table->string('nik')->unique()->after('id');
            $table->string('role')->default('user')->after('email_verified_at');
            $table->string('image')->nullable()->after('password');

            // Baru bikin foreign key-nya
            $table->foreign('nik')
                ->references('nik')
                ->on('penduduks')
                ->onDelete('cascade');
            // Tambahkan kolom penduduk_id untuk relasi ke model
            $table->unsignedBigInteger('penduduk_id')->after('nik')->nullable();

            // Tambahkan foreign key relasi
            $table->foreign('penduduk_id')
                ->references('id')
                ->on('penduduks')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            // Drop foreign key kalau ada
            if (Schema::hasColumn('users', 'nik')) {
                $table->dropForeign(['nik']);
                $table->dropColumn('nik');
            }

            if (Schema::hasColumn('users', 'penduduk_id')) {
                $table->dropForeign(['penduduk_id']);
                $table->dropColumn('penduduk_id');
            }
        });
    }
};
