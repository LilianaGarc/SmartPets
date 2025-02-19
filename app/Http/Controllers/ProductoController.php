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
            //'activo' => 'required|boolean',
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
        //FUNCIÓN PARA CONVERTIR EL DATO A BOLEANO
        //$activo = filter_var($request->input('activo'),FILTER_VALIDATE_BOOLEAN);
        $producto = new Producto();

            $producto->nombre = $request->input('nombre');
            $producto->precio = $request->input('precio');
            $producto->descripcion = $request->input('descripcion');
            //$producto->categoria = $request->input('categoria');
            $producto -> categoria_id = 1;
            $producto->stock = $request->input('stock');
           // $producto->activo = $activo;
            $producto->imagen = $request->input('imagen');

            $producto->save();

            if ($producto->save()){
                //Redireccionar cuando se guardan los datos
                return redirect()->back()->with('success','Producto publicado correctamente');
            }else{
                return redirect()->with('error','Error al publicar producto');
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
