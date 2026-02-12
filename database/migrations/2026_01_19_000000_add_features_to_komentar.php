<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambah parent_id untuk fitur Reply
        Schema::table('komentar', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable()->after('id');
            $table->foreign('parent_id')->references('id')->on('komentar')->onDelete('cascade');
        });

        // 2. Buat tabel untuk fitur Like
        Schema::create('komentar_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_komentar');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_komentar')->references('id')->on('komentar')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('pengguna')->onDelete('cascade');
            
            // Mencegah user like komentar yang sama berkali-kali
            $table->unique(['id_komentar', 'id_user']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komentar_likes');
        
        Schema::table('komentar', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
        });
    }
};