<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('keluhans', function (Blueprint $table) {
            $table->text('respon_admin')->nullable()->after('isi');
            $table->timestamp('tanggal_diproses')->nullable()->after('status');
            $table->timestamp('tanggal_selesai')->nullable()->after('tanggal_diproses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('keluhans', function (Blueprint $table) {
            $table->dropColumn(['respon_admin', 'tanggal_diproses', 'tanggal_selesai']);
        });
    }
};
