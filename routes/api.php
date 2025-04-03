<?php

use App\Http\Controllers\Api\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/{id}', [StudentController::class, 'show']);

// Route::get('/students/{id}', function($id){
//     return "Detalles del estudiante con id: $id";
// });

Route::post('/students', function (Request $request){
    return "Creando estudiante";
});

Route::put('/students', function (Request $request){
    return "Actualizando estudiante";
});
Route::delete('/students/{id}', function ($id){
    return "Eliminando estudiante con ID: $id";
});
Route::patch('/students/{id}', function ($id){
    return "Actualizando estudiante con ID: $id";
});


