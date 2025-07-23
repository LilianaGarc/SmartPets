<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HistoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stories = Story::where('created_at', '>=', now()->subDay())->with('user')->latest()->get();
        return view('.index', compact('historias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'media' => 'required|file|mimes:jpg,jpeg,png,mp4|max:10240',
        ]);

        $file = $request->file('media');
        $path = $file->store('stories', 'public');

        $story = Historia::create([
            'user_id' => auth()->id(),
            'media_path' => $path,
            'media_type' => $file->getMimeType() === 'video/mp4' ? 'video' : 'image',
            'expires_at' => now()->addHours(24),
        ]);

        return response()->json(['message' => 'Historia publicada', 'story' => $story]);
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
    public function destroy(string $id)
    {
        //
    }
}
