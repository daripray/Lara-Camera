<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Frame extends Model
{
    protected $fillable = [
        'session_id',
        'filename',
        'path',
        'captured_at',
        'motion_score',
    ];

    protected $casts = [
        'captured_at' => 'datetime',
        'motion_score' => 'float',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(CameraSession::class, 'session_id');
    }
}
