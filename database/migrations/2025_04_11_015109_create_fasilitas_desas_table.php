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
        Schema::create('fasilitas_desas', function (Blueprint $table) {
            $table->id();
            $table->integer('fasilitas_pendidikan');
            $table->integer('fasilitas_kesehatan');
            $table->decimal('luas_wilayah', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas_desas');
    }
};
