<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_instansi', function (Blueprint $table) {
            $table->enum('jurusan_diterima', ['PPLG', 'BRP', 'DKV', 'PPLG-BRP', 'PPLG-DKV', 'BRP-DKV', 'PPLG-BRP-DKV'])
                ->default('PPLG-BRP-DKV')
                ->after('kuota_siswa');
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_instansi', function (Blueprint $table) {
            $table->dropColumn('jurusan_diterima');
        });
    }
};