<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    protected $table = 'pendaftar';
    protected $fillable = [
        'user_id',
        'tanggal_daftar',
        'no_pendaftaran',
        'gelombang_id',
        'jurusan_id',
        'status',
        'user_verifikasi_adm',
        'tgl_verifikasi_adm',
        'user_verifikasi_payment',
        'tgl_verifikasi_payment',
        'catatan_keuangan',
        'tgl_verifikasi_keuangan',
        'verifikator_keuangan',
        'status_data'
    ];
    public $timestamps = false;
    
    public function dataSiswa()
    {
        return $this->hasOne(PendaftarDataSiswa::class, 'pendaftar_id', 'id');
    }
    
    public function berkas()
    {
        return $this->hasMany(PendaftarBerkas::class, 'pendaftar_id', 'id');
    }
    
    public function gelombang()
    {
        return $this->belongsTo(Gelombang::class, 'gelombang_id');
    }
    
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }
    
    public function dataOrtu()
    {
        return $this->hasOne(PendaftarDataOrtu::class, 'pendaftar_id', 'id');
    }
    
    public function asalSekolah()
    {
        return $this->hasOne(PendaftarAsalSekolah::class, 'pendaftar_id', 'id');
    }
    
    public function pembayaran()
    {
        return $this->hasOne(PendaftarPembayaran::class, 'pendaftar_id', 'id');
    }
}
