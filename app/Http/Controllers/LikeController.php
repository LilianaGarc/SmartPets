<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Publicacion;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Publicacion $publicacion)
    {
        $userId = Auth::id();

        if ($publicacion->likes()->where('user_id', $userId)->exists()) {
            return response()->json(['message' => 'Ya le diste Me Encanta a esta publicación.'], 409);
        }

        $like = $publicacion->likes()->create([
            'user_id' => $userId,
        ]);

        $newLikesCount = $publicacion->likes()->count();
        return response()->json(['message' => 'Me Encanta añadido.', 'likes_count' => $newLikesCount], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publicacion $publicacion)
    {
        $userId = Auth::id();

        $deleted = $publicacion->likes()->where('user_id', $userId)->delete();

        if (!$deleted) {
            return response()->json(['message' => 'No se encontró el Me Encanta para eliminar.'], 404);
        }

        $newLikesCount = $publicacion->likes()->count();
        return response()->json(['message' => 'Me Encanta eliminado.', 'likes_count' => $newLikesCount], 200);
    }
}
