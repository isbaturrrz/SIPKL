<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;
    
    protected $table = 'jurnal';
    protected $primaryKey = 'id_jurnal';
    
    protected $fillable = [
        'id_siswa',
        'tgl',
        'jam_mulai',
        'jam_selesai',
        'status_kehadiran',
        'wfh',
        'kegiatan',
        'manfaat',
        'latitude',
        'longitude',
        'keterangan_reject',
        'status_verifikasi',
        'verified_by',
        'verified_at',
        'input_by'
    ];

        protected $casts = [
        'tgl' => 'date',
        'wfh' => 'boolean',
        'verified_at' => 'datetime'
    ];
    
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by', 'id');
    }
}