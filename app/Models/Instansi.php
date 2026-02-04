<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $table = 'instansi';
    protected $primaryKey = 'id_instansi';

    protected $fillable = [
    'nama_instansi',
    'alamat',
    'latitude',
    'longitude',
    'no_hp',
    'pemilik',
    'kuota_siswa',
    'kuota_terpakai',
    'is_from_submission',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_instansi', 'id_instansi');
    }
}