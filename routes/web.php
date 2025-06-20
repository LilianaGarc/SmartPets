<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdopcionController, CategoriaController, CalificacionController, ChatController, ChatbotController,
    ComentarioController, EventoController, JuegoController, MensajeController, PerfilController,
    ProductoController, PublicacionController, ReaccionController, SolicitudController, UserController, VeterinariaController,
    ImagenController,
    UbicacionController, ProfileController, NotificationController
};

// Rutas públicas generales
Route::get('/', fn() => redirect()->route('animacion'));
Route::get('/index', fn() => view('MenuPrincipal.MenuPrincipal'))->name('index');
Route::get('animacion', fn() => view('MenuPrincipal.Animacion'))->name('animacion');

// Rutas públicas de recursos principales
Route::get('eventos', [EventoController::class, 'index'])->name('eventos.index');
Route::get('/adopciones', [AdopcionController::class, 'index'])->name('adopciones.index');
Route::get('/solicitudes', [SolicitudController::class, 'index'])->name('solicitudes.index');
Route::get('/publicaciones', [PublicacionController::class, 'index'])->name('publicaciones.index');
Route::get('/reacciones', [ReaccionController::class, 'index'])->name('reacciones.index');
Route::get('/juego', [JuegoController::class, 'index'])->name('juego.index');

// Rutas para productos y categorías (públicas)
Route::resource('productos', ProductoController::class);
Route::get('/productos/buscar', [ProductoController::class, 'buscar'])->name('productos.buscar');
Route::resource('/categorias', CategoriaController::class);
Route::get('/productos/categoria/{categoria}', [ProductoController::class, 'index'])->name('productos.categoria');

// Reseñas de productos
Route::post('/productos/{producto}/resenias', [ProductoController::class, 'agregarResenia'])->name('productos.agregarResenia');
Route::delete('/productos/{producto}/resenias/{resenia}', [ProductoController::class, 'eliminarResenia'])->name('productos.eliminarResenia');
Route::put('/productos/{producto}/resenias/{resenia}', [ProductoController::class, 'editarResenia'])->name('productos.editarResenia');
Route::get('/productos/{producto}/resenias/{resenia}/editar', [ProductoController::class, 'mostrarFormularioEdicion'])->name('productos.mostrarFormularioEdicion');

// Rutas públicas de veterinarias
Route::get('/veterinarias', [VeterinariaController::class, 'index'])->name('veterinarias.index');
Route::get('/veterinarias/{id}', [VeterinariaController::class, 'show'])->name('veterinarias.show')->whereNumber('id');

// Rutas públicas de calificaciones
Route::post('/calificaciones', [CalificacionController::class, 'store'])->name('calificaciones.store');
Route::get('/calificaciones/{id}/edit', [CalificacionController::class, 'edit'])->name('calificaciones.edit');
Route::put('/calificaciones/{id}', [CalificacionController::class, 'update'])->name('calificaciones.update');
Route::delete('/calificaciones/{id}', [CalificacionController::class, 'destroy'])->name('calificaciones.destroy');

// Rutas públicas de publicaciones
Route::get('/publicaciones/crear', [PublicacionController::class, 'create'])->name('publicaciones.create');
Route::post('/publicaciones/crear', [PublicacionController::class, 'store'])->name('publicaciones.store');
Route::get('/publicaciones/{id}/editar', [PublicacionController::class, 'edit'])->name('publicaciones.edit')->whereNumber('id');
Route::put('/publicaciones/{id}/editar', [PublicacionController::class, 'update'])->name('publicaciones.update')->whereNumber('id');
Route::get('/publicaciones/{id}/ver', [PublicacionController::class, 'show'])->name('publicaciones.show')->whereNumber('id');
Route::delete('/publicaciones/{id}/eliminar', [PublicacionController::class, 'destroy'])->name('publicaciones.destroy')->whereNumber('id');

// Rutas públicas de reacciones
Route::post('/reacciones', [ReaccionController::class, 'store'])->name('reacciones.store');
Route::get('/reacciones/crear', [ReaccionController::class, 'create'])->name('reacciones.create');
Route::get('/reacciones/{id}/editar', [ReaccionController::class, 'edit'])->name('reacciones.edit')->whereNumber('id');
Route::put('/reacciones/{id}/editar', [ReaccionController::class, 'update'])->name('reacciones.update')->whereNumber('id');
Route::get('/reacciones/{id}/ver', [ReaccionController::class, 'show'])->name('reacciones.show')->whereNumber('id');
Route::delete('/reacciones/{publicacion}', [ReaccionController::class, 'destroy'])->name('reacciones.destroy')->whereNumber('publicacion');

