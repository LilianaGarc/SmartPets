<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController
{
    public function panel()
    {
        $users = User::all();
        return view('panelAdministrativo.usersIndex')->with('users', $users);
    }

    public function panelcreate()
    {
        return view('panelAdministrativo.usersForm');
    }

    public function paneledit(string $id)
    {
        $user = User::findOrFail($id);
        return view('panelAdministrativo.usersForm')->with('user', $user);
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
        $request->validate([
            'name' => 'required|string|max:300',
            'email' => 'required|email|max:300|unique:users,email',
            'usertype' => 'required',
            'password' => 'required|string|min:8|max:300',
        ]);

        $type = $request->input('usertype');
        if (!in_array($type, ['admin', 'user'])) {
            return redirect()->back()->withErrors(['usertype' => 'Tipo de usuario inválido.']);
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->password);
        $user->usertype = $type;

        if ($user->save()) {
            return redirect()->route('users.panel')->with('exito', 'El usuario se creó correctamente.');
        } else {
            return redirect()->route('users.panel')->with('fracaso', 'El usuario no se pudo crear.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('panelAdministrativo.usersDetalles', compact('user'));
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
        $request->validate([
            'name' => 'required|max:300|regex:/[a-zA-Z0-9 ]+/',
            'email' => 'required|max:300|regex:/[a-zA-Z0-9 ]+/|unique:users,email,'.$id,
            'usertype' => 'required',
            'password' => 'required|max:300|regex:/[a-zA-Z0-9 ]+/',
        ]);
        $type = $request->input('usertype');
        if ($type == "Administrador") {
            $type = "admin";
        } else { $type = "user"; }

        $user = User::findorfail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->password);
        $user->usertype = $type;

        // Guardar   Save()
        if ($user->save()){
            return redirect()->route('users.panel')->with('exito', 'El usuario se edito correctamente.');
        }else{
            return redirect()->route('users.panel')->with('fracaso', 'El usuario no se pudo editar.');
        }
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
