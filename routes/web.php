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

//Jonaaaaa
Route::get('index', function () {
    return view('MenuPrincipal.MenuPrincipal');
})->name('index');
Route::get('/adopciones', [AdopcionController::class, 'index'])->name('adopciones.index');
Route::get('/adopciones/create', [AdopcionController::class, 'create'])->name('adopciones.create');
Route::post('/adopciones', [AdopcionController::class, 'store'])->name('adopciones.store');
Route::delete('/adopciones/{id}', [AdopcionController::class, 'destroy'])->name('adopciones.destroy');

Route::resource('productos',ProductoController::class);

//Rutas para Publicaciones
Route::get('/publicaciones', [PublicacionController::class, 'index'])->name('publicaciones.index');

Route::get('/publicaciones/crear', [PublicacionController::class, 'create'])->name('publicaciones.create');
Route::post('/publicaciones/crear', [PublicacionController::class, 'store'])->name('publicaciones.store');

Route::get('/publicaciones/{id}/editar', [PublicacionController::class, 'edit'])->name('publicaciones.edit')->whereNumber('id');
Route::put('/publicaciones/{id}/editar', [PublicacionController::class, 'update'])->name('publicaciones.update')->whereNumber('id');

Route::get('/publicaciones/{id}/ver', [PublicacionController::class, 'show'])->name('publicaciones.show')->whereNumber('id');

Route::delete('/publicaciones/{id}/eliminar', [PublicacionController::class, 'destroy'])->name('publicaciones.destroy')->whereNumber('id');


//Rutas para Comentarios
Route::get('/comentarios', [ComentarioController::class, 'index'])->name('comentarios.index');

Route::get('/comentarios/crear', [ComentarioController::class, 'create'])->name('comentarios.create');
Route::post('/comentarios/crear', [ComentarioController::class, 'store'])->name('comentarios.store');

Route::get('/comentarios/{id}/editar', [ComentarioController::class, 'edit'])->name('comentarios.edit')->whereNumber('id');
Route::put('/comentarios/{id}/editar', [ComentarioController::class, 'update'])->name('comentarios.update')->whereNumber('id');

Route::get('/comentarios/{id}/ver', [ComentarioController::class, 'show'])->name('comentarios.show')->whereNumber('id');

Route::delete('/comentarios/{id}/eliminar', [ComentarioController::class, 'destroy'])->name('comentarios.destroy')->whereNumber('id');


//Rutas para Reacciones
Route::get('/reacciones', [ReaccionController::class, 'index'])->name('reacciones.index');

Route::get('/reacciones/crear', [ReaccionController::class, 'create'])->name('reacciones.create');
Route::post('/reacciones/crear', [ReaccionController::class, 'store'])->name('reacciones.store');

Route::get('/reacciones/{id}/editar', [ReaccionController::class, 'edit'])->name('reacciones.edit')->whereNumber('id');
Route::put('/reacciones/{id}/editar', [ReaccionController::class, 'update'])->name('reacciones.update')->whereNumber('id');

Route::get('/reacciones/{id}/ver', [ReaccionController::class, 'show'])->name('reacciones.show')->whereNumber('id');

Route::delete('/reacciones/{id}/eliminar', [ReaccionController::class, 'destroy'])->name('reacciones.destroy')->whereNumber('id');

