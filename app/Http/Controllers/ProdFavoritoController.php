<?php

namespace App\Http\Controllers;

class ProdFavoritoController extends Controller
{
    public function index()
    {
        return view('productos.productos-guardados', [
            'prod_favoritos' => \App\Models\Prod_favorito::all(),
        ]);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

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

    public function destroy($id)
    {

    }
}
