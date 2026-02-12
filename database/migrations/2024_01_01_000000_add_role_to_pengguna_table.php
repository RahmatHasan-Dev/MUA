<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Cek agar tidak error jika kolom sudah ada
        if (!Schema::hasColumn('pengguna', 'role')) {
            Schema::table('pengguna', function (Blueprint $table) {
                // Tambahkan kolom role setelah email, defaultnya 'user'
                $table->string('role')->default('user')->after('email');
            });
        }
    }

    public function down()
    {
        Schema::table('pengguna', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};