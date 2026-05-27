<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        $device = Device::create([
            'name' => $request->name,
            'token' => Str::random(60),
            'status' => 'online',
            'last_seen_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'device_id' => $device->id,
            'token' => $device->token,
        ]);
    }
}
