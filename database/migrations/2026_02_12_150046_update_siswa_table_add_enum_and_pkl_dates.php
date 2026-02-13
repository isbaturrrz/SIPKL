<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        DB::statement("UPDATE siswa SET kelas = 'X' WHERE kelas IN ('10', 'x', 'X')");
        DB::statement("UPDATE siswa SET kelas = 'XI' WHERE kelas IN ('11', 'xi', 'Xi', 'XI')");
        DB::statement("UPDATE siswa SET kelas = 'XII' WHERE kelas IN ('12', 'xii', 'Xii', 'XII')");
        DB::statement("UPDATE siswa SET kelas = 'XII' WHERE kelas NOT IN ('X', 'XI', 'XII')");

        Schema::table('siswa', function (Blueprint $table) {
            DB::statement("ALTER TABLE siswa MODIFY kelas ENUM('X', 'XI', 'XII') NOT NULL");
            $table->string('rombel', 2)->nullable()->after('kelas');
            $table->date('tanggal_mulai')->nullable()->after('id_instansi');
            $table->date('tanggal_selesai')->nullable()->after('tanggal_mulai');
        });
    }

    public function down()
    {
        Schema::table('siswa', function (Blueprint $table) {
            DB::statement("ALTER TABLE siswa MODIFY kelas VARCHAR(5)");
            $table->dropColumn(['rombel', 'tanggal_mulai', 'tanggal_selesai']);
        });
    }
};