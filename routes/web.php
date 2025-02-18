<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VeterinariaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/veterinarias', [VeterinariaController::class, 'index'])->name('veterinarias.index');

Route::get('/veterinarias/crear', [VeterinariaController::class, 'create'])->name('veterinarias.create');
Route::post('/veterinarias', [VeterinariaController::class, 'store'])->name('veterinarias.store');

Route::get('/veterinarias/{id}', [VeterinariaController::class, 'show'])->name('veterinarias.show')->whereNumber('id');
Route::get('/veterinarias/{id}/editar', [VeterinariaController::class, 'edit'])->name('veterinarias.edit')->whereNumber('id');

Route::put('/veterinarias/{id}', [VeterinariaController::class, 'update'])->name('veterinarias.update')->whereNumber('id');
Route::delete('/veterinarias/{id}/eliminar', [VeterinariaController::class, 'destroy'])->name('veterinarias.destroy')->whereNumber('id');