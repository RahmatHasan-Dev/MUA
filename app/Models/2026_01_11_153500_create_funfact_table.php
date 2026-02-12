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
        if (!Schema::hasTable('funfact')) {
            Schema::create('funfact', function (Blueprint $table) {
                $table->bigIncrements('id_funfact');
                $table->string('emoji', 50);
                $table->string('angka', 50);
                $table->string('headline', 255);
                $table->string('deskripsi', 255);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funfact');
    }
};
