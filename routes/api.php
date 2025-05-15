<?php

// use App\Http\Controllers\Api\CardsController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GameController;
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

// Tarjetas publicas
// Route::get('/public-cards', [CardsController::class, 'publicCards']);

// PROTECTED ROUTES

Route::middleware([IsUserAuth::class])->group(function () {
    // Auth
    Route::post(('logout'), [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'getUser']);

    // Crear card
    Route::post('/cards', [CardsController::class, 'store']);

    // Mis cartas
    Route::get('/my-cards', [CardsController::class, 'myCards']);


    // Categorias
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

    Route::get('/cards/category/{categoryId}', [CardsController::class, 'getByCategory']);

    // Partidas
    Route::get('/games', [GameController::class, 'index']);
    Route::post('/games', [GameController::class, 'store']);
    Route::put('/games/{game}/finish', [GameController::class, 'update']);
    Route::get('/ranking', [GameController::class, 'ranking']);
});

// ADMIN ROUTES
Route::middleware([IsAdmin::class])->group(function () {
    // Usuarios
    Route::get('users', [AuthController::class, 'getUsers']);
    Route::get('/users/{id}', [AuthController::class, 'getUserById']);
    Route::put('/users/{id}', [AuthController::class, 'updateUser']);
    Route::delete('/users/{id}', [AuthController::class, 'deleteUser']);

    // CRUD Cards
    Route::post('/cards', [CardsController::class, 'store']);
    Route::put('/cards/{id}', [CardsController::class, 'update']);
    Route::delete('/cards/{id}', [CardsController::class, 'destroy']);

    // CRUD Partidas
    Route::get('/games', [GameController::class, 'index']);
    Route::delete('/games/{game}', [GameController::class, 'destroy']);
    Route::get('/users/{id}/games', [GameController::class, 'getGamesByUserId']);
});
