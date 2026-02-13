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
        'id_guru'
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_instansi', 'id_instansi');
    }

    public function mentor()
    {
        return $this->hasOne(User::class, 'id_instansi', 'id_instansi')
                    ->where('role', 'mentor');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id_instansi', 'id_instansi');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }
    
    public $incrementing = true;
    protected $keyType = 'int';
}