<?php

use App\Http\Controllers\Api\CardsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/cards', [CardsController::class, 'index']);
Route::get('/cards/{id}', [CardsController::class, 'show']);
Route::post('/cards', [CardsController::class, 'store']);
Route::put('/cards/{id}', [CardsController::class, 'update']);
Route::delete('/cards/{id}', [CardsController::class, 'destroy']);
