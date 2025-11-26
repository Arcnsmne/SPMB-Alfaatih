<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'name', 'regency_id'];
    
    public function regency()
    {
        return $this->belongsTo(Regency::class, 'regency_id');
    }
    
    public function villages()
    {
        return $this->hasMany(Village::class, 'district_id');
    }
}
