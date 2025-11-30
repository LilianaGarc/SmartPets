<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Publicacion;
use App\Http\Controllers\Controller;


class UserController
{
    public function dashboard()
    {
        return view('panelAdministrativo.principalPanel');
    }

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

    public function search(Request $request)
    {
        $nombre = $request->get('nombre');

        $users = User::orderBy('created_at', 'desc')
            ->where(function ($query) use ($nombre) {
                $query->where('name', 'LIKE', "%$nombre%")
                    ->orWhere('email', 'LIKE', "%$nombre%");
            })
            ->get();

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
            'name' => 'required|string|max:20',
            'email' => 'required|email|max:100|unique:users,email',
            'telefono' => 'nullable|string|max:8|regex:/^[2389]\d{7}$/',
            'direccion' => 'nullable|string|max:150',
            'descripción' => 'nullable|string|max:200',
            'usertype' => 'required|in:admin,user',
            'password' => 'required|string|min:8|max:25',
        ]);

        $type = $request->input('usertype');
        if (!in_array($type, ['admin', 'user'])) {
            return redirect()->back()->withErrors(['usertype' => 'Tipo de usuario inválido.']);
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->password);
        $user->telefono = $request->input('telefono');
        $user->direccion = $request->input('direccion');
        $user->descripción = $request->input('descripción');
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

    public function perfil(string $id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('panelAdministrativo.usersForm')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (strtolower(trim($request->input('email'))) == 'smartpetsunah@gmail.com'){
            $request->merge(['usertype' => 'admin']);
        }
        
        $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|email|max:100|unique:users,email,' . $id,
            'usertype' => 'required|in:admin,user',
            'telefono' => 'nullable|string|max:8|regex:/^[2389]\d{7}$/',
            'direccion' => 'nullable|string|max:100',
            'descripción' => 'nullable|string|max:200',

            'password' => 'nullable|min:8|max:25',
        ]);


        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->telefono = $request->input('telefono');
        $user->direccion = $request->input('direccion');
        $user->descripción = $request->input('descripción');
        $user->usertype = $request->input('usertype');

        if ($request->filled('password')) {
            // ...entonces se hashea y se añade a los datos que se van a guardar.
            $data['password'] = Hash::make($request->password);
        }


        if ($user->update()) {
            return redirect()->route('users.panel')->with('exito', 'El usuario se editó correctamente.');
        } else {
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
        $user = User::findOrFail($id);

            if ($user->rol == 'admin') {
                return redirect()->route('users.panel')->with('fracaso', 'No se puede eliminar a un usuario administrador.');
            }

            if (Auth::user()->id == $id) {
                return redirect()->route('users.panel')->with('fracaso', 'No puedes eliminar tu propia cuenta.');
            }

            $user->delete();

            return redirect()->route('users.panel')->with('exito', 'Usuario eliminado correctamente.');
        }
    }
