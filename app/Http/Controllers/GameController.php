<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::where('user_id', Auth::id())->get();
        return response()->json($games);
    }

    public function store(Request $request)
    {
        $game = Game::create([
            'user_id' => Auth::id(),
            'clicks' => 0,
            'points' => 0,
            'duration' => null,
        ]);

        return response()->json([
            'message' => 'Partida creada correctamente',
            'game' => $game
        ], 201);
    }


    public function show(Game $game)
    {
        if ($game->user_id !== Auth::id()) {
            return response()->json(['error' => 'No tienes permisos.'], 403);
        }

        return response()->json($game);
    }


    public function update(Request $request, Game $game)
    {
        if ($game->user_id !== Auth::id()) {
            return response()->json(['error' => 'No tienes permisos.'], 403);
        }

        $game->update([
            'clicks' => $request->input('clicks'),
            'points' => $request->input('points'),
            'duration' => $request->input('duration')
        ]);

        return response()->json([
            'message' => 'Game updated successfully',
            'game info' => $game
        ]);
    }


    public function destroy(Game $game)
    {
        if ($game->user_id !== Auth::id() && !Auth::user()->isAdmin) {
            return response()->json(['error' => 'No tienes permiso para  eliminar esta partida'], 403);
        }

        $game->delete();

        return response()->json([
            'message' => 'Partida eliminada correctamente.'
        ]);
    }

    public function getGamesByUserId($id)
    {
        // Si es admin
        if (!Auth::user()->isAdmin) {
            return response()->json(['error' => 'No tienes permisos'], 403);
        }

        // partidas del usuario con id pasado por parámetro
        $games = Game::where('user_id', $id)->with('user')->get();

        if ($games->isEmpty()) {
            return response()->json(['message' => 'Este usuario no tiene ninguna partida o no existe'], 404);
        }

        return response()->json([
            'message' => 'Partidas del usuario encontradas.',
            'data' => $games
        ]);
    }

    public function ranking()
    {
        $ranking = Game::select('user_id')
            ->selectRaw('MIN(duration) as best_time')
            ->selectRaw('MIN(clicks) as min_clicks')
            ->selectRaw('MAX(points) as max_points')
            ->groupBy('user_id')
            ->orderBy('best_time')
            ->orderBy('min_clicks')
            ->with('user')
            ->take(5)
            ->get();

        return response()->json($ranking);
    }
}
