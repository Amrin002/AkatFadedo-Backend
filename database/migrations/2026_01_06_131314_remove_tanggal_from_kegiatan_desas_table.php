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
        Schema::table('kegiatan_desas', function (Blueprint $table) {
            if (Schema::hasColumn('kegiatan_desas', 'tanggal')) {
                $table->dropColumn('tanggal');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatan_desas', function (Blueprint $table) {
            $table->date('tanggal')->nullable();
        });
    }
};
