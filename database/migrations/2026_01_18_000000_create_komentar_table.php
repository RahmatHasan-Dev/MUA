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
        Schema::create('komentar', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_berita');
            $table->unsignedBigInteger('id_user');
            $table->text('isi');
            $table->timestamps();

            $table->foreign('id_berita')->references('id_berita')->on('berita')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('pengguna')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komentar');
    }
};