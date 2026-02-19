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
        'verified_at' => 'datetime'
    ];
    
    public const STATUS_KEHADIRAN = [
        'wfo' => 'WFO (Work From Office)',
        'wfh' => 'WFH (Work From Home)',
        'sakit' => 'Sakit',
        'izin' => 'Izin',
        'libur' => 'Libur',
        'alfa' => 'Alfa'
        ];
    
    public const STATUS_VERIFIKASI = [
        'pending' => 'Menunggu Verifikasi',
        'approved' => 'Disetujui',
        'rejected' => 'Ditolak'
    ];
    
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
    
    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by', 'id');
    }
    
    public function needsGPS()
    {
        return $this->status_kehadiran === 'wfo';
    }
    
    public function needsKegiatan()
    {
        return in_array($this->status_kehadiran, ['wfo', 'wfh']);
    }
}