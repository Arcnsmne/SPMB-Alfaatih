<?php
// app/Models/Pendaftar.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftarDataSiswa extends Model
{
    use HasFactory;

    protected $table = 'pendaftar_data_siswa';

    protected $primaryKey = 'pendaftar_id'; // boleh tetap

    public $incrementing = false; // karena manual increment
    protected $keyType = 'int';  // karena integer AI
    public $timestamps = false; // ← MATIKAN timestamps
    protected $fillable = [
        'pendaftar_id',
        'nik',
        'nisn',
        'nama',
        'jk',
        'tmp_lahir',
        'tgl_lahir',
        'alamat',
        'wilayah_id',
        'lat',
        'lng'
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
    ];
    
    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah_id');
    }
    
    public function district()
    {
        return $this->belongsTo(District::class, 'wilayah_id');
    }
    
    public function sekolahAsal()
    {
        return $this->belongsTo(SekolahAsal::class, 'sekolah_asal_id');
    }
}
