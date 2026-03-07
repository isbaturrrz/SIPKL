<?php

namespace App\Http\Requests\Siswa;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class StoreJurnalRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $today = Carbon::today()->format('Y-m-d');
        
        $rules = [
            'tgl' => [
                'required',
                'date',
                "after_or_equal:{$yesterday}",
                "before_or_equal:{$today}"
            ],
            'status_kehadiran' => [
                'required',
                'in:wfo,wfh,sakit,izin,libur'
            ],
        ];

        if (in_array($this->status_kehadiran, ['wfo', 'wfh'])) {
            $rules['jam_mulai'] = ['required', 'date_format:H:i'];
            $rules['jam_selesai'] = ['required', 'date_format:H:i', 'after:jam_mulai'];
            $rules['kegiatan'] = ['required', 'string', 'max:1000'];
            $rules['manfaat'] = ['required', 'string', 'max:1000'];
            $rules['foto_kegiatan'] = ['required', 'image', 'mimes:jpeg,jpg,png', 'max:2048'];
        } else {
            $rules['jam_mulai'] = ['nullable', 'date_format:H:i'];
            $rules['jam_selesai'] = ['nullable', 'date_format:H:i'];
            $rules['kegiatan'] = ['nullable'];
            $rules['manfaat'] = ['nullable'];
            $rules['foto_kegiatan'] = ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'];
        }

        if ($this->status_kehadiran === 'wfo') {
            $rules['latitude'] = ['required', 'numeric', 'between:-90,90'];
            $rules['longitude'] = ['required', 'numeric', 'between:-180,180'];
        } else {
            $rules['latitude'] = ['nullable'];
            $rules['longitude'] = ['nullable'];
        }

        if ($this->status_kehadiran === 'izin') {
            $rules['kegiatan'] = ['required', 'string', 'max:1000'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'tgl.required' => 'Tanggal harus diisi',
            'tgl.after_or_equal' => 'Tanggal hanya bisa hari ini atau kemarin',
            'tgl.before_or_equal' => 'Tanggal tidak boleh melebihi hari ini',
            
            'status_kehadiran.required' => 'Status kehadiran harus dipilih',
            'status_kehadiran.in' => 'Status kehadiran tidak valid',
            
            'jam_mulai.required' => 'Jam masuk harus diisi untuk WFO/WFH',
            'jam_selesai.required' => 'Jam pulang harus diisi untuk WFO/WFH',
            'jam_selesai.after' => 'Jam pulang harus setelah jam masuk',
            
            'kegiatan.required' => 'Kegiatan harus diisi untuk WFO/WFH',
            'kegiatan.max' => 'Kegiatan maksimal 1000 karakter',
            
            'manfaat.required' => 'Manfaat harus diisi untuk WFO/WFH',
            'manfaat.max' => 'Manfaat maksimal 1000 karakter',
            
            'latitude.required' => 'Lokasi GPS diperlukan untuk WFO',
            'longitude.required' => 'Lokasi GPS diperlukan untuk WFO',
            
            'foto_kegiatan.required' => 'Foto bukti kegiatan harus diunggah untuk WFO/WFH',
            'foto_kegiatan.image' => 'File harus berupa gambar',
            'foto_kegiatan.mimes' => 'Format foto harus jpeg, jpg, atau png',
            'foto_kegiatan.max' => 'Ukuran foto maksimal 2MB',
        ];
    }
}