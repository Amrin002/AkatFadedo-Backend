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
        Schema::create('app_versions', function (Blueprint $table) {
            $table->id();
             $table->string('version'); // "1.2.0"
            $table->integer('version_code'); // 120 (untuk perbandingan numerik)
            $table->string('minimum_version')->nullable(); // "1.0.0"
            $table->integer('minimum_version_code')->nullable(); // 100
            $table->string('download_url'); // Link download APK
            $table->boolean('is_force_update')->default(false); // Wajib update atau tidak
            $table->text('changelog')->nullable(); // Catatan perubahan
            $table->string('file_size')->nullable(); // "15.2 MB"
            $table->boolean('is_active')->default(true); // Versi yang sedang aktif
            $table->string('platform')->default('android'); // android/ios untuk future
            $table->timestamps();
              // Index untuk performa
            $table->index(['is_active', 'platform']);
            $table->index('version_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_versions');
    }
};
