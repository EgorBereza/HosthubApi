<?php

use App\Http\Controllers\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/booking/availability', [BookingController::class, 'checkAvailability']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
