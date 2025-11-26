<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gelombang extends Model
{
    use HasFactory;
    protected $table = 'gelombang';
    protected $fillable = [
        'nama',
        'tahun', 
        'tgl_mulai', 
        'tgl_selesai',
        'kuota', 
        'biaya_daftar', 
        
    ];

    // Kolom yang harus diubah tipe datanya secara otomatis
    protected $casts = [
        'tgl_mulai' => 'date',
        'tgl_selesai' => 'date',
    ];
    
    public function pendaftar()
    {
        return $this->hasMany(Pendaftar::class, 'gelombang_id');
    }
}