<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';
    protected $primaryKey = 'id_guru';

    protected $fillable = [
        'id',
        'nama',
        'email',
        'tempat_lahir',
        'tgl_lahir',
        'no_hp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_guru', 'id_guru');
    }

    public function instansi()
    {
        return $this->hasMany(Instansi::class, 'id_guru', 'id_guru');
    }
}