<?php

use App\Http\Controllers\Api\CheckController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/token', [CheckController::class, 'validateFormData'])->middleware('token');