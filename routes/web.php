<?php

use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ReaccionController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VeterinariaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AdopcionController;
use Illuminate\Support\Facades\Route;
//Faltan rutas de categoria y ubicacion
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UbicacionController;

//Jonaaaaa
Route::get('/', function () {
    return redirect()->route('animacion');
});

Route::get('/index', function () {
    return view('MenuPrincipal.MenuPrincipal');
})->name('index');

Route::get('/panel/adopciones', [AdopcionController::class, 'panel'])->name('adopciones.panel');
Route::get('/panel/buscar/adopciones', [AdopcionController::class, 'search'])->name('adopciones.search');
Route::get('animacion', function () {
    return view('MenuPrincipal.Animacion');
})->name('animacion');

Route::get('/adopciones', [AdopcionController::class, 'index'])->name('adopciones.index');
Route::get('/adopciones/crear', [AdopcionController::class, 'create'])->name('adopciones.create');
Route::post('/adopciones', [AdopcionController::class, 'store'])->name('adopciones.store');
Route::delete('/adopciones/{id}', [AdopcionController::class, 'destroy'])->name('adopciones.destroy');
Route::get('/adopciones/{id}/editar', [AdopcionController::class, 'edit'])->name('adopciones.edit');
Route::put('/adopciones/{id}', [AdopcionController::class, 'update'])->name('adopciones.update');
Route::get('/adopciones/{id}', [AdopcionController::class, 'show'])->name('adopciones.show');

Route::delete('/panel/adopciones/{id}', [AdopcionController::class, 'paneldestroy'])->name('adopciones.paneldestroy');

//Rutas para Solicitudes
Route::get('/solicitudes', [SolicitudController::class, 'index'])->name('solicitudes.index');
Route::get('/solicitudes/crear/{id_adopcion}', [SolicitudController::class, 'create'])->name('solicitudes.create');
Route::post('/solicitudes', [SolicitudController::class, 'store'])->name('solicitudes.store');
Route::delete('/solicitudes/{id_adopcion}/{id}', [SolicitudController::class, 'destroy'])->name('solicitudes.destroy');
Route::get('/solicitudes/{id_adopcion}', [SolicitudController::class, 'showSolicitudes'])->name('solicitudes.show');
Route::get('/solicitudes/{id_adopcion}/editar/{id}', [SolicitudController::class, 'edit'])->name('solicitudes.edit');
Route::put('/solicitudes/{id_adopcion}/{id}', [SolicitudController::class, 'update'])->name('solicitudes.update');
Route::get('/solicitudes/{id_adopcion}/{id}/detalles', [SolicitudController::class, 'showDetails'])->name('solicitudes.showDetails');

//Rutas para Productos
Route::get('/panel/productos', [ProductoController::class, 'panel'])->name('productos.panel');

Route::get('/panel/buscar/productos', [ProductoController::class, 'search'])->name('productos.search');

//MARGOTH
//Productos
Route::resource('productos',ProductoController::class);
Route::get('/productos/buscar', [ProductoController::class, 'buscar'])->name('productos.buscar');
//Categorias
Route::resource('/categorias',CategoriaController::class);
//Reseñas
Route::post('/productos/{producto}/resenias', [ProductoController::class, 'agregarResenia'])->name('productos.agregarResenia');


Route::delete('/panel/productos/{id}', [ProductoController::class, 'paneldestroy'])->name('productos.paneldestroy');

//Rutas para Veterinarias
Route::get('/panel/veterinarias', [VeterinariaController::class, 'panel'])->name('veterinarias.panel');
Route::get('/panel/buscar/veterinarias', [VeterinariaController::class, 'search'])->name('veterinarias.search');
Route::get('/veterinarias', [VeterinariaController::class, 'index'])->name('veterinarias.index');
Route::post('/calificaciones', [VeterinariaController::class, 'storeCalificacion'])->name('calificaciones.store');

Route::get('/veterinarias/crear', [VeterinariaController::class, 'create'])->name('veterinarias.create');
Route::post('/veterinarias', [VeterinariaController::class, 'store'])->name('veterinarias.store');

Route::get('/veterinarias/{id}', [VeterinariaController::class, 'show'])->name('veterinarias.show')->whereNumber('id');
Route::get('/veterinarias/{id}/editar', [VeterinariaController::class, 'edit'])->name('veterinarias.edit')->whereNumber('id');

Route::put('/veterinarias/{id}', [VeterinariaController::class, 'update'])->name('veterinarias.update')->whereNumber('id');
Route::delete('/veterinarias/{id}/eliminar', [VeterinariaController::class, 'destroy'])->name('veterinarias.destroy')->whereNumber('id');

Route::delete('/panel/veterinarias/{id}', [VeterinariaController::class, 'paneldestroy'])->name('veterinarias.paneldestroy');

//Rutas para Publicaciones
Route::get('/panel/publicaciones', [PublicacionController::class, 'panel'])->name('publicaciones.panel');
Route::get('/panel/buscar/publicaciones', [PublicacionController::class, 'search'])->name('publicaciones.search');
Route::get('/publicaciones', [PublicacionController::class, 'index'])->name('publicaciones.index');

Route::get('/publicaciones/crear', [PublicacionController::class, 'create'])->name('publicaciones.create');
Route::post('/publicaciones/crear', [PublicacionController::class, 'store'])->name('publicaciones.store');

Route::get('/publicaciones/{id}/editar', [PublicacionController::class, 'edit'])->name('publicaciones.edit')->whereNumber('id');
Route::put('/publicaciones/{id}/editar', [PublicacionController::class, 'update'])->name('publicaciones.update')->whereNumber('id');

