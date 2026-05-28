<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CameraSession;
use App\Models\Device;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function start(Request $request)
    {
        $request->validate([
            'token' => ['required'],
        ]);

        $device = Device::where('token', $request->token)
            ->firstOrFail();

        $device->update([
            'last_seen_at' => now(),
            'status' => 'online',
        ]);

        $session = CameraSession::create([
            'device_id' => $device->id,
            'started_at' => now(),
            'is_recording' => true,
            'motion_detected' => false,
        ]);

        return response()->json([
            'success' => true,
            'session_id' => $session->id,
        ]);
    }

    public function stop(Request $request)
    {
        $request->validate([
            'session_id' => ['required'],
        ]);

        $session = CameraSession::findOrFail($request->session_id);

        $session->update([
            'ended_at' => now(),
            'is_recording' => false,
        ]);

        return response()->json([
            'success' => true,
        ]);
    }
}
