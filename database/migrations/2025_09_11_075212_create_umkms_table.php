<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16);
            $table->string('nama_usaha');
            $table->enum('kategori', [
                'makanan',
                'jasa',
                'kerajinan',
                'pertanian',
                'perdagangan',
                'lainnya'
            ]);
            // Data produk
            $table->string('nama_produk', 255);
            $table->text('deskripsi_produk');
            $table->decimal('harga_produk', 15, 2);
            $table->string('foto_produk', 255)->nullable();

            // Data kontak
            $table->string('nomor_telepon', 20)->comment('Nomor WhatsApp/telepon');
            $table->string('link_facebook', 500)->nullable()->comment('URL Facebook page/profile');
            $table->string('link_instagram', 500)->nullable()->comment('URL Instagram profile');
            $table->string('link_tiktok', 500)->nullable()->comment('URL TikTok profile');

            // users
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            // Status approval
            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending')
                ->comment('Status verifikasi admin');
            $table->text('catatan_admin')->nullable()->comment('Catatan admin jika ditolak');

            $table->timestamp('approved_at')->nullable()->comment('Waktu disetujui admin');
            $table->unsignedBigInteger('approved_by')->nullable()->comment('Admin yang menyetujui');

            $table->timestamps();
            // Indexes untuk performa
            $table->index('nik', 'idx_umkm_nik');
            $table->index('status', 'idx_umkm_status');
            $table->index('kategori', 'idx_umkm_kategori');
            $table->index(['status', 'approved_at'], 'idx_umkm_status_approved');

            // Foreign key constraints
            $table->foreign('nik')
                ->references('nik')
                ->on('penduduks')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('approved_by')
                ->references('id')
                ->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
