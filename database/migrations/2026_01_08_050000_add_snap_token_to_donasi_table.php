<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donasi', function (Blueprint $table) {
            if (!Schema::hasColumn('donasi', 'snap_token')) {
                $table->string('snap_token')->nullable()->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('donasi', function (Blueprint $table) {
            $table->dropColumn('snap_token');
        });
    }
};