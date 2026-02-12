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
        if (!Schema::hasTable('campaign')) {
            Schema::create('campaign', function (Blueprint $table) {
                $table->bigIncrements('id_campaign');
                $table->string('judul', 50);
                $table->string('deskripsi', 255);
                $table->integer('target');
                $table->string('gambar', 10000);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign');
    }
};