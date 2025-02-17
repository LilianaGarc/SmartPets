<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('productos.productos-lista');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.productos-formulario');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validar los tipos de datos aceptados
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'categoria' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'activo' => 'required|boolean',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        //Función para acceder o crear la categoria si no existe

        $categoria = Categoria::firstOrCreate(['nombre'=>$request->categoria]);

        //Función para guardar la imagen
        $rutaImagen = null;
        if ($request->hasFile('imagen')){
            $rutaImagen = $request->file('imagen')->store('productos','public');
        }

        //Función para crear el producto

        Producto::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'categoria' => $request->categoria,
            'stock' => $request->stock,
            'activo' => $request->activo,
            'imagen' => $request->imagen
        ]);

        //Redireccionar cuando se guardan los datos

        return redirect()->back()->with('success','Producto creado correctamente');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('productos.productos-detalles');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('productos.productos-formulario');
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
