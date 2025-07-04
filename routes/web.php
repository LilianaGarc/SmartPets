<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdopcionController,
    CategoriaController,
    CalificacionController,
    ChatController,
    ChatbotController,
    ComentarioController,
    EventoController,
    JuegoController,
    MensajeController,
    NotificationController,
    PerfilController,
    ProdFavoritoController,
    ProductoController,
    PublicacionController,
    ReaccionController,
    SolicitudController,
    UserController,
    VeterinariaController,
    ImagenController,
    UbicacionController,
    ProfileController};

// Rutas públicas generales
Route::get('/', fn() => redirect()->route('animacion'));
Route::get('/index', fn() => view('MenuPrincipal.MenuPrincipal'))->name('index');
Route::get('animacion', fn() => view('MenuPrincipal.Animacion'))->name('animacion');

// Rutas públicas de recursos principales
Route::get('/eventos', [EventoController::class, 'index'])->name('eventos.index');
Route::get('/adopciones', [AdopcionController::class, 'index'])->name('adopciones.index');
Route::get('/solicitudes', [SolicitudController::class, 'index'])->name('solicitudes.index');
Route::get('/publicaciones', [PublicacionController::class, 'index'])->name('publicaciones.index');
Route::get('/reacciones', [ReaccionController::class, 'index'])->name('reacciones.index');
Route::get('/juego', [JuegoController::class, 'index'])->name('juego.index');
Route::get('/veterinarias', [VeterinariaController::class, 'index'])->name('veterinarias.index');


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

// Rutas para Productos Guardados
Route::middleware(['auth'])->group(function () {
    Route::post('/producto-guardado', [ProdFavoritoController::class, 'store'])->name('productos.guardar');
    Route::post('/producto-guardado/destroy/{id}', [ProdFavoritoController::class, 'destroy'])->name('productos.eliminarGuardado');
    Route::get('/mis-productos', function () {$productos = Auth::user()->productos()->get();return response()->json($productos);})->middleware('auth');
    Route::get('/productos-guardados', [ProdFavoritoController::class, 'index'])->name('productos.guardados');
});

// Rutas públicas de veterinarias
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

// Rutas publicas de eventos
Route::get('/eventos/{id}', [EventoController::class, 'show'])->name('eventos.show')->whereNumber('id');

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

    // Eventos
    Route::get('/eventos/crear', [EventoController::class, 'create'])->name('eventos.create');
    Route::post('/eventos',[EventoController::class, 'store'])->name('eventos.store');
    Route::get('/eventos/{id}/editar', [EventoController::class, 'edit'])->name('eventos.edit')->whereNumber('id');
    Route::put('/eventos/{id}/editar', [EventoController::class, 'update'])->name('eventos.update')->whereNumber('id');
    Route::get('/eventos/{id}/ver', [EventoController::class, 'show'])->name('eventos.show')->whereNumber('id');
    Route::delete('/eventos/{id}/eliminar', [EventoController::class, 'destroy'])->name('eventos.destroy')->whereNumber('id');

    Route::post('eventos/{id}/participar', [EventoController::class, 'participar'])->name('eventos.participar');
    Route::post('eventos/{id}/dejar-participar', [EventoController::class, 'dejarParticipar'])->name('eventos.dejarParticipar');

    // Comentarios
    Route::post('/comentarios/{id}', [ComentarioController::class, 'store'])->name('comentarios.store');
    Route::get('/comentarios/{id}/editar', [ComentarioController::class, 'edit'])->name('comentarios.edit')->whereNumber('id');
    Route::put('/comentarios/{id}/editar', [ComentarioController::class, 'update'])->name('comentarios.update')->whereNumber('id');
    Route::delete('/comentarios/{id}/eliminar', [ComentarioController::class, 'destroy'])->name('comentarios.destroy')->whereNumber('id');

    // Chats y mensajes
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::get('/chats/{chat}', [ChatController::class, 'show'])->name('chats.show');
    Route::post('/chats/{chat}/mensajes', [MensajeController::class, 'store'])->name('mensajes.store');
    Route::get('/chats/iniciar/{userId}', [ChatController::class, 'iniciarChat'])->name('chats.iniciar');
    Route::get('/chats/{chat}/mensajes/nuevos', [MensajeController::class, 'getNuevosMensajes'])->name('mensajes.nuevos');
    Route::get('/usuarios-con-mensajes', [ChatController::class, 'usuariosConMensajes'])->name('usuarios.con.mensajes');

    //Rutas para Notificaciones
    Route::post('/notificaciones/borrar-todas', [NotificationController::class, 'borrarTodas'])->name('notificaciones.borrarTodas');
    Route::post('/notificaciones/marcar-vista/{id}', [NotificationController::class, 'marcarComoVista'])->name('notificaciones.marcarVista');

    // Veterinarias
    Route::get('/veterinarias/crear', [VeterinariaController::class, 'create'])->name('veterinarias.create');

    Route::post('/veterinarias', [VeterinariaController::class, 'store'])->name('veterinarias.store');

    Route::get('/veterinarias/{id}/editar', [VeterinariaController::class, 'edit'])->name('veterinarias.edit')->whereNumber('id');
    Route::put('/veterinarias/{id}', [VeterinariaController::class, 'update'])->name('veterinarias.update')->whereNumber('id');
    Route::delete('/veterinarias/{id}/eliminar', [VeterinariaController::class, 'destroy'])->name('veterinarias.destroy')->whereNumber('id');
});

