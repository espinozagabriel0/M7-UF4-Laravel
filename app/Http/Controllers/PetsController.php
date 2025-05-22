<?php

namespace App\Http\Controllers;

use App\Models\Pets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PetsController extends Controller
{
    public function index()
    {
        $pets = Pets::where('user_id', Auth::id())->get();
        return response()->json($pets);
    }

    public function getPetsByUserId($id)
    {
        if (!Auth::user()->isAdmin) {
            return response()->json(['error' => 'No tienes permisos'], 403);
        }

        $pets = Pets::where('user_id', $id)->with('user')->get();

        if ($pets->isEmpty()) {
            return response()->json(['message' => 'Este usuario no tiene ninguna mascota o no existe.'], 404);
        }

        return response()->json([
            'message' => 'Mascotas del usuario encontradas.',
            'data' => $pets
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'peso' => 'required|numeric',
            'imagen' => 'nullable|string|max:255',
            'desc'   => 'nullable|string|max:255',
        ]);

        $mascota = Pets::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'peso' => $request->peso,
            'imagen' => $request->imagen,
            'desc' => $request->desc
        ]);

        return response()->json([
            'message' => 'Mascota guardada correctamente.',
            'mascota' => $mascota
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $pet = Pets::find($id);
        $user = Auth::user();

        if (!$pet) {
            return response()->json(['message' => 'Mascota no encontrada.'], 404);
        }

        if ($pet->user_id !== $user->id) {
            return response()->json(['error' => 'No autorizado.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:50',
            'peso'  => 'required|numeric|min:0',
            'imagen' => 'nullable|string|max:255',
            'desc'   => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $pet->update($request->all());

        return response()->json(['mascota' => $pet], 200);
    }



    public function partialUpdate(Request $request, $id)
    {
        $pet = Pets::find($id);
        $user = Auth::user();

        if (!$pet) {
            return response()->json(['message' => 'Mascota no encontrada.'], 404);
        }

        if ($pet->user_id !== $user->id) {
            return response()->json(['error' => 'No autorizado.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'name'   => 'sometimes|string|max:50',
            'peso'   => 'sometimes|numeric|min:0',
            'imagen' => 'sometimes|nullable|string|max:255',
            'desc'   => 'sometimes|nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $pet->update($request->all());

        return response()->json(['mascota' => $pet], 200);
    }


    // eliminar mascota propia
    public function destroy(Request $request, $id)
    {
        $pet = Pets::find($id);
        $user = Auth::user();

        if (!$pet) {
            return response()->json(['message' => 'Mascota no encontrada.'], 404);
        }

        if ($pet->user_id !== $user->id) {
            return response()->json(['error' => 'No autorizado.'], 403);
        }

        $pet->delete();

        return response()->json([
            'message' => 'Mascota eliminada correctamente.'
        ], 200);
    }
}
