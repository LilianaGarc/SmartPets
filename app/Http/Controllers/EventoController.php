<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use Illuminate\Support\Facades\Storage;

class EventoController
{
    public function panel()
    {
        $eventos = Evento::all();
        return view('panelAdministrativo.eventosIndex')->with('eventos', $eventos);
    }

    public function search( Request $request)
    {
        $nombre = $request->get('nombre');
        $eventos = Evento::orderby('created_at', 'desc')
            ->where('nombre', 'LIKE', "%$nombre%")
            ->where('descripcion', 'LIKE', "%$nombre%")
            ->where('participantes', 'LIKE', "%$nombre%")
            ->orWhere('telefono', 'LIKE', "%$nombre%")->get();
        return view('panelAdministrativo.eventosIndex')->with('eventos', $eventos);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventos = Evento::paginate(15);
        return view('eventos.index', compact('eventos'));
    }


    public function create()
    {
        return view('eventos.formulario');
    }


    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'telefono' => 'required|string|max:15',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $rutaImagen = $request->file('imagen')->store('eventos', 'public');
        Evento::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'telefono' => $request->telefono,
            'imagen' => $rutaImagen,

        ]);

        return redirect()->route('eventos.index')->with('exito', 'Evento creado correctamente.');
    }


    public function show($id)
    {
        $evento = Evento::findOrFail($id);
        return view('eventos.show', compact('evento'));
    }


    public function edit($id)
    {
        $evento = Evento::findOrFail($id);
        return view('eventos.edit', compact('evento'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'telefono' => 'required| |max:15',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);


        $evento = Evento::findOrFail($id);


        if ($request->hasFile('imagen')) {
            if ($evento->imagen && Storage::exists('public/' . $evento->imagen)) {
                Storage::delete('public/' . $evento->imagen);
            }
            $imagenPath = $request->file('imagen')->store('eventos', 'public');
            $evento->imagen = $imagenPath;
        }

        $evento->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'telefono' => $request->telefono,
            'imagen' => $evento->imagen ?? null,
        ]);



        $evento->update($request->all());

        return redirect()->route('eventos.index')->with('exito', 'Evento actualizado correctamente.');
    }

    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);
        if ($evento->imagen && Storage::exists('public/' . $evento->imagen)) {
            Storage::delete('public/' . $evento->imagen);
        }
        $evento->delete();

        return redirect()->route('eventos.index')->with('exito', 'Evento eliminado correctamente.');
    }


    public function participar($id)
    {
        $evento = Evento::findOrFail($id);
        return redirect()->route('eventos.show', $evento->id)->with('exito', 'Te has registrado en el evento.');
    }

    public function paneldestroy(string $id)
    {
        $eliminados = Evento::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('eventos.panel')->with('fracaso', 'El evento no se pudo borrar.');
        }else {
            return redirect()->route('eventos.panel')->with('exito', 'El evento se elimino correctamente.');
        }
    }
}