// Rutas administrativas (solo admin)
Route::middleware(['auth', 'admin'])->group(function () {
    // Panel de adopciones
    Route::get('/panel/adopciones', [AdopcionController::class, 'panel'])->name('adopciones.panel');
    Route::get('/panel/buscar/adopciones', [AdopcionController::class, 'search'])->name('adopciones.search');
    Route::get('/panel/adopciones/create', [AdopcionController::class, 'panelcreate'])->name('adopciones.panelcreate');
    Route::post('/panel/adopciones/crear', [AdopcionController::class, 'panelstore'])->name('adopciones.panelstore');
    Route::get('/panel/adopciones/{id}/editar', [AdopcionController::class, 'paneledit'])->name('adopciones.paneledit')->whereNumber('id');
    Route::put('/panel/adopciones/{id}/editar', [AdopcionController::class, 'panelupdate'])->name('adopciones.panelupdate')->whereNumber('id');
    Route::get('/panel/adopciones/{id}/show', [AdopcionController::class, 'panelshow'])->name('adopciones.panelshow')->whereNumber('id');
    Route::delete('/panel/adopciones/{id}', [AdopcionController::class, 'paneldestroy'])->name('adopciones.paneldestroy');

    // Panel de productos
    Route::get('/panel/productos', [ProductoController::class, 'panel'])->name('productos.panel');

    Route::get('/panel/productos/create', [ProductoController::class, 'panelcreate'])->name('productos.panelcreate');
    Route::post('/panel/productos/crear', [ProductoController::class, 'panelstore'])->name('productos.panelstore');

    Route::get('/panel/productos/{id}/editar', [ProductoController::class, 'paneledit'])->name('productos.paneledit')->whereNumber('id');
    Route::put('/panel/productos/{id}/editar', [ProductoController::class, 'panelupdate'])->name('productos.panelupdate')->whereNumber('id');

    Route::get('/panel/buscar/productos', [ProductoController::class, 'search'])->name('productos.search');

    Route::delete('/panel/productos/{id}', [ProductoController::class, 'paneldestroy'])->name('productos.paneldestroy');

    Route::get('/panel/productos/{id}/show', [ProductoController::class, 'panelshow'])->name('productos.panelshow')->whereNumber('id');

    // Panel de veterinarias
    Route::get('/panel/veterinarias', [VeterinariaController::class, 'panel'])->name('veterinarias.panel');

    Route::get('/panel/veterinarias/create', [VeterinariaController::class, 'panelcreate'])->name('veterinarias.panelcreate');
    Route::post('/panel/veterinarias/crear', [VeterinariaController::class, 'panelstore'])->name('veterinarias.panelstore');

    Route::get('/panel/veterinarias/{id}/editar', [VeterinariaController::class, 'paneledit'])->name('veterinarias.paneledit')->whereNumber('id');

    Route::put('/panel/veterinarias/{id}/editar', [VeterinariaController::class, 'panelupdate'])->name('veterinarias.panelupdate')->whereNumber('id');

    Route::get('/panel/veterinarias/{id}/show', [VeterinariaController::class, 'panelshow'])->name('veterinarias.panelshow')->whereNumber('id');

    Route::get('/panel/buscar/veterinarias', [VeterinariaController::class, 'search'])->name('veterinarias.search');

    Route::delete('/panel/veterinarias/{id}', [VeterinariaController::class, 'paneldestroy'])->name('veterinarias.paneldestroy');

    // Panel de publicaciones
    Route::get('/panel/publicaciones', [PublicacionController::class, 'panel'])->name('publicaciones.panel');
    Route::get('/panel/buscar/publicaciones', [PublicacionController::class, 'search'])->name('publicaciones.search');
    Route::get('/panel/publicaciones/create', [PublicacionController::class, 'panelcreate'])->name('publicaciones.panelcreate');
    Route::post('/panel/publicaciones/crear', [PublicacionController::class, 'panelstore'])->name('publicaciones.panelstore');
    Route::get('/panel/publicaciones/{id}/editar', [PublicacionController::class, 'paneledit'])->name('publicaciones.paneledit')->whereNumber('id');
    Route::put('/panel/publicaciones/{id}/editar', [PublicacionController::class, 'panelupdate'])->name('publicaciones.panelupdate')->whereNumber('id');
    Route::get('/publicaciones/{id}/verDetalles', [PublicacionController::class, 'detalles'])->name('publicaciones.detalles')->whereNumber('id');
    Route::delete('/panel/publicaciones/{id}', [PublicacionController::class, 'paneldestroy'])->name('publicaciones.paneldestroy');

    // Panel de comentarios
    Route::get('/panel/comentarios', [ComentarioController::class, 'panel'])->name('comentarios.panel');
    Route::get('/panel/buscar/comentarios', [ComentarioController::class, 'search'])->name('comentarios.search');
    Route::delete('/panel/comentarios/{id}', [ComentarioController::class, 'paneldestroy'])->name('comentarios.paneldestroy');

    // Panel de reacciones
    Route::get('/panel/reacciones', [ReaccionController::class, 'panel'])->name('reacciones.panel');
    Route::get('/panel/buscar/reacciones', [ReaccionController::class, 'search'])->name('reacciones.search');
    Route::delete('/panel/reacciones/{id}', [ReaccionController::class, 'paneldestroy'])->name('reacciones.paneldestroy');

    // Panel de eventos
    Route::get('/panel/eventos', [EventoController::class, 'panel'])->name('eventos.panel');
    Route::get('/panel/buscar/eventos', [EventoController::class, 'search'])->name('eventos.search');
    Route::delete('/panel/eventos/{id}', [EventoController::class, 'paneldestroy'])->name('eventos.paneldestroy');

    // Panel de mensajes
    Route::get('/panel/mensajes', [MensajeController::class, 'panel'])->name('mensajes.panel');
    Route::get('/panel/buscar/mensajes', [MensajeController::class, 'search'])->name('mensajes.search');
    Route::delete('/panel/mensajes/{id}', [MensajeController::class, 'paneldestroy'])->name('mensajes.paneldestroy');

    // Panel de chats
    Route::get('/panel/chats', [ChatController::class, 'panel'])->name('chats.panel');
    Route::get('/panel/buscar/chats', [ChatController::class, 'search'])->name('chats.search');
    Route::delete('/panel/chats/{id}', [ChatController::class, 'paneldestroy'])->name('chats.paneldestroy');

    // Panel de solicitudes
    Route::get('/panel/solicitudes', [SolicitudController::class, 'panel'])->name('solicitudes.panel');
    Route::get('/panel/buscar/solicitudes', [SolicitudController::class, 'search'])->name('solicitudes.search');
    Route::delete('/panel/solicitudes/{id}', [SolicitudController::class, 'paneldestroy'])->name('solicitudes.paneldestroy');

    // Panel de ubicaciones
    Route::get('/panel/ubicaciones', [UbicacionController::class, 'panel'])->name('ubicaciones.panel');
    Route::get('/panel/buscar/ubicaciones', [UbicacionController::class, 'search'])->name('ubicaciones.search');
    Route::delete('/panel/ubicaciones/{id}', [UbicacionController::class, 'paneldestroy'])->name('ubicaciones.paneldestroy');

    // Panel de usuarios
    Route::get('/panel/users', [UserController::class, 'panel'])->name('users.panel');
    Route::get('/panel/users/crear', [UserController::class, 'panelcreate'])->name('users.panelcreate');
    Route::post('/panel/users/crear', [UserController::class, 'store'])->name('users.store');
    Route::get('/panel/users/{id}/editar', [UserController::class, 'paneledit'])->name('users.paneledit')->whereNumber('id');
    Route::put('/panel/users/{id}/editar', [UserController::class, 'update'])->name('users.update')->whereNumber('id');
    Route::get('/panel/buscar/users', [UserController::class, 'search'])->name('users.search');
    Route::get('/panel/users/{id}/show', [UserController::class, 'show'])->name('users.show')->whereNumber('id');
    Route::delete('/panel/users/{id}', [UserController::class, 'paneldestroy'])->name('users.paneldestroy');
});

require __DIR__.'/auth.php';
