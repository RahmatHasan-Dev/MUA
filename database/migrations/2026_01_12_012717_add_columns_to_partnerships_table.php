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
        Schema::table('partnerships', function (Blueprint $table) {
            if (!Schema::hasColumn('partnerships', 'name')) {
                $table->string('name');
            }
            if (!Schema::hasColumn('partnerships', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('partnerships', 'logo')) {
                $table->string('logo')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partnerships', function (Blueprint $table) {
            if (Schema::hasColumn('partnerships', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('partnerships', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('partnerships', 'logo')) {
                $table->dropColumn('logo');
            }
        });
    }
};
