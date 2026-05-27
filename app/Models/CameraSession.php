<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CameraSession extends Model
{
    protected $fillable = [
        'device_id',
        'started_at',
        'ended_at',
        'is_recording',
        'motion_detected',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        'is_recording' => 'boolean',
        'motion_detected' => 'boolean',
    ];

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}
