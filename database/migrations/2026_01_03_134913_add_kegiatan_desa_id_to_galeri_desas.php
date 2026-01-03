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
            $table->foreignId('kegiatan_desa_id')
                ->nullable()
                ->after('id')
                ->constrained('kegiatan_desas')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galeri_desas', function (Blueprint $table) {
            $table->dropForeign(['kegiatan_desa_id']);
            $table->dropColumn('kegiatan_desa_id');
        });
    }
};
