<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'message',
        'related_id',
        'related_type',
        'is_read',
        'data'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'data' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public static function createNotification($userId, $type, $message, $relatedId = null, $relatedType = null, $data = null)
    {
        return self::create([
            'user_id' => $userId,
            'type' => $type,
            'message' => $message,
            'related_id' => $relatedId,
            'related_type' => $relatedType,
            'is_read' => false,
            'data' => $data
        ]);
    }
}
