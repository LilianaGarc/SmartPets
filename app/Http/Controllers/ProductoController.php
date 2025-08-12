<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Resenia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    // Mostrar listado de productos en el panel (con categoría)
    public function panel()
    {
        $productos = Producto::with('categoria')->get();
        return view('panelAdministrativo.productosIndex')->with('productos', $productos);
    }

    public function panelshow(string $id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        $resenias = $producto->resenias()->with('user')->get();
        return view('panelAdministrativo.productosDetalles', compact('producto','resenias','categorias'));
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
        $query = $request->input('search');
        $categoriaId = $request->input('categoria');
        $subcategoriaId = $request->input('subcategoria');
        $productos = Producto::query()->where('activo', true);
        if ($query){
            $productos->where('nombre', 'LIKE', '%'.$query.'%');
        }
        if ($categoriaId){
            $productos->where('categoria_id', $categoriaId);
        }
        if ($subcategoriaId){
            $productos->where('subcategoria_id', $subcategoriaId);
        }
        $productos = $productos->paginate(12);
        $categorias = Categoria::limit(6)->get();
        return view('productos.productos-lista', compact('productos', 'categorias','query', 'categoriaId', 'subcategoriaId'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::with('subcategorias')->get();
        return view('productos.productos-formulario', ['categorias' => $categorias]);



    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'precio' => ['required','numeric','min:0','regex:/^\d{1,10}(\.\d{1,2})?$/'],
            'descripcion' => 'nullable|string|max:255',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'stock' => 'required|integer|min:0',
            'imagenes.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'subcategoria_id' => 'required|integer|exists:subcategorias,id'


        ], [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.max' => 'El nombre del producto no debe exceder los 50 caracteres.',
            'precio.required' => 'El precio del producto es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.regex' => 'El precio debe tener hasta 10 dígitos enteros y 2 decimales.',
            'precio.min' => 'El precio no puede ser negativo.',
            'descripcion.string' => 'La descripción debe ser un texto.',
            'descripcion.max' => 'La descripción no debe exceder los 255 caracteres.',
            'categoria_id.required' => 'La categoría es obligatoria.',
            'stock.required' => 'La cantidad disponible es obligatoria.',
            'stock.integer' => 'La cantidad debe ser un número entero.',
            'stock.min' => 'La cantidad no puede ser negativa.',
            'imagenes.*.image' => 'Cada archivo debe ser una imagen.',
            'imagenes.*.mimes' => 'Las imágenes deben estar en formato JPG, JPEG, PNG o GIF.',
            'imagenes.*.max' => 'Cada imagen no debe superar los 2MB.',
            'subcategoria_id.required' => 'La subcategoría es obligatoria.',
            'subcategoria_id.exists' => 'La subcategoría seleccionada no es válida.',
            'subcategoria_id.integer' => 'La subcategoría debe ser un número entero.'


        ]);


        // Validar la cantidad de imágenes
        if ($request->hasFile('imagenes') && count($request->file('imagenes')) > 5) {
            return redirect()->back()->withErrors(['imagenes' => 'No se pueden subir más de 5 imágenes.'])->withInput();
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Crear o encontrar la categoría
        $categoria = Categoria::findOrFail($request->categoria_id);

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
        $producto->user_id = auth()->id(); // Asignar el ID del usuario autenticado
        $producto->imagen = $imagenesGuardadas[0] ?? null;
        $producto->imagen2 = $imagenesGuardadas[1] ?? null;
        $producto->imagen3 = $imagenesGuardadas[2] ?? null;
        $producto->imagen4 = $imagenesGuardadas[3] ?? null;
        $producto->imagen5 = $imagenesGuardadas[4] ?? null;
        $producto->subcategoria_id = $request->input('subcategoria_id');

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
        $producto = Producto::with(['subcategoria', 'categoria'])->findOrFail($id);
        $resenias = $producto->resenias()->with('user')->get();
        return view('productos.productos-detalles', compact('producto', 'resenias'));
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
            'nombre' => 'required|string|max:50',
            'precio' => ['required','numeric','min:0','regex:/^\d{1,10}(\.\d{1,2})?$/'],
            'descripcion' => 'nullable|string|max:255',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'stock' => 'required|integer|min:0',
            'imagenes.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'subcategoria_id' => 'required|integer|exists:subcategorias,id'
        ], [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.max' => 'El nombre del producto no debe exceder los 50 caracteres.',
            'precio.required' => 'El precio del producto es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.regex' => 'El precio debe tener hasta 10 dígitos enteros y 2 decimales.',
            'precio.min' => 'El precio no puede ser negativo.',
            'descripcion.string' => 'La descripción debe ser un texto.',
            'descripcion.max' => 'La descripción no debe exceder los 255 caracteres.',
            'categoria_id.required' => 'La categoría es obligatoria.',
            'stock.required' => 'La cantidad disponible es obligatoria.',
            'stock.integer' => 'La cantidad debe ser un número entero.',
            'stock.min' => 'La cantidad no puede ser negativa.',
            'imagenes.*.image' => 'Cada archivo debe ser una imagen.',
            'imagenes.*.mimes' => 'Las imágenes deben estar en formato JPG, JPEG, PNG o GIF.',
            'imagenes.*.max' => 'Cada imagen no debe superar los 2MB.',
            'subcategoria_id.required' => 'La subcategoría es obligatoria.',
            'subcategoria_id.exists' => 'La subcategoría seleccionada no es válida.',
            'subcategoria_id.integer' => 'La subcategoría debe ser un número entero.'


        ]);

        // Validar la cantidad de imágenes
        if ($request->hasFile('imagenes') && count($request->file('imagenes')) > 5) {
            return redirect()->back()->withErrors(['imagenes' => 'No se pueden subir más de 5 imágenes.'])->withInput();
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Crear o encontrar la categoría
        //$categoria = $request->categoria_id ? Categoria::findOrFail($request->categoria_id) : Categoria::firstOrCreate(['nombre' => $request->categoria]);
        $categoria = Categoria::findOrFail($request->categoria_id);

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
        $producto->subcategoria_id = $request->input('subcategoria_id');


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

    // Formulario de creación de producto en el panel
    public function panelcreate()
    {
        $categorias = Categoria::all();
        return view('panelAdministrativo.productosForm', compact('categorias'));
    }

    // Guardar nuevo producto desde el panel
    public function panelstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'nombre' => 'required|string|max:255',
        'precio' => ['required', 'numeric', 'regex:/^\d{1,10}(\.\d{1,2})?$/'],
        'descripcion' => 'nullable|string',
        'categoria_id' => 'required|integer|exists:categorias,id',
        'stock' => 'required|integer|min:0',
        'imagenes.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
    ]);

    if ($request->hasFile('imagenes') && count($request->file('imagenes')) > 5) {
        return redirect()->back()->withErrors(['imagenes' => 'No se pueden subir más de 5 imágenes.'])->withInput();
    }

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $categoria = Categoria::findOrFail($request->categoria_id);

    $imagenesGuardadas = [];
    if ($request->hasFile('imagenes')) {
        $imagenes = $request->file('imagenes');
        foreach ($imagenes as $imagen) {
            $rutaImagen = $imagen->store('public/productos');
            $imagenesGuardadas[] = $rutaImagen;
        }
    }

    $producto = new Producto();
    $producto->nombre = $request->input('nombre');
    $producto->precio = $request->input('precio');
    $producto->descripcion = $request->input('descripcion');
    $producto->categoria_id = $categoria->id;
    $producto->stock = $request->input('stock');
    $producto->user_id = auth()->id();
    $producto->imagen = $imagenesGuardadas[0] ?? null;
    $producto->imagen2 = $imagenesGuardadas[1] ?? null;
    $producto->imagen3 = $imagenesGuardadas[2] ?? null;
    $producto->imagen4 = $imagenesGuardadas[3] ?? null;
    $producto->imagen5 = $imagenesGuardadas[4] ?? null;

    if ($producto->save()) {
        return redirect()->route('productos.panel')->with('exito', 'Producto creado correctamente');
    } else {
        return redirect()->back()->with('fracaso', 'Error al crear producto');
    }

    }

    // Formulario de edición de producto en el panel
    public function paneledit($id)
    {
        $producto = Producto::with('categoria')->findOrFail($id);
        $categorias = Categoria::all();
        return view('panelAdministrativo.productosForm', compact('producto', 'categorias'));
    }

    // Actualizar producto desde el panel
    public function panelupdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
        'nombre' => 'required|string|max:255',
        'precio' => ['required', 'numeric', 'regex:/^\d{1,10}(\.\d{1,2})?$/'],
        'descripcion' => 'nullable|string',
        'categoria_id' => 'required|integer|exists:categorias,id',
        'stock' => 'required|integer|min:0',
        'imagenes.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
    ]);

    if ($request->hasFile('imagenes') && count($request->file('imagenes')) > 5) {
        return redirect()->back()->withErrors(['imagenes' => 'No se pueden subir más de 5 imágenes.'])->withInput();
    }

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $categoria = Categoria::findOrFail($request->categoria_id);

    $imagenesGuardadas = [];
    if ($request->hasFile('imagenes')) {
        $imagenes = $request->file('imagenes');
        foreach ($imagenes as $imagen) {
            $rutaImagen = $imagen->store('public/productos');
            $imagenesGuardadas[] = $rutaImagen;
        }
    }

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
        return redirect()->route('productos.panel')->with('exito', 'Producto actualizado correctamente');
    } else {
        return redirect()->back()->with('fracaso', 'Error al actualizar producto');
    }
    }

    // Eliminar producto desde el panel
    public function paneldestroy($id)
    {
        $eliminados = Producto::destroy($id);

        if ($eliminados > 0) {
            return redirect()->route('productos.panel')->with('exito', 'El producto se eliminó correctamente.');
        } else {
            return redirect()->route('productos.panel')->with('fracaso', 'El producto no se pudo borrar.');
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
    public function agregarResenia(Request $request, $producto_id)
    {
        $request->validate([
            'titulo' => 'required|string|min:5|max:255',
            'contenido' => 'required|string|min:5'|'max:255',
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.min' => 'El título debe tener al menos 5 caracteres.',
            'titulo.max' => 'El título no puede exceder los 50 caracteres.',
            'contenido.required' => 'El contenido de la reseña es obligatorio.',
            'contenido.min' => 'El contenido debe tener al menos 5 caracteres.',
            'contenido.max' => 'El contenido no puede exceder los 255 caracteres.'
        ]);

        $producto = Producto::findOrFail($producto_id);

        // Crear la reseña asociada al producto
        $producto->resenias()->create([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'user_id' => auth()->id(), // Asignar el ID del usuario autenticado
        ]);

        return redirect()->back()->with('success', 'Reseña agregada correctamente');
    }

    public function eliminarResenia($producto_id, $resenia_id)
    {
        $producto = Producto::findOrFail($producto_id);
        $resenia = $producto->resenias()->where('id', $resenia_id)->firstOrFail();
        // Verificar si el usuario autenticado es el autor de la reseña
        if ($resenia->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'No tienes permiso para eliminar esta reseña');
        }
        $resenia->delete();
        return redirect()->back()->with('success', 'Reseña eliminada correctamente');
    }

    public function editarResenia(Request $request, $producto_id, $resenia_id)
    {
        $request->validate([
            'titulo' => 'required|string|min:5|max:255',
            'contenido' => 'required|string|min:5|max:255',
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.min' => 'El título debe tener al menos 5 caracteres.',
            'titulo.max' => 'El título no puede exceder los 50 caracteres.',
            'contenido.required' => 'El contenido de la reseña es obligatorio.',
            'contenido.min' => 'El contenido debe tener al menos 5 caracteres.',
            'contenido.max' => 'El contenido no puede exceder los 255 caracteres.'
        ]);

        $producto = Producto::findOrFail($producto_id);
        $resenia = Resenia::where('producto_id', $producto_id)
            ->where('id', $resenia_id)
            ->firstOrFail();

        // Verificar si el usuario autenticado es el autor de la reseña
        if ($resenia->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'No tienes permiso para editar esta reseña');
        }

        // Actualizar la reseña
        $resenia->update([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido
        ]);

        // Obtener todas las reseñas del producto
        $resenias = $producto->resenias()->with('user')->get();

        return redirect()->route('productos.show', $producto_id)
            ->with('success', 'Reseña actualizada correctamente');
    }

    public function mostrarFormularioEdicion($producto_id, $resenia_id)
    {
        $producto = Producto::findOrFail($producto_id);
        $resenia = Resenia::findOrFail($resenia_id);
        $resenias = $producto->resenias()->with('user')->get();

        return view('productos.productos-detalles', [
            'producto' => $producto,
            'resenia' => $resenia,
            'resenias' => $resenias,
            'mostrarFormulario' => true
        ]);
    }

    public function toggleActivo(Producto $producto)
    {
        if (auth()->id() === $producto->user_id || auth()->user()->is_admin) {
            $producto->activo = !$producto->activo;
            $producto->save();

            return back()->with('success', 'Estado del producto actualizado correctamente.');
        }

        return back()->with('error', 'No tienes permiso para cambiar el estado de este producto.');
    }


}
