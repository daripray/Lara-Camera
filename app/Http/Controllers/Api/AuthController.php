<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'token' => ['nullable', 'string'],
            'device_name' => ['required_without:token', 'string'],
        ]);

        // Validasi  Email
        $user = User::where('email', $request->email)
            ->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan',
            ], 404);
        }

        // Validasi Password
        if (!Hash::check(
            $request->password,
            $user->password
        )) {
            return response()->json([
                'success' => false,
                'message' => 'Password salah',
            ], 401);
        }

        // Validasi Token
        if ($request->filled('token')) {
            $device = Device::where('user_id', $user->id)
                ->where('token', $request->token)
                ->first();
            if ($device) {
                $device->update([
                    'last_seen_at' => now(),
                    'status' => 'online',
                ]);

                return response()->json([
                    'success' => true,
                    'device_id' => $device->id,
                    'token' => $device->token,
                ]);
            }
        }

        // Generate New Token
        $token =
            $user->id . '_' .
            now()->timestamp . '_' .
            Str::upper(Str::random(8));

        // Buat Device
        $device = Device::create([
            'user_id' => $user->id,
            'name' => $request->device_name,
            'token' => $token,
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
