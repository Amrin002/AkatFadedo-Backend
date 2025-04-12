<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasDesa extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'fasilitas_pendidikan',
        'fasilitas_kesehatan',
        'luas_wilayah'
    ];
}
