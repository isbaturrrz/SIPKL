<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';

    protected $fillable = [
        'id',
        'nipd',
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'no_hp',
        'alamat',
        'kelas',
        'jurusan',
        'id_guru',
        'id_instansi',
        'has_submitted_instansi',
        'instansi_submission',
        'status_penempatan'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    // Relasi ke Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }

    // Relasi ke Instansi
    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi', 'id_instansi');
    }
}