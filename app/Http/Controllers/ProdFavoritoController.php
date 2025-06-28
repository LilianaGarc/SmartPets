<?php

namespace App\Http\Controllers;

use App\Models\Prod_favorito;

class ProdFavoritoController extends Controller
{
    public function index()
    {
        return view('productos.productos-guardados', [
            'prod_favoritos' => Prod_favorito::all(),
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
