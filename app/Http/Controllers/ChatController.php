<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController
{
    public function panel()
    {
        $chats = Chat::all();
        return view('panelAdministrativo.chatsIndex')->with('chats', $chats);
    }
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
    public function store(Request $request)
    {
        //
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

    public function paneldestroy(string $id)
    {
        $eliminados = Chat::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('chats.panel')->with('fracaso', 'El chat no se pudo borrar.');
        }else {
            return redirect()->route('chats.panel')->with('exito', 'El chat se elimino correctamente.');
        }
    }
}
