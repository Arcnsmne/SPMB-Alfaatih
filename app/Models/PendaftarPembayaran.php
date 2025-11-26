<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftarPembayaran extends Model
{
    protected $table = 'pendaftar_pembayaran';
    public $timestamps = false;
    
    protected $fillable = [
        'pendaftar_id',
        'metode',
        'jumlah',
        'bukti',
        'status',
        'catatan'
    ];
}
