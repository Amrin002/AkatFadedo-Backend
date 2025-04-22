<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuratLainnya extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'surat_lainnyas';
    protected $fillable = [
        'type_surat',
        'nama',
        'keterangan',
        'file',
        'status',
        'user_id'
    ];
    protected $casts = [
        'status' => 'string',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
