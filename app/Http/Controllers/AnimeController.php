<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    public function index(Request $request)
    {
        $animes = Anime::query();

        // Filter by title if the 'title' query parameter is present
        if ($request->has('title')) {
            $title = $request->input('title');
            $animes->where('title', 'like', "%$title%");
        }

        return response()->json($animes->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'season' => 'required',
            'episode' => 'required',
        ]);

        $anime = Anime::create($request->all());

        return response()->json($anime, 201);
    }

    public function show(Anime $anime)
    {
        return response()->json($anime, 200);
    }

    public function update(Request $request, Anime $anime)
    {
        $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'season' => 'required',
            'episode' => 'required',
        ]);

        $anime->update($request->all());

        return response()->json($anime, 200);
    }

    public function destroy(Anime $anime)
    {
        $anime->delete();

        return response()->json(null, 204);
    }

    public function generateSampleAnime()
    {
        // Use the factory to create a sample anime
        $anime = Anime::factory()->create();
        return response()->json($anime);
    }
}