<?php

use App\Http\Controllers\AdopcionController;
use Illuminate\Support\Facades\Route;

//Jonaaaaa
Route::get('index', function () {
    return view('MenuPrincipal.MenuPrincipal');
})->name('index');
Route::get('/adopciones', [AdopcionController::class, 'index'])->name('adopciones.index');
Route::get('/adopciones/create', [AdopcionController::class, 'create'])->name('adopciones.create');
Route::post('/adopciones', [AdopcionController::class, 'store'])->name('adopciones.store');
Route::delete('/adopciones/{id}', [AdopcionController::class, 'destroy'])->name('adopciones.destroy');
