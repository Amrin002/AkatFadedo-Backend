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
        'pendapatan',
        'penyelenggaraan',
        'pelaksanaan',
        'pembinaan',
        'pemberdayaan',
        'penanggulangan',
        'tahun',
        'file',
<<<<<<< HEAD
=======
        'user_id',
>>>>>>> c21d99f2349f0791ddd42b39c9c2d17e529d1361
    ];
}
