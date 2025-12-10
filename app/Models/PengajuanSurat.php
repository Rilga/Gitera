<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','slug','title','data','files','status','verified_by','notes'
    ];

    protected $casts = [
        'data' => 'array',
        'files' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function verifier()
    {
        return $this->belongsTo(\App\Models\User::class, 'verified_by');
    }
}
