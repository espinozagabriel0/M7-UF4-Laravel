<?php

// use App\Http\Controllers\Api\CardsController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardsController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUserAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// PUBLIC ROUTES
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('/cards', [CardsController::class, 'index']);
Route::get('/cards/{id}', [CardsController::class, 'show']);

// PROTECTED ROUTES

Route::middleware([IsUserAuth::class])->group(function (){
    Route::post(('logout'), [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'getUser']);
    //
    Route::post('/cards', [CardsController::class, 'store']);
});

// ADMIN ROUTES
Route::middleware([IsAdmin::class])->group(function (){
    Route::put('/cards/{id}', [CardsController::class, 'update']);
    Route::delete('/cards/{id}', [CardsController::class, 'destroy']);
});

