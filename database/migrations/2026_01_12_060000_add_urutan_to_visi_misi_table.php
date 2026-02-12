
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visi_misi', function (Blueprint $table) {
            if (!Schema::hasColumn('visi_misi', 'urutan')) {
                $table->integer('urutan')->default(0)->after('icon');
            }
        });
    }

    public function down(): void
    {
        Schema::table('visi_misi', function (Blueprint $table) {
            $table->dropColumn('urutan');
        });
    }
};
