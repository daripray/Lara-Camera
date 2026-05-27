<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\FrameController;

Route::post('/register', [AuthController::class, 'register']);

Route::post('/session/start', [
    SessionController::class,
    'start'
]);

Route::post('/frame/upload', [
    FrameController::class,
    'upload'
]);

Route::post('/session/stop', [
    SessionController::class,
    'stop'
]);
