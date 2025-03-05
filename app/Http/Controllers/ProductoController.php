<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function panel()
    {
        $productos = Producto::all();
        return view('panelAdministrativo.productosIndex')->with('productos', $productos);
    }

    public function search( Request $request)
    {
        $nombre = $request->get('nombre');
        $productos = Producto::orderby('created_at', 'desc')
            ->where('nombre', 'LIKE', "%$nombre%")
            ->where('descripcion', 'LIKE', "%$nombre%")
            ->where('precio', 'LIKE', "%$nombre%")
            ->orWhere('stock', 'LIKE', "%$nombre%")->get();
        return view('panelAdministrativo.productosIndex')->with('productos', $productos);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('productos.productos-lista')->with([
            'productos' => Producto::paginate(12),
            'categorias' => Categoria::limit(5)->get()
        ]);
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
        $producto = Producto::findOrFail($id);
        return view('productos.productos-detalles', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.productos-formulario',['producto' => $producto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
        $producto = Producto::findOrFail($id);
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function paneldestroy(string $id)
    {
        $eliminados = Producto::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('productos.panel')->with('fracaso', 'El producto no se pudo borrar.');
        }else {
            return redirect()->route('productos.panel')->with('exito', 'El producto se elimino correctamente.');
        }
    }
}
