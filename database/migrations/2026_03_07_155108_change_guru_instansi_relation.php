<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations - Versi Sederhana
     */
    public function up(): void
    {
        // Cek apakah kolom id_instansi ada di tabel guru
        if (Schema::hasColumn('guru', 'id_instansi')) {
            
            // Gunakan raw SQL untuk drop foreign key dengan aman
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            
            // Drop kolom id_instansi (akan otomatis drop foreign key juga)
            Schema::table('guru', function (Blueprint $table) {
                $table->dropColumn('id_instansi');
            });
            
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guru', function (Blueprint $table) {
            // Kembalikan kolom id_instansi jika perlu rollback
            if (!Schema::hasColumn('guru', 'id_instansi')) {
                $table->unsignedBigInteger('id_instansi')->nullable()->after('no_hp');
                $table->foreign('id_instansi')
                      ->references('id_instansi')
                      ->on('instansi')
                      ->onDelete('set null');
            }
        });
    }
};