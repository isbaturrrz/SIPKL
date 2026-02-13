<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Hapus Foreign Key yang menghalangi perubahan (Gunakan Helper)
        Schema::table('users', function (Blueprint $table) {
            if ($this->foreignKeyExists('users', 'users_id_instansi_foreign')) {
                $table->dropForeign('users_id_instansi_foreign');
            }
        });

        Schema::table('siswa', function (Blueprint $table) {
            if ($this->foreignKeyExists('siswa', 'siswa_ibfk_2')) {
                $table->dropForeign('siswa_ibfk_2');
            }
        });

        // 2. Ubah tipe data tabel utama (Parent)
        DB::statement('ALTER TABLE instansi MODIFY id_instansi BIGINT UNSIGNED AUTO_INCREMENT');

        // 3. Seragamkan tipe data tabel anak (Child)
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_instansi')->nullable()->change();
        });

        Schema::table('siswa', function (Blueprint $table) {
            $table->unsignedBigInteger('id_instansi')->nullable()->change();
        });

        // 4. Pasang kembali constraint
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('id_instansi')->references('id_instansi')->on('instansi')->onDelete('set null');
        });

        Schema::table('siswa', function (Blueprint $table) {
            $table->foreign('id_instansi', 'siswa_ibfk_2')->references('id_instansi')->on('instansi')->onDelete('set null');
        });
    }

    public function down(): void { /* ... isi fungsi down Anda ... */ }

    /**
     * FUNGSI HELPER: Pastikan ini ada di dalam class
     */
    private function foreignKeyExists($table, $name)
    {
        $databaseName = DB::getDatabaseName();
        $exists = DB::select(
            "SELECT * FROM information_schema.TABLE_CONSTRAINTS 
             WHERE CONSTRAINT_SCHEMA = ? 
             AND TABLE_NAME = ? 
             AND CONSTRAINT_NAME = ? 
             AND CONSTRAINT_TYPE = 'FOREIGN KEY'",
            [$databaseName, $table, $name]
        );
        
        return !empty($exists);
    }
};