<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Triage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama_pasien', 'umur', 'jenis_kelamin', 'alergi', 
        'keluhan_utama', 'td', 'suhu', 'nadi', 'respirasi', 'saturasi', 'kategori'
    ];
}
