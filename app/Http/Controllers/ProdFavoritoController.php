<?php

namespace App\Http\Controllers;


use App\Models\ProdFavorito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdFavoritoController extends Controller
{
    public function index()
    {
        return view('productos.productos-guardados', [
            'prod_favoritos' => ProdFavorito::all(),
        ]);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
        ]);
        $favorito = ProdFavorito::where('user_id', $user->id)
            ->where('producto_id', $request->producto_id)
            ->first();
        if (!$favorito) {
            ProdFavorito::create([
                'user_id' => $user->id,
                'producto_id' => $request->producto_id,
                'fecha_favorito' => now(),
            ]);
            return redirect()->back()->with('success', 'Producto guardado');
        }
        return redirect()->back()->with('error', 'El producto ya está guardado');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id, Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'producto_id' => 'required|exists:productos,id',
        ]);
        $favorito = ProdFavorito::where('user_id', $user->id)
            ->where('producto_id', $request->producto_id)
            ->first();

        if ($favorito) {
            $favorito->delete();
            return redirect()->back()->with('success', 'Producto eliminado de "Productos Guardados"');
        } else {
            return redirect()->back()->with('error', 'El producto no está en "Productos Guardados"');
        }
    }
}
