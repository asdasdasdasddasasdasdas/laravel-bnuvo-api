<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Middleware\DebugHeaders;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('guests', GuestController::class)->middleware(DebugHeaders::class);;