Route::get('/publicaciones/{id}/ver', [PublicacionController::class, 'show'])->name('publicaciones.show')->whereNumber('id');
Route::get('/publicaciones/{id}/verDetalles', [PublicacionController::class, 'detalles'])->name('publicaciones.detalles')->whereNumber('id');

Route::delete('/publicaciones/{id}/eliminar', [PublicacionController::class, 'destroy'])->name('publicaciones.destroy')->whereNumber('id');

Route::delete('/panel/publicaciones/{id}', [PublicacionController::class, 'paneldestroy'])->name('publicaciones.paneldestroy');

//Rutas para Comentarios
Route::get('/panel/comentarios', [ComentarioController::class, 'panel'])->name('comentarios.panel');
Route::get('/panel/buscar/comentarios', [ComentarioController::class, 'search'])->name('comentarios.search');

Route::post('/comentarios/{id}', [ComentarioController::class, 'store'])->name('comentarios.store');

Route::get('/comentarios/{id}/editar', [ComentarioController::class, 'edit'])->name('comentarios.edit')->whereNumber('id');
Route::put('/comentarios/{id}/editar', [ComentarioController::class, 'update'])->name('comentarios.update')->whereNumber('id');

Route::delete('/comentarios/{id}/eliminar', [ComentarioController::class, 'destroy'])->name('comentarios.destroy')->whereNumber('id');

Route::delete('/panel/comentarios/{id}', [ComentarioController::class, 'paneldestroy'])->name('comentarios.paneldestroy');

//Rutas para Reacciones
Route::get('/panel/reacciones', [ReaccionController::class, 'panel'])->name('reacciones.panel');
Route::get('/panel/buscar/reacciones', [ReaccionController::class, 'search'])->name('reacciones.search');
Route::get('/reacciones', [ReaccionController::class, 'index'])->name('reacciones.index');

Route::get('/reacciones/crear', [ReaccionController::class, 'create'])->name('reacciones.create');
Route::post('/reacciones/crear', [ReaccionController::class, 'store'])->name('reacciones.store');

Route::get('/reacciones/{id}/editar', [ReaccionController::class, 'edit'])->name('reacciones.edit')->whereNumber('id');
Route::put('/reacciones/{id}/editar', [ReaccionController::class, 'update'])->name('reacciones.update')->whereNumber('id');

Route::get('/reacciones/{id}/ver', [ReaccionController::class, 'show'])->name('reacciones.show')->whereNumber('id');

Route::delete('/reacciones/{id}/eliminar', [ReaccionController::class, 'destroy'])->name('reacciones.destroy')->whereNumber('id');

Route::delete('/panel/reacciones/{id}', [ReaccionController::class, 'paneldestroy'])->name('reacciones.paneldestroy');


//Rutas para Eventos

Route::get('eventos', [EventoController::class, 'index'])->name('eventos.index');

Route::get('eventos/create', [EventoController::class, 'create'])->name('eventos.create');

Route::post('eventos', [EventoController::class, 'store'])->name('eventos.store');

Route::get('eventos/{id}', [EventoController::class, 'show'])->name('eventos.show');

Route::get('eventos/{id}/edit', [EventoController::class, 'edit'])->name('eventos.edit');

Route::put('eventos/{id}', [EventoController::class, 'update'])->name('eventos.update');

Route::delete('eventos/{id}', [EventoController::class, 'destroy'])->name('eventos.destroy');

Route::get('eventos/{id}/participar', [EventoController::class, 'participar'])->name('eventos.participar');

Route::get('/panel/eventos', [EventoController::class, 'panel'])->name('eventos.panel');
Route::get('/panel/buscar/eventos', [EventoController::class, 'search'])->name('eventos.search');
Route::delete('/panel/eventos/{id}', [EventoController::class, 'paneldestroy'])->name('eventos.paneldestroy');


//Rutas para Mensajes
Route::get('/panel/mensajes', [MensajeController::class, 'panel'])->name('mensajes.panel');
Route::get('/panel/buscar/mensajes', [MensajeController::class, 'search'])->name('mensajes.search');
Route::delete('/panel/mensajes/{id}', [MensajeController::class, 'paneldestroy'])->name('mensajes.paneldestroy');


//Rutas para Chats
Route::get('/panel/chats', [ChatController::class, 'panel'])->name('chats.panel');
Route::get('/panel/buscar/chats', [ChatController::class, 'search'])->name('chats.search');
Route::delete('/panel/chats/{id}', [ChatController::class, 'paneldestroy'])->name('chats.paneldestroy');


//Rutas para Solicitud
Route::get('/panel/solicitudes', [SolicitudController::class, 'panel'])->name('solicitudes.panel');
Route::get('/panel/buscar/solicitudes', [SolicitudController::class, 'search'])->name('solicitudes.search');
Route::delete('/panel/solicitudes/{id}', [SolicitudController::class, 'paneldestroy'])->name('solicitudes.paneldestroy');


//Rutas para Ubicaciones
Route::get('/panel/ubicaciones', [UbicacionController::class, 'panel'])->name('ubicaciones.panel');
Route::get('/panel/buscar/ubicaciones', [UbicacionController::class, 'search'])->name('ubicaciones.search');
Route::delete('/panel/ubicaciones/{id}', [UbicacionController::class, 'paneldestroy'])->name('ubicaciones.paneldestroy');


//Rutas para Users
Route::get('/panel/users', [UserController::class, 'panel'])->name('users.panel');
Route::get('/panel/buscar/users', [UserController::class, 'search'])->name('users.search');
Route::delete('/panel/users/{id}', [UserController::class, 'paneldestroy'])->name('users.paneldestroy');
