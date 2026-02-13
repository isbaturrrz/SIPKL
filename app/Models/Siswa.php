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
        'rombel',
        'jurusan',
        'id_guru',
        'id_instansi',
        'tanggal_mulai',
        'tanggal_selesai',
        'has_submitted_instansi',
        'instansi_submission',
        'status_penempatan'
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public const JURUSAN_LIST = [
        'PPLG' => 'Pemodelan Perangkat Lunak dan Gim',
        'BRP' => 'Bisnis Ritel dan Pemasaran',
        'DKV' => 'Desain Komunikasi Visual',
    ];

    public const KELAS_LIST = ['X', 'XI', 'XII'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi', 'id_instansi');
    }
    
    public function getJurusanLengkapAttribute()
    {
        return self::JURUSAN_LIST[$this->jurusan] ?? $this->jurusan;
    }

    public function getKelasLengkapAttribute()
    {
        $parts = array_filter([
            $this->kelas,
            $this->jurusan,
            $this->rombel
        ]);
        
        return implode(' ', $parts);
    }

    public function jurnal()
    {
        return $this->hasMany(Jurnal::class, 'id_siswa', 'id_siswa');
    }
}