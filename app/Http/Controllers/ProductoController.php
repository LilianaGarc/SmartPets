<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function index(Request $request)
    {
        $busqueda = $request->input('query');

        $productos = Producto::when($busqueda, function ($query) use ($busqueda) {
            return $query->where('nombre', 'LIKE', "%$busqueda%")
                ->orWhere('descripcion', 'LIKE', "%$busqueda%")
                ->orWhere('precio', 'LIKE', "%$busqueda%");
        })->paginate(12);

        return view('productos.productos-lista')->with([
            'productos' => $productos,
            'categorias' => Categoria::limit(5)->get()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.productos-formulario', ['categorias' => $categorias]);

    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'precio' => ['required', 'numeric', 'regex:/^\d{1,10}(\.\d{1,2})?$/'],
            'descripcion' => 'nullable|string',
            'categoria' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'imagenes.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ], [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'precio.required' => 'El precio del producto es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'descripcion.string' => 'La descripción debe ser un texto.',
            'categoria.required' => 'La categoría es obligatoria.',
            'stock.required' => 'La cantidad disponible es obligatoria.',
            'imagenes.*.image' => 'Cada archivo debe ser una imagen.',
            'imagenes.*.mimes' => 'Las imágenes deben estar en formato JPG, JPEG, PNG o GIF.',
            'imagenes.*.max' => 'Cada imagen no debe superar los 2MB.'
        ]);

        // Validar la cantidad de imágenes
        if ($request->hasFile('imagenes') && count($request->file('imagenes')) > 5) {
            return redirect()->back()->withErrors(['imagenes' => 'No se pueden subir más de 5 imágenes.'])->withInput();
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Crear o encontrar la categoría
        $categoria = $request->categoria_id ? Categoria::findOrFail($request->categoria_id) : Categoria::firstOrCreate(['nombre' => $request->categoria]);

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
            return redirect()->route('productos.index')->with('success', 'Producto publicado correctamente');
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
        $categorias = Categoria::all();
        return view('productos.productos-formulario',['producto' => $producto, 'categorias' => $categorias]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'precio' => ['required', 'numeric', 'regex:/^\d{1,10}(\.\d{1,2})?$/'],
            'descripcion' => 'nullable|string',
            'categoria' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'imagenes.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ], [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'precio.required' => 'El precio del producto es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'descripcion.string' => 'La descripción debe ser un texto.',
            'categoria.required' => 'La categoría es obligatoria.',
            'stock.required' => 'La cantidad disponible es obligatoria.',
            'imagenes.*.image' => 'Cada archivo debe ser una imagen.',
            'imagenes.*.mimes' => 'Las imágenes deben estar en formato JPG, JPEG, PNG o GIF.',
            'imagenes.*.max' => 'Cada imagen no debe superar los 2MB.'
        ]);

        // Validar la cantidad de imágenes
        if ($request->hasFile('imagenes') && count($request->file('imagenes')) > 5) {
            return redirect()->back()->withErrors(['imagenes' => 'No se pueden subir más de 5 imágenes.'])->withInput();
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Crear o encontrar la categoría
        $categoria = $request->categoria_id ? Categoria::findOrFail($request->categoria_id) : Categoria::firstOrCreate(['nombre' => $request->categoria]);

        // Almacenar las imágenes si están presentes
        $imagenesGuardadas = [];
        if ($request->hasFile('imagenes')) {
            $imagenes = $request->file('imagenes');
            foreach ($imagenes as $imagen) {
                $rutaImagen = $imagen->store('public/productos');
                $imagenesGuardadas[] = $rutaImagen;
            }
        }

        // Actualizar el producto
        $producto = Producto::findOrFail($id);
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->descripcion = $request->input('descripcion');
        $producto->categoria_id = $categoria->id;
        $producto->stock = $request->input('stock');
        $producto->imagen = $imagenesGuardadas[0] ?? $producto->imagen;
        $producto->imagen2 = $imagenesGuardadas[1] ?? $producto->imagen2;
        $producto->imagen3 = $imagenesGuardadas[2] ?? $producto->imagen3;
        $producto->imagen4 = $imagenesGuardadas[3] ?? $producto->imagen4;
        $producto->imagen5 = $imagenesGuardadas[4] ?? $producto->imagen5;

        if ($producto->save()) {
            return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar producto');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $eliminados = Producto::destroy($id);

        if ($eliminados > 0) {
            return redirect()->route('productos.index')->with('success', 'El producto se eliminó correctamente.');
        } else {
            return redirect()->route('productos.index')->with('error', 'El producto no se pudo borrar.');
        }
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

    public function buscar(Request $request)
    {
        $query = $request->input('query');
        $productos = Producto::when($query, function ($q) use ($query) {
            return $q->where('nombre', 'like', "%$query%")->orWhere('descripcion', 'like', "%$query%");
        })->get();

        return response()->json($productos);
    }

}
