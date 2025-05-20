<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Apbdes extends Model
{
    //
    use HasFactory;
    protected $table = 'apbdes';
    protected $fillable = [
        'penyelenggaraan',
        'pelaksanaan',
        'pembinaan',
        'pemberdayaan',
        'penanggulangan',
        'file',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
