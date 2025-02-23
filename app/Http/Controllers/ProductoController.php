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
        // Validación de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => ['required', 'numeric', 'regex:/^\d{1,10}(\.\d{1,2})?$/'],
            'descripcion' => 'nullable|string',
            'categoria' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'imagenes.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        // Crear o encontrar la categoría
        $categoria = Categoria::firstOrCreate(['nombre' => $request->categoria]);

        // Almacenar las imágenes si están presentes
        $imagenesGuardadas = [];
        if ($request->hasFile('imagenes')) {
            $imagenes = $request->file('imagenes');
            foreach ($imagenes as $imagen) {
                $rutaImagen = $imagen->store('public/productos');
                $imagenesGuardadas[] = $rutaImagen;
            }
        }

        // Crear el producto
        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->descripcion = $request->input('descripcion');
        $producto->categoria_id = $categoria->id;
        $producto->stock = $request->input('stock');
        $producto->imagen = $imagenesGuardadas[0] ?? null;
        $producto->imagen2 = $imagenesGuardadas[1] ?? null;
        $producto->imagen3 = $imagenesGuardadas[2] ?? null;
        $producto->imagen4 = $imagenesGuardadas[3] ?? null;
        $producto->imagen5 = $imagenesGuardadas[4] ?? null;

        if ($producto->save()) {
            return redirect()->back()->with('success', 'Producto publicado correctamente');
        } else {
            return redirect()->back()->with('error', 'Error al publicar producto');
        }
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
