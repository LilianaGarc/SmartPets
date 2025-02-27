<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;

class EventoController
{
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
        ]);

        Evento::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'telefono' => $request->telefono,

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
            'telefono' => 'required|string|max:15',
        ]);

        $evento = Evento::findOrFail($id);
        $evento->update($request->all());

        return redirect()->route('eventos.index')->with('exito', 'Evento actualizado correctamente.');
    }

    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);
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
