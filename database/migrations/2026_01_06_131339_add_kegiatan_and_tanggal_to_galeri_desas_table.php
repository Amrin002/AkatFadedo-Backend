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
        Schema::table('galeri_desas', function (Blueprint $table) {
            $table->date('tanggal')->nullable()->after('image');
            $table->text('keterangan')->nullable()->after('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galeri_desas', function (Blueprint $table) {
            $table->dropColumn([
                'kegiatan_desa_id',
                'tanggal',
                'keterangan'
            ]);
        });
    }
};
