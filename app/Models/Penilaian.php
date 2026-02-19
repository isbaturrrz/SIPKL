<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaian';
    protected $primaryKey = 'id_nilai';

    protected $fillable = [
        'id_siswa',
        'id_instansi',
        'nilai_kreatifitas',
        'nilai_kedisiplinan',
        'nilai_keaktifan',
        'nilai_kerjasama',
        'nilai_akhir',
        'keterangan',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'id_mentor', 'id');
    }
}