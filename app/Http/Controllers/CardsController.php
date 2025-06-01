<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CardsController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->query('limit');

        if ($limit) {
            $cards = Cards::inRandomOrder()->take($limit)->get();
        } else {
            $cards = Cards::all();
        }
        return response()->json(['cards' => $cards], 200);
    }
    // obtener cards con user_id = null
    public function publicCards(Request $request)
    {
        $limit = $request->query('limit');

        if ($limit) {
            $cards = Cards::whereNull('user_id')
                ->inRandomOrder()
                ->take($limit)
                ->get();
        } else {
            $cards = Cards::whereNull('user_id')->get();
        }

        return response()->json(['cards' => $cards], 200);
    }


    public function show($id)
    {
        $card = Cards::find($id);
        if (!$card) {
            return response()->json(['message' => "Carta no encontrada."], 400);
        }
        return response()->json(['carta' => $card], 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'url' => 'required|url',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $card = Cards::create([
            'name' => $request->name,
            'url' => $request->url,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
        ]);


        // Retornar la respuesta con el registro creado
        return response()->json(['message' => 'Tarjeta creada', 'carta' => $card], 201);
    }
    public function update(Request $request, $id)
    {
        $card = Cards::find($id);
        $user = Auth::user();

        // Verificar si la carta existe
        if (!$card) {
            return response()->json(['message' => 'Carta no encontrada.'], 404);
        }

        if ($card->user_id !== $user->id && $user->role !== 'admin') {
            return response()->json(['error' => 'No autorizado.'], 403);
        }

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'url' => 'required|string|unique:cards,url',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        // Comprobar si la validación falla
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Actualizar los datos de la carta
        $card->update($request->all());

        // Retornar la respuesta con la carta actualizada
        return response()->json(['carta' => $card], 200);
    }
    public function destroy($id)
    {
        $card = Cards::find($id);
        $user = Auth::user();

        if (!$card) {
            return response()->json(['message' => 'Carta no encontrada.'], 404);
        }

        if ($card->user_id !== $user->id && $user->role !== 'admin') {
            return response()->json(['error' => 'No autorizado.'], 403);
        }

        $card->delete();
        return response()->json(['message' => 'Carta eliminada correctamente.'], 200);
    }

    // Obtener cartas filtradas por categoryId
    public function getByCategory($categoryId)
    {
        $cards = Cards::where('category_id', $categoryId)->get();

        return response()->json($cards);
    }

    public function myCards()
    {
        $cards = Cards::where('user_id', Auth::id())->get();

        return response()->json([
            'message' => 'Tus Tarjetas',
            'data' => $cards
        ]);
    }

    public function all()
    {
        return Cards::with('user', 'category')->get();
    }
    public function adminDestroy(Cards $card)
    {
        $card->delete();
        return response()->json(['message' => 'Targeta eliminada por admin']);
    }
    public function adminUpdate(Request $request, Cards $card)
    {
        $request->validate([
            'name' => 'sometimes|string|max:100',
            'url' => 'sometimes|url',
            'category_id' => 'nullable|exists:categories,id',
        ]);
        $card->update($request->all());
        return response()->json([
            'message' => 'Targeta actualizada por admin',
            'data' => $card
        ]);
    }
    // public function adminUpdate(Request $request, Cards $card)
    // {
    //     $request->validate([
    //         'name' => 'sometimes|string|max:100',
    //         'url' => 'sometimes|url',
    //         'category_id' => 'nullable|exists:categories,id',
    //     ]);
    //     $card->update($request->only(['name', 'url', 'category_id']));
    //     return response()->json([
    //         'message' => 'Tarjeta actualizada por admin',
    //         'data' => $card->fresh()
    //     ]);
    // }
}
