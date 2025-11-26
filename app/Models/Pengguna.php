<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    protected $table = 'pengguna';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'hp',
        'password_hash',
        'role',
        'aktif',
         'otp',                    // Pastikan ada
        'otp_expired_at',  
    ];

    protected $hidden = ['password_hash'];

    // Agar auth memakai password_hash
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    // Hilangkan kolom remember_token (karena tabel tidak ada field itu)
    protected $rememberTokenName = '';
}
