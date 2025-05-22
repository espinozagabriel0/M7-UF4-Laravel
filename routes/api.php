<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetsController;
use App\Http\Middleware\IsAuthenticated;
use App\Http\Middleware\IsUserAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// PUBLIC ROUTES
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware([IsAuthenticated::class])->group(function () {
    // Auth
    Route::post(('logout'), [AuthController::class, 'logout']);
    // Route::get('me', [AuthController::class, 'getUser']);

    // Mascotas
    Route::get('/pets', [PetsController::class, 'index']);
    Route::post('/pets', [PetsController::class, 'store']);
    Route::put('/pets/{id}', [PetsController::class, 'update']);
    Route::patch('/pets/{id}', [PetsController::class, 'partialUpdate']);
    Route::delete('/pets/{id}', [PetsController::class, 'destroy']);

});

Route::middleware([IsUserAdmin::class])->group(function () {
    // Usuarios
    Route::get('users', [AuthController::class, 'getUsers']);
    Route::get('/users/{id}', [AuthController::class, 'getUserById']);
    Route::put('/users/{id}', [AuthController::class, 'updateUser']);
    Route::delete('/users/{id}', [AuthController::class, 'deleteUser']);

    // Pets
    Route::get('/users/{id}/pets', [PetsController::class, 'getPetsByUserId']);

});
