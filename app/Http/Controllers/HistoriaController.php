<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historia;
use App\Models\StoryMedia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class HistoriaController extends Controller
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
        return view('stories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'files' => 'required|array|min:1|max:10',
            'files.*' => 'mimes:jpeg,png,jpg,gif,mp4,mov,ogg,qt|max:20480',
            'captions.*' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $historia = new Historia();
            $historia->user_id = auth()->id();
            $historia->expires_at = now()->addHours(24);
            $historia->save();

            foreach ($request->file('files') as $index => $file) {
                // *** ¡CAMBIO CLAVE AQUÍ! ***
                // Almacenar directamente en el subdirectorio 'historias' del disco 'public'.
                // Esto guardará el archivo en storage/app/public/historias/
                $filePath = $file->store('historias', 'public'); // Elimina 'public/' del primer argumento

                // $filePath ahora ya contendrá algo como 'historias/nombre_del_archivo.ext'
                // Por lo tanto, ¡ya no necesitas el str_replace!
                // $publicPath = str_replace('public/', '', $filePath); // ¡Elimina esta línea!

                StoryMedia::create([ // Asumo que StoryMedia es tu modelo para HistoriaMedia
                    'historia_id' => $historia->id,
                    'file_path' => $filePath, // Usa directamente $filePath
                    'file_type' => $file->getClientMimeType(),
                    'caption' => $request->input("captions.{$index}"),
                    'order' => $index,
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Historia creada con éxito'], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error al crear la historia', 'error' => $e->getMessage()], 500);
        }
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
