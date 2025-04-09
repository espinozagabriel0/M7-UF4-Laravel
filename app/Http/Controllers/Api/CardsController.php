<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CardsController extends Controller
{
    public function index(){
        $cards = Cards::all();
        return response()->json(['cards' => $cards], 200);
    }

    public function show($id){
        $card = Cards::find($id);
        if (!$card) {
            return response()->json(['message' => "Carta no encontrada."], 400);
        }
        return response()->json(['carta' => $card], 200);
    }
    public function store(Request $request){
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'url' => 'required|string|unique:Cards,url',
        ]);

        // Comprobar si la validación falla
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Crear el registro en la base de datos
        $card = Cards::create($request->all());

        // Retornar la respuesta con el registro creado
        return response()->json(['carta' => $card], 201);
    }
}
