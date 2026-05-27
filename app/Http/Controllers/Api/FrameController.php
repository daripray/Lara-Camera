<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CameraSession;
use App\Services\FrameStorageService;
use Illuminate\Http\Request;

class FrameController extends Controller
{
    public function upload(
        Request $request,
        FrameStorageService $storageService
    ) {

        $request->validate([
            'token' => ['required'],
            'session_id' => ['required'],
            'frame' => ['required', 'image'],
            'captured_at' => ['required'],
            'motion_score' => ['nullable'],
        ]);

        $device = Device::where(
            'token',
            $request->token
        )
            ->firstOrFail();

        $session = CameraSession::where(
            'id',
            $request->session_id
        )
            ->where(
                'device_id',
                $device->id
            )
            ->firstOrFail();

        $device->update([
            'last_seen_at' => now(),
        ]);

        $frame = $storageService->store(
            session: $session,
            file: $request->file('frame'),
            capturedAt: $request->captured_at,
            motionScore: $request->motion_score
        );

        return response()->json([
            'success' => true,
            'frame_id' => $frame->id,
        ]);
    }
}
