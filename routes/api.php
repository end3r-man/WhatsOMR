<?php

use App\Http\Controllers\Api\CheckController;
use App\Http\Controllers\Api\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/token', [CheckController::class, 'validateFormData'])->middleware('token');
Route::post('/message', [MessageController::class, 'HandleMessage']);
