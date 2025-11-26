<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    protected $table = 'regencies';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'name', 'province_id'];
    
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }
    
    public function districts()
    {
        return $this->hasMany(District::class, 'regency_id');
    }
}
