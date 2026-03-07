<?php

namespace App\Http\Requests\Siswa;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJurnalRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'tgl' => 'required|date',
            'status_kehadiran' => 'required|in:wfo,wfh,sakit,izin,libur',
            'foto_kegiatan' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ];

        if (in_array($this->status_kehadiran, ['wfo', 'wfh'])) {
            $rules['jam_mulai'] = 'required|date_format:H:i';
            $rules['jam_selesai'] = 'required|date_format:H:i|after:jam_mulai';
            $rules['kegiatan'] = 'required|string';
            $rules['manfaat'] = 'required|string';
        }

        if ($this->status_kehadiran === 'wfo') {
            $rules['latitude'] = 'required|numeric|between:-90,90';
            $rules['longitude'] = 'required|numeric|between:-180,180';
        }

        if ($this->status_kehadiran === 'izin') {
            $rules['kegiatan'] = 'required|string';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'tgl.required' => 'Tanggal harus diisi',
            'tgl.date' => 'Format tanggal tidak valid',
            'status_kehadiran.required' => 'Status kehadiran harus dipilih',
            'status_kehadiran.in' => 'Status kehadiran tidak valid',
            'jam_mulai.required' => 'Jam masuk harus diisi',
            'jam_mulai.date_format' => 'Format jam masuk tidak valid (harus HH:MM)',
            'jam_selesai.required' => 'Jam pulang harus diisi',
            'jam_selesai.date_format' => 'Format jam pulang tidak valid (harus HH:MM)',
            'jam_selesai.after' => 'Jam pulang harus lebih besar dari jam masuk',
            'kegiatan.required' => 'Kegiatan harus diisi',
            'manfaat.required' => 'Manfaat harus diisi',
            'latitude.required' => 'Lokasi harus terdeteksi',
            'longitude.required' => 'Lokasi harus terdeteksi',
            'foto_kegiatan.image' => 'File harus berupa gambar',
            'foto_kegiatan.mimes' => 'Format foto harus JPG, JPEG, atau PNG',
            'foto_kegiatan.max' => 'Ukuran foto maksimal 2MB',
        ];
    }
}