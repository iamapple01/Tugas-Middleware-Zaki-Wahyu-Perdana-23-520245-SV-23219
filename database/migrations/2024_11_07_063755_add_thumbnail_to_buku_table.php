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
        Schema::table('buku', function (Blueprint $table) {
            if (!Schema::hasColumn('buku', 'filename')) {
                $table->string('filename')->nullable();
            }
            if (!Schema::hasColumn('buku', 'filepath')) {
                $table->string('filepath')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buku', function (Blueprint $table) {
            if (Schema::hasColumn('buku', 'filename')) {
                $table->dropColumn('filename');
            }
            if (Schema::hasColumn('buku', 'filepath')) {
                $table->dropColumn('filepath');
            }
        });
    }
};
