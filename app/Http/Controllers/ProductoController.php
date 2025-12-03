<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Resenia;
use App\Models\Subcategoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;

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
        $producto = Producto::with(['subcategoria', 'categoria'])->findOrFail($id);

        $categorias = Categoria::all();

        $subcategorias = collect();
        if ($producto->categoria_id) {
            $subcategorias = Subcategoria::where('categoria_id', $producto->categoria_id)->get();
        }
        $resenias = $producto->resenias()->with('user')->get();


        $imagenes = array_values(array_filter([
            $producto->imagen,
            $producto->imagen2,
            $producto->imagen3,
            $producto->imagen4,
            $producto->imagen5,
        ]));

        return view('panelAdministrativo.productosDetalles', compact('producto', 'resenias', 'categorias', 'subcategorias', 'imagenes'));
    }


    public function search(Request $request)
    {
        $nombre = $request->get('nombre');

        $productos = Producto::where(function($query) use ($nombre) {
            $query->where('nombre', 'LIKE', "%$nombre%")
                ->orWhere('descripcion', 'LIKE', "%$nombre%");

            if (is_numeric($nombre)) {
                $query->orWhere('precio', $nombre)
                    ->orWhere('stock', $nombre);
            }
        })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('panelAdministrativo.productosIndex', compact('productos'));
    }


    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = $request->input('search');
        $categoriaId = $request->input('categoria');
        $subcategoriaId = $request->input('subcategoria');

        if ($request->has('search') && empty($query)) {
            return redirect()->route('productos.index');
        }

        $productos = Producto::query()
            ->where('activo', true)
            ->where('user_id', '!=', auth()->id());

        if ($query) {
            $productos->where('nombre', 'LIKE', '%'.$query.'%');
        }
        if ($categoriaId){
            $productos->where('categoria_id', $categoriaId);
        }
        if ($subcategoriaId){
            $productos->where('subcategoria_id', $subcategoriaId);
        }

        $productos = $productos->paginate(10);

        $categorias = Categoria::limit(6)->get();

        $subcategorias = collect();
        if ($categoriaId) {
            $subcategorias = Subcategoria::where('categoria_id', $categoriaId)->get();
        }

        return view('productos.productos-lista', compact('productos', 'categorias', 'subcategorias', 'query', 'categoriaId', 'subcategoriaId'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }
        $categorias = Categoria::with('subcategorias')->get();
        return view('productos.productos-formulario', ['categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'precio' => [
                'required',
                'numeric',
                'gt:0',
                'max:99999.99',
                'regex:/^\d{1,5}(\.\d{1,2})?$/'
            ],
            'descripcion' => 'nullable|string|max:255',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'stock' => [
                'required',
                'integer',
                'min:1',
                'max:10000'
            ],
            'imagen_principal' => 'required|image|mimes:jpg,jpeg,png,gif,bmp,svg,webp,tiff|max:2048',
            'imagenes_adicionales' => 'nullable|array|max:4',
            'imagenes_adicionales.*' => 'image|mimes:jpg,jpeg,png,gif,bmp,svg,webp,tiff|max:2048',
            'subcategoria_id' => [
                'required',
                'integer',
                'exists:subcategorias,id',
                function ($attribute, $value, $fail) use ($request) {
                    $subcategoria = Subcategoria::where('id', $value)
                        ->where('categoria_id', $request->input('categoria_id'))
                        ->first();

                    if (!$subcategoria) {
                        $fail('La subcategoría seleccionada no pertenece a la categoría especificada.');
                    }
                },
            ],
        ], [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'precio.required' => 'El precio del producto es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.gt' => 'El precio debe ser mayor a 0.',
            'precio.max' => 'El precio no puede superar los 99999.99.',
            'precio.regex' => 'El formato del precio no es válido (ej: 99999.99).',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock debe ser al menos 1.',
            'stock.max' => 'El stock no puede superar las 10000 unidades.',
            'categoria_id.required' => 'La categoría es obligatoria.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
            'subcategoria_id.required' => 'La subcategoría es obligatoria.',
            'subcategoria_id.exists' => 'La subcategoría seleccionada no es válida.',
            'imagen_principal.required' => 'La imagen principal es obligatoria.',
            'imagen_principal.image' => 'El archivo principal debe ser una imagen.',
            'imagen_principal.mimes' => 'La imagen principal debe estar en formato jpg, jpeg, png, gif, bmp, svg, webp, tiff.',
            'imagen_principal.max' => 'La imagen principal no debe superar los 2MB.',
            'imagenes_adicionales.max' => 'No puedes subir más de 4 imágenes adicionales.',
            'imagenes_adicionales.*.image' => 'Cada archivo adicional debe ser una imagen.',
            'imagenes_adicionales.*.mimes' => 'Las imágenes adicionales deben estar en formato jpg, jpeg, png, gif, bmp, svg, webp, tiff.',
            'imagenes_adicionales.*.max' => 'Cada imagen adicional no debe superar los 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $rutaImagenPrincipal = $request->file('imagen_principal')->store('public/productos');

        $imagenesAdicionalesGuardadas = [];
        if ($request->hasFile('imagenes_adicionales')) {
            foreach ($request->file('imagenes_adicionales') as $imagenAdicional) {
                $rutaAdicional = $imagenAdicional->store('public/productos');
                $imagenesAdicionalesGuardadas[] = $rutaAdicional;
            }
        }

        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->descripcion = $request->input('descripcion');
        $producto->categoria_id = $request->input('categoria_id');
        $producto->stock = $request->input('stock');
        $producto->user_id = auth()->id();
        $producto->subcategoria_id = $request->input('subcategoria_id');

        $producto->imagen = $rutaImagenPrincipal;
        $producto->imagen2 = $imagenesAdicionalesGuardadas[0] ?? null;
        $producto->imagen3 = $imagenesAdicionalesGuardadas[1] ?? null;
        $producto->imagen4 = $imagenesAdicionalesGuardadas[2] ?? null;
        $producto->imagen5 = $imagenesAdicionalesGuardadas[3] ?? null;
        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto publicado correctamente.');
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
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('productos.productos-formulario',['producto' => $producto, 'categorias' => $categorias]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $producto = Producto::findOrFail($id);

        $rules = [
            'nombre' => 'required|string|max:50',
            'precio' => [
                'required',
                'numeric',
                'gt:0',
                'max:99999.99',
                'regex:/^\d{1,5}(\.\d{1,2})?$/'
            ],
            'descripcion' => 'nullable|string|max:255',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'stock' => [
                'required',
                'integer',
                'min:1',
                'max:10000'
            ],
            'imagenes_adicionales' => 'nullable|array|max:4',
            'imagenes_adicionales.*' => 'image|mimes:jpg,jpeg,png,gif,bmp,svg,webp,tiff|max:2048',
            'subcategoria_id' => [
                'required',
                'integer',
                'exists:subcategorias,id',
                function ($attribute, $value, $fail) use ($request) {
                    $subcategoria = Subcategoria::where('id', $value)
                        ->where('categoria_id', $request->input('categoria_id'))
                        ->first();

                    if (!$subcategoria) {
                        $fail('La subcategoría seleccionada no pertenece a la categoría especificada.');
                    }
                },
            ],
        ];

        if (!$producto->imagen || $request->hasFile('imagen_principal')) {
            $rules['imagen_principal'] = 'required|image|mimes:jpg,jpeg,png,gif,bmp,svg,webp,tiff|max:2048';
        }

        $validator = Validator::make($request->all(), $rules, [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'precio.required' => 'El precio del producto es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.gt' => 'El precio debe ser mayor a 0.',
            'precio.max' => 'El precio no puede superar los 99999.99.',
            'precio.regex' => 'El formato del precio no es válido (ej: 99999.99).',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock debe ser al menos 1.',
            'stock.max' => 'El stock no puede superar las 10000 unidades.',
            'categoria_id.required' => 'La categoría es obligatoria.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
            'subcategoria_id.required' => 'La subcategoría es obligatoria.',
            'subcategoria_id.exists' => 'La subcategoría seleccionada no es válida.',
            'imagen_principal.required' => 'La imagen principal es obligatoria.',
            'imagen_principal.image' => 'El archivo principal debe ser una imagen.',
            'imagen_principal.mimes' => 'La imagen principal debe estar en formato jpg, jpeg, png, gif, bmp, svg, webp, tiff.',
            'imagen_principal.max' => 'La imagen principal no debe superar los 2MB.',
            'imagenes_adicionales.max' => 'No puedes subir más de 4 imágenes adicionales.',
            'imagenes_adicionales.*.image' => 'Cada archivo adicional debe ser una imagen.',
            'imagenes_adicionales.*.mimes' => 'Las imágenes adicionales deben estar en formato jpg, jpeg, png, gif, bmp, svg, webp, tiff.',
            'imagenes_adicionales.*.max' => 'Cada imagen adicional no debe superar los 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imagenesParaEliminar = explode(',', $request->input('imagenes_eliminadas'));
        foreach ($imagenesParaEliminar as $path) {
            if ($path && Storage::exists($path)) {
                Storage::delete($path);
                if ($producto->imagen === $path) $producto->imagen = null;
                if ($producto->imagen2 === $path) $producto->imagen2 = null;
                if ($producto->imagen3 === $path) $producto->imagen3 = null;
                if ($producto->imagen4 === $path) $producto->imagen4 = null;
                if ($producto->imagen5 === $path) $producto->imagen5 = null;
            }
        }

        if ($request->hasFile('imagen_principal')) {
            if ($producto->imagen && Storage::exists($producto->imagen)) {
                Storage::delete($producto->imagen);
            }
            $producto->imagen = $request->file('imagen_principal')->store('public/productos');
        }

        if ($request->hasFile('imagenes_adicionales')) {
            $imagenesAdicionalesGuardadas = [];
            foreach ($request->file('imagenes_adicionales') as $imagenAdicional) {
                $imagenesAdicionalesGuardadas[] = $imagenAdicional->store('public/productos');
            }

            $adicionalesActualizadas = [];
            if ($producto->imagen2 && !in_array($producto->imagen2, $imagenesParaEliminar)) $adicionalesActualizadas[] = $producto->imagen2;
            if ($producto->imagen3 && !in_array($producto->imagen3, $imagenesParaEliminar)) $adicionalesActualizadas[] = $producto->imagen3;
            if ($producto->imagen4 && !in_array($producto->imagen4, $imagenesParaEliminar)) $adicionalesActualizadas[] = $producto->imagen4;
            if ($producto->imagen5 && !in_array($producto->imagen5, $imagenesParaEliminar)) $adicionalesActualizadas[] = $producto->imagen5;

            foreach ($imagenesAdicionalesGuardadas as $nuevaImagen) {
                if (count($adicionalesActualizadas) < 4) {
                    $adicionalesActualizadas[] = $nuevaImagen;
                }
            }

            $producto->imagen2 = $adicionalesActualizadas[0] ?? null;
            $producto->imagen3 = $adicionalesActualizadas[1] ?? null;
            $producto->imagen4 = $adicionalesActualizadas[2] ?? null;
            $producto->imagen5 = $adicionalesActualizadas[3] ?? null;
        }

        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->descripcion = $request->input('descripcion');
        $producto->categoria_id = $request->input('categoria_id');
        $producto->stock = $request->input('stock');
        $producto->subcategoria_id = $request->input('subcategoria_id');

        if ($producto->save()) {
            return redirect()->route('productos.panel')->with('exito', 'Producto actualizado correctamente');
        } else {
            return redirect()->back()->with('fracaso', 'Error al actualizar producto');
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
            'precio' => [
                'required',
                'numeric',
                'gt:0',
                'max:99999.99',
                'regex:/^\d{1,10}(\.\d{1,2})?$/'
            ],
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'stock' => 'required|integer|min:0',
            'imagen_principal' => 'required|image|mimes:jpg,jpeg,png,gif,bmp,svg,webp,tiff|max:2048',
            'imagenes_adicionales' => 'nullable|array|max:4',
            'imagenes_adicionales.*' => 'image|mimes:jpg,jpeg,png,gif,bmp,svg,webp,tiff|max:2048'
        ], [
            'precio.required' => 'El precio del producto es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.gt' => 'El precio debe ser mayor que 0.',
            'precio.max' => 'El precio no puede superar 99999.99.',
            'imagen_principal.required' => 'Debes subir la imagen principal.',
            'imagen_principal.image' => 'La imagen principal debe ser una imagen válida.',
            'imagen_principal.max' => 'La imagen principal no debe superar los 2MB.',
            'imagenes_adicionales.max' => 'No puedes subir más de 4 imágenes adicionales.',
            'imagenes_adicionales.*.image' => 'Cada archivo adicional debe ser una imagen.',
            'imagenes_adicionales.*.max' => 'Cada imagen adicional no debe superar los 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $categoria = Categoria::findOrFail($request->categoria_id);

        // Guardar imagen principal
        $rutaImagenPrincipal = null;
        if ($request->hasFile('imagen_principal')) {
            $rutaImagenPrincipal = $request->file('imagen_principal')->store('public/productos');
        }

        // Guardar adicionales (si los hay)
        $imagenesAdicionalesGuardadas = [];
        if ($request->hasFile('imagenes_adicionales')) {
            foreach ($request->file('imagenes_adicionales') as $imagenAdicional) {
                $rutaAdicional = $imagenAdicional->store('public/productos');
                $imagenesAdicionalesGuardadas[] = $rutaAdicional;
            }
        }

        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->descripcion = $request->input('descripcion');
        $producto->categoria_id = $categoria->id;
        $producto->stock = $request->input('stock');
        $producto->user_id = auth()->id();
        $producto->subcategoria_id = $request->input('subcategoria_id');

        $producto->imagen = $rutaImagenPrincipal;
        $producto->imagen2 = $imagenesAdicionalesGuardadas[0] ?? null;
        $producto->imagen3 = $imagenesAdicionalesGuardadas[1] ?? null;
        $producto->imagen4 = $imagenesAdicionalesGuardadas[2] ?? null;
        $producto->imagen5 = $imagenesAdicionalesGuardadas[3] ?? null;

        if ($producto->save()) {
            return redirect()->route('productos.panel')->with('exito', 'Producto creado correctamente');
        } else {
            return redirect()->back()->with('fracaso', 'Error al crear producto');
        }

    }

    // Formulario de edición de producto en el panel
    public function paneledit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('panelAdministrativo.productosForm',['producto' => $producto, 'categorias' => $categorias]);
    }

    // Actualizar producto desde el panel
    public function panelupdate(Request $request, $id)
    {
         $producto = Producto::findOrFail($id);

        $rules = [
            'nombre' => 'required|string|max:50',
            'precio' => [
                'required',
                'numeric',
                'gt:0',
                'max:99999.99',
                'regex:/^\d{1,5}(\.\d{1,2})?$/'
            ],
            'descripcion' => 'nullable|string|max:255',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'stock' => [
                'required',
                'integer',
                'min:1',
                'max:10000'
            ],
            'imagenes_adicionales' => 'nullable|array|max:4',
            'imagenes_adicionales.*' => 'image|mimes:jpg,jpeg,png,gif,bmp,svg,webp,tiff|max:2048',
            'subcategoria_id' => [
                'required',
                'integer',
                'exists:subcategorias,id',
                function ($attribute, $value, $fail) use ($request) {
                    $subcategoria = Subcategoria::where('id', $value)
                        ->where('categoria_id', $request->input('categoria_id'))
                        ->first();

                    if (!$subcategoria) {
                        $fail('La subcategoría seleccionada no pertenece a la categoría especificada.');
                    }
                },
            ],
        ];

        if (!$producto->imagen || $request->hasFile('imagen_principal')) {
            $rules['imagen_principal'] = 'required|image|mimes:jpg,jpeg,png,gif,bmp,svg,webp,tiff|max:2048';
        }

        $validator = Validator::make($request->all(), $rules, [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'precio.required' => 'El precio del producto es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.gt' => 'El precio debe ser mayor a 0.',
            'precio.max' => 'El precio no puede superar los 99999.99.',
            'precio.regex' => 'El formato del precio no es válido (ej: 99999.99).',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock debe ser al menos 1.',
            'stock.max' => 'El stock no puede superar las 10000 unidades.',
            'categoria_id.required' => 'La categoría es obligatoria.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
            'subcategoria_id.required' => 'La subcategoría es obligatoria.',
            'subcategoria_id.exists' => 'La subcategoría seleccionada no es válida.',
            'imagen_principal.required' => 'La imagen principal es obligatoria.',
            'imagen_principal.image' => 'El archivo principal debe ser una imagen.',
            'imagen_principal.mimes' => 'La imagen principal debe estar en formato jpg, jpeg, png, gif, bmp, svg, webp, tiff.',
            'imagen_principal.max' => 'La imagen principal no debe superar los 2MB.',
            'imagenes_adicionales.max' => 'No puedes subir más de 4 imágenes adicionales.',
            'imagenes_adicionales.*.image' => 'Cada archivo adicional debe ser una imagen.',
            'imagenes_adicionales.*.mimes' => 'Las imágenes adicionales deben estar en formato jpg, jpeg, png, gif, bmp, svg, webp, tiff.',
            'imagenes_adicionales.*.max' => 'Cada imagen adicional no debe superar los 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imagenesParaEliminar = explode(',', $request->input('imagenes_eliminadas'));
        foreach ($imagenesParaEliminar as $path) {
            if ($path && Storage::exists($path)) {
                Storage::delete($path);
                if ($producto->imagen === $path) $producto->imagen = null;
                if ($producto->imagen2 === $path) $producto->imagen2 = null;
                if ($producto->imagen3 === $path) $producto->imagen3 = null;
                if ($producto->imagen4 === $path) $producto->imagen4 = null;
                if ($producto->imagen5 === $path) $producto->imagen5 = null;
            }
        }

        if ($request->hasFile('imagen_principal')) {
            if ($producto->imagen && Storage::exists($producto->imagen)) {
                Storage::delete($producto->imagen);
            }
            $producto->imagen = $request->file('imagen_principal')->store('public/productos');
        }

        if ($request->hasFile('imagenes_adicionales')) {
            $imagenesAdicionalesGuardadas = [];
            foreach ($request->file('imagenes_adicionales') as $imagenAdicional) {
                $imagenesAdicionalesGuardadas[] = $imagenAdicional->store('public/productos');
            }

            $adicionalesActualizadas = [];
            if ($producto->imagen2 && !in_array($producto->imagen2, $imagenesParaEliminar)) $adicionalesActualizadas[] = $producto->imagen2;
            if ($producto->imagen3 && !in_array($producto->imagen3, $imagenesParaEliminar)) $adicionalesActualizadas[] = $producto->imagen3;
            if ($producto->imagen4 && !in_array($producto->imagen4, $imagenesParaEliminar)) $adicionalesActualizadas[] = $producto->imagen4;
            if ($producto->imagen5 && !in_array($producto->imagen5, $imagenesParaEliminar)) $adicionalesActualizadas[] = $producto->imagen5;

            foreach ($imagenesAdicionalesGuardadas as $nuevaImagen) {
                if (count($adicionalesActualizadas) < 4) {
                    $adicionalesActualizadas[] = $nuevaImagen;
                }
            }

            $producto->imagen2 = $adicionalesActualizadas[0] ?? null;
            $producto->imagen3 = $adicionalesActualizadas[1] ?? null;
            $producto->imagen4 = $adicionalesActualizadas[2] ?? null;
            $producto->imagen5 = $adicionalesActualizadas[3] ?? null;
        }

        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->descripcion = $request->input('descripcion');
        $producto->categoria_id = $request->input('categoria_id');
        $producto->stock = $request->input('stock');
        $producto->subcategoria_id = $request->input('subcategoria_id');

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
