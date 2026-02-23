<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaian';
    protected $primaryKey = 'id_nilai';
    public $timestamps = true;

    protected $fillable = [
        'id_siswa',
        'id_instansi',
        'nilai_kreatifitas',
        'nilai_kedisiplinan',
        'nilai_tanggung_jawab',
        'nilai_kerjasama',
        'nilai_komunikasi',
        'nilai_akhir',
        'keterangan',
    ];

    protected $casts = [
        'nilai_kreatifitas' => 'decimal:2',
        'nilai_kedisiplinan' => 'decimal:2',
        'nilai_tanggung_jawab' => 'decimal:2',
        'nilai_kerjasama' => 'decimal:2',
        'nilai_komunikasi' => 'decimal:2',
        'nilai_akhir' => 'decimal:2',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi', 'id_instansi');
    }

}