<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController
{
    public function panel()
    {
        $users = User::all();
        return view('panelAdministrativo.usersIndex')->with('users', $users);
    }

    public function search( Request $request)
    {
        $nombre = $request->get('nombre');
        $users = User::orderby('created_at', 'desc')
            ->where('name', 'LIKE', "%$nombre%")
            ->orWhere('email', 'LIKE', "%$nombre%")->get();
        return view('panelAdministrativo.usersIndex')->with('users', $users);
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
        $eliminados = User::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('users.panel')->with('fracaso', 'El usuario no se pudo borrar.');
        }else {
            return redirect()->route('users.panel')->with('exito', 'El usuario se elimino correctamente.');
        }
    }
}
