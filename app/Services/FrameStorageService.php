<?php

namespace App\Services;

use App\Models\Frame;
use App\Models\CameraSession;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FrameStorageService
{
    /**
     * Simpan frame ke storage.
     */
    public function store(
        CameraSession $session,
        UploadedFile $file,
        string $capturedAt,
        ?float $motionScore = null
    ): Frame {

        /*
        |--------------------------------------------------------------------------
        | Struktur Folder
        |--------------------------------------------------------------------------
        |
        | storage/app/public/frames/
        |     device_1/
        |         session_45/
        |             172991919.jpg
        |
        */

        $deviceId = $session->device_id;

        $directory = "frames/device_{$deviceId}/session_{$session->id}";

        /*
        |--------------------------------------------------------------------------
        | Nama File
        |--------------------------------------------------------------------------
        |
        | gunakan timestamp dari device agar:
        | - urut
        | - ringan
        | - tidak perlu generate UUID
        |
        */

        $filename = now()->timestamp . '.jpg';

        /*
        |--------------------------------------------------------------------------
        | Simpan File
        |--------------------------------------------------------------------------
        */

        $path = $file->storeAs(
            $directory,
            $filename,
            'public'
        );

        /*
        |--------------------------------------------------------------------------
        | Simpan Metadata Database
        |--------------------------------------------------------------------------
        */

        return Frame::create([
            'session_id'   => $session->id,
            'filename'     => $filename,
            'path'         => $path,
            'captured_at'  => $capturedAt,
            'motion_score' => $motionScore,
        ]);
    }
}
