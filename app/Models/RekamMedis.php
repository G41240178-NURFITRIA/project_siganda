<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

       protected $fillable = [
        'no_rm',
        'nama_pasien',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',            // Tambahkan ini
        'no_telepon',        // Tambahkan ini
        'keluhan_utama',
        'riwayat_penyakit',
        'status_validasi',
        'diagnosa_dokter',
        'tindakan_dokter'
    ];
}
