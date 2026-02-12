<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('komentar_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_komentar');
            $table->unsignedBigInteger('id_user'); // Pelapor
            $table->string('alasan');
            $table->enum('status', ['pending', 'reviewed'])->default('pending');
            $table->timestamps();

            $table->foreign('id_komentar')->references('id')->on('komentar')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('pengguna')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komentar_reports');
    }
};