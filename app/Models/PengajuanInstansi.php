<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanInstansi extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_instansi';
    protected $primaryKey = 'id_pengajuan';
    public $timestamps = true;

    protected $fillable = [
        'id_siswa',
        'nama_perusahaan',
        'alamat',
        'latitude',
        'longitude',
        'no_hp',
        'pemilik',
        'kuota_siswa',
        'jurusan_diterima',
        'status',
        'keterangan_reject',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'kuota_siswa' => 'integer',
        ];
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}