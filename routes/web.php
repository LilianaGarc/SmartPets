<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AdopcionController;
use App\Http\Controllers\VeterinariaController;
use Illuminate\Support\Facades\Route;

//Jonaaaaa
Route::get('index', function () {
    return view('MenuPrincipal.MenuPrincipal');
})->name('index');
Route::get('/adopciones', [AdopcionController::class, 'index'])->name('adopciones.index');
Route::get('/adopciones/create', [AdopcionController::class, 'create'])->name('adopciones.create');
Route::post('/adopciones', [AdopcionController::class, 'store'])->name('adopciones.store');
Route::delete('/adopciones/{id}', [AdopcionController::class, 'destroy'])->name('adopciones.destroy');

Route::resource('productos',ProductoController::class);

Route::get('/veterinarias', [VeterinariaController::class, 'index'])->name('veterinarias.index');

Route::get('/veterinarias/crear', [VeterinariaController::class, 'create'])->name('veterinarias.create');
Route::post('/veterinarias', [VeterinariaController::class, 'store'])->name('veterinarias.store');

Route::get('/veterinarias/{id}', [VeterinariaController::class, 'show'])->name('veterinarias.show')->whereNumber('id');
Route::get('/veterinarias/{id}/editar', [VeterinariaController::class, 'edit'])->name('veterinarias.edit')->whereNumber('id');

Route::put('/veterinarias/{id}', [VeterinariaController::class, 'update'])->name('veterinarias.update')->whereNumber('id');
Route::delete('/veterinarias/{id}/eliminar', [VeterinariaController::class, 'destroy'])->name('veterinarias.destroy')->whereNumber('id');