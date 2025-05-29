<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\VideogameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/peliculas', function(){
//     return view('peliculas');
// });

// Route::get('/suma', function(){
//     return view('suma');
// });

// Route::post('/suma', function(Request $request){
//     $num1 = $request->input('num1');
//     $num2 = $request->input('num1');

//     $resultado = $num1 + $num2;

//     return view('suma', ['resultado' => $resultado]);
// });


Route::resource('books', BookController::class);
Route::resource('videogames', VideogameController::class);
