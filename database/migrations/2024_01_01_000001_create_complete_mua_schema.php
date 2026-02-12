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
        // 1. Tabel Pengguna (Users)
        if (!Schema::hasTable('pengguna')) {
            Schema::create('pengguna', function (Blueprint $table) {
                $table->id(); // PK: id (BigInt)
                $table->string('nama');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('no_hp')->nullable();
                $table->date('tgl_lahir')->nullable();
                $table->string('role')->default('user'); // admin, user
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // 2. Tabel Campaign (Program Donasi)
        if (!Schema::hasTable('campaign')) {
            Schema::create('campaign', function (Blueprint $table) {
                $table->id('id_campaign'); // PK
                $table->string('judul');
                $table->text('deskripsi');
                $table->string('gambar')->nullable();
                $table->decimal('target', 15, 2)->default(0);
                $table->timestamps();
            });
        }

        // 3. Tabel Donasi (Transaksi)
        if (!Schema::hasTable('donasi')) {
            Schema::create('donasi', function (Blueprint $table) {
                $table->id('id_donasi'); // PK
                
                // FK ke Pengguna
                $table->foreignId('id_user')
                      ->constrained('pengguna')
                      ->onDelete('cascade'); 
                
                // FK ke Campaign (Opsional, jika donasi umum bisa null)
                $table->foreignId('id_campaign')
                      ->nullable()
                      ->constrained('campaign', 'id_campaign')
                      ->onDelete('set null');

                $table->string('jenis'); // satwa, karang, bakau, pendidikan
                $table->decimal('nominal', 15, 2);
                $table->dateTime('tanggal');
                $table->enum('status', ['pending', 'berhasil', 'gagal'])->default('pending');
                $table->string('bukti_transfer')->nullable();
                $table->text('catatan')->nullable();
                $table->string('snap_token')->nullable(); // Untuk Midtrans
                $table->timestamps();
            });
        }

        // 4. Tabel Berita (Kegiatan)
        if (!Schema::hasTable('berita')) {
            Schema::create('berita', function (Blueprint $table) {
                $table->id('id_berita'); // PK
                $table->string('judul');
                $table->text('deskripsi');
                $table->string('gambar')->nullable();
                $table->date('tanggal');
                $table->string('lokasi');
                $table->string('peserta')->nullable();
                $table->string('tag1')->nullable();
                $table->string('tag2')->nullable();
                $table->string('tag3')->nullable();
                $table->timestamps();
            });
        }

        // 5. Tabel Partnership
        if (!Schema::hasTable('partnership')) {
            Schema::create('partnership', function (Blueprint $table) {
                $table->id(); // PK
                $table->string('name');
                $table->text('description')->nullable();
                $table->string('logo')->nullable();
                $table->string('website_url')->nullable();
                $table->enum('kategori', ['reguler', 'eksklusif', 'pengawasan'])->default('reguler');
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // 6. Tabel Pengeluaran
        if (!Schema::hasTable('pengeluaran')) {
            Schema::create('pengeluaran', function (Blueprint $table) {
                $table->id(); // PK
                $table->string('no_transaksi')->unique(); // OUT-00001
                $table->string('judul');
                $table->decimal('nominal', 15, 2);
                $table->date('tanggal');
                $table->string('kategori'); // Operasional, Program, Withdrawal
                $table->string('bukti')->nullable();
                $table->text('keterangan')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluaran');
        Schema::dropIfExists('partnership');
        Schema::dropIfExists('berita');
        Schema::dropIfExists('donasi');
        Schema::dropIfExists('campaign');
        Schema::dropIfExists('pengguna');
    }
};