// Rutas públicas de chatbot y mascota ideal
Route::middleware(['auth'])->group(function() {
    Route::get('/mascotaideal', [ChatbotController::class, 'index'])->name('chatbot.index');
    Route::post('/mascotaideal', [ChatbotController::class, 'store'])->name('chatbot.store');
    Route::get('/mascotaideal/atras', [ChatbotController::class, 'atras'])->name('chatbot.atras');
    Route::get('/mascotaideal/result', [ChatbotController::class, 'mostrarResultado'])->name('chatbot.result');
    Route::get('/mascotaideal/reiniciar', [ChatbotController::class, 'reiniciar'])->name('chatbot.reiniciar');
    Route::get('/chatbot/navegar/{question_id}', [ChatbotController::class, 'navegar'])->name('chatbot.navegar');
});

// Rutas autenticadas
Route::middleware('auth')->group(function () {
    // Perfil y usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
    Route::get('/perfil/{id}', [PerfilController::class, 'showPerfil'])->name('perfil.index');
    Route::post('/perfil/actualizar-foto', [PerfilController::class, 'actualizarFoto'])->name('perfil.actualizarFoto');

    // Adopciones
    Route::get('/adopciones/crear', [AdopcionController::class, 'create'])->name('adopciones.create');
    Route::post('/adopciones', [AdopcionController::class, 'store'])->name('adopciones.store');
    Route::delete('/adopciones/{id}', [AdopcionController::class, 'destroy'])->name('adopciones.destroy');
    Route::get('/adopciones/{id}/editar', [AdopcionController::class, 'edit'])->name('adopciones.edit');
    Route::put('/adopciones/{id}', [AdopcionController::class, 'update'])->name('adopciones.update');
    Route::get('/adopciones/{id}', [AdopcionController::class, 'show'])->name('adopciones.show');

    // Solicitudes
    Route::get('/solicitudes/crear/{id_adopcion}', [SolicitudController::class, 'create'])->name('solicitudes.create');
    Route::post('/solicitudes', [SolicitudController::class, 'store'])->name('solicitudes.store');
    Route::delete('/solicitudes/{id_adopcion}/{id}', [SolicitudController::class, 'destroy'])->name('solicitudes.destroy');
    Route::get('/solicitudes/{id_adopcion}', [SolicitudController::class, 'showSolicitudes'])->name('solicitudes.show');
    Route::get('/solicitudes/{id_adopcion}/editar/{id}', [SolicitudController::class, 'edit'])->name('solicitudes.edit');
    Route::put('/solicitudes/{id_adopcion}/{id}', [SolicitudController::class, 'update'])->name('solicitudes.update');
    Route::get('/solicitudes/{id_adopcion}/{id}/detalles', [SolicitudController::class, 'showDetails'])->name('solicitudes.showDetails');
    Route::post('/solicitudes/{adopcion}/{solicitud}/aceptar', [SolicitudController::class, 'aceptar'])->name('solicitudes.aceptar');
    Route::post('/adopciones/{id_adopcion}/solicitudes/{id_solicitud}/cancelar', [SolicitudController::class, 'cancelarAceptacion'])->name('solicitudes.cancelar');

    // Participar en eventos
    Route::post('eventos/{id}/participar', [EventoController::class, 'participar'])->name('eventos.participar');

    // Comentarios
    Route::post('/comentarios/{id}', [ComentarioController::class, 'store'])->name('comentarios.store');
    Route::get('/comentarios/{id}/editar', [ComentarioController::class, 'edit'])->name('comentarios.edit')->whereNumber('id');
    Route::put('/comentarios/{id}/editar', [ComentarioController::class, 'update'])->name('comentarios.update')->whereNumber('id');
    Route::delete('/comentarios/{id}/eliminar', [ComentarioController::class, 'destroy'])->name('comentarios.destroy')->whereNumber('id');

    // Chats y mensajes
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::get('/chats/{chat}', [ChatController::class, 'show'])->name('chats.show');
    Route::post('/chats/{chat}/messages', [MensajeController::class, 'store'])->name('messages.store');

    // Notificaciones
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

    // Veterinarias protegidas
    Route::get('/veterinarias/crear', [VeterinariaController::class, 'create'])->name('veterinarias.create');
    Route::post('/veterinarias', [VeterinariaController::class, 'store'])->name('veterinarias.store');
    Route::get('/veterinarias/{id}/editar', [VeterinariaController::class, 'edit'])->name('veterinarias.edit')->whereNumber('id');
    Route::put('/veterinarias/{id}', [VeterinariaController::class, 'update'])->name('veterinarias.update')->whereNumber('id');
    Route::delete('/veterinarias/{id}', [VeterinariaController::class, 'destroy'])->name('veterinarias.destroy')->whereNumber('id');

    // Otras rutas protegidas
    Route::post('/productos/{producto}/favoritos', [ProductoController::class, 'agregarFavorito'])->name('productos.agregarFavorito');
    Route::delete('/productos/{producto}/favoritos', [ProductoController::class, 'quitarFavorito'])->name('productos.quitarFavorito');

    Route::post('/productos/{producto}/comentarios', [ComentarioController::class, 'store'])->name('comentarios.storeProducto');
    Route::delete('/comentarios/{id}', [ComentarioController::class, 'destroy'])->name('comentarios.destroy');

});

require __DIR__.'/auth.php';
