<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Publicacion;
use App\Models\Reaccion;
use App\Models\Historia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\StoryMedia;



class PublicacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    public function panel()
    {
        $publicaciones = Publicacion::with('user')->orderBy('created_at', 'desc')->get();
        return view('panelAdministrativo.publicacionesIndex')->with('publicaciones',$publicaciones);
    }

    public function panelcreate()
    {
        return view('panelAdministrativo.publicacionesForm');
    }

    public function detalles($id)
    {
        $publicacion = Publicacion::findorFail($id);
        $comentarios = Comentario::with('user')
            ->where('id_publicacion', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('publicaciones.verPublicacion', ['publicacion'=>$publicacion, 'comentarios'=>$comentarios]);
    }

    public function panelstore(Request $request)
    {
        $request->validate([
            'visibilidad' => 'required',
            'contenido' => 'required|string|max:255|regex:/[a-zA-Z0-9 ]+/',
            'imagen' => 'nullable|mimes:jpeg,png,jpg,gif,webp,JPEG,PHG,JPG,GIF,WEBP|max:2048',
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('publicaciones', 'public');
        }

        Publicacion::create([
            'id_user' => auth()->id(),
            'visibilidad' => $request->visibilidad,
            'contenido' => $request->contenido,
            'imagen' => $rutaImagen,
        ]);

        return redirect()->route('publicaciones.panel')->with('exito', 'Publicación creada con éxito.');
    }
    public function paneledit(string $id)
    {
        $publicacion = Publicacion::findOrfail($id);
        return view('panelAdministrativo.publicacionesForm')->with('publicacion', $publicacion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function panelupdate(Request $request, string $id)
    {
        $request->validate([
            'visibilidad' => 'required',
            'contenido' => 'required|string|max:255|regex:/[a-zA-Z0-9 ]+/',
            'imagen' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $publicacion = Publicacion::findOrFail($id);

        if (auth()->user()->usertype !== 'admin' && $publicacion->id_user !== auth()->id()) {
            abort(403, 'No tienes permiso para modificar esta publicación.');
        }

        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('publicaciones', 'public');
            $publicacion->imagen = $rutaImagen;
        }

        $publicacion->visibilidad = $request->visibilidad;
        $publicacion->contenido = $request->contenido;

        $publicacion->save();

        return redirect()->route('publicaciones.panel')->with('exito', 'Publicación modificada con éxito.');
    }


    public function search(Request $request)
    {
        $nombre = $request->get('nombre');

        $publicaciones = Publicacion::with('user')
            ->where(function ($query) use ($nombre) {
                $query->whereHas('user', function ($q) use ($nombre) {
                    $q->where('name', 'LIKE', "%$nombre%")
                        ->orWhere('email', 'LIKE', "%$nombre%");
                })
                    ->orWhere('contenido', 'LIKE', "%$nombre%")
                    ->orWhere('visibilidad', 'LIKE', "%$nombre%");
            })
            ->get();

        return view('panelAdministrativo.publicacionesIndex')->with('publicaciones', $publicaciones);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publicaciones = Publicacion::with('user')
            ->withCount('likes')
            ->with(['likes' => function ($query) {
                $query->where('user_id', Auth::id());
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        $publicaciones->each(function ($publicacion) {
            $publicacion->user_has_liked = $publicacion->likes->isNotEmpty();
            unset($publicacion->likes);
        });

        $groupedStories = $this->getGroupedStoriesData();

        return view('publicaciones.indexPublicaciones', [
            'publicaciones' => $publicaciones,
            'historiasGrouped' => $groupedStories
        ]);
    }

    public function getGroupedStories(Request $request)
    {
        $groupedStories = $this->getGroupedStoriesData();
        return response()->json($groupedStories);
    }

    private function getGroupedStoriesData()
    {
        $user = Auth::user();
        $now = Carbon::now();

        if (!$user) {
            $allStories = Historia::where('expires_at', '>', $now)
                ->with(['user:id,name,email', 'media'])
                ->orderBy('created_at', 'desc')
                ->limit(50)
                ->get();
        } else {
            $ownStories = Historia::where('user_id', $user->id)
                ->where('expires_at', '>', $now)
                ->with('media')
                ->orderBy('created_at', 'desc')
                ->get();

            $otherUsersStories = Historia::where('user_id', '!=', $user->id)
                ->where('expires_at', '>', $now)
                ->with(['user:id,name,email', 'media'])
                ->orderBy('created_at', 'desc')
                ->limit(50)
                ->get();
            $allStories = $ownStories->concat($otherUsersStories)->unique('id')->sortByDesc('created_at');
        }


        $groupedStories = $allStories->groupBy('user_id')->map(function ($items, $userId) use ($user) {
            $firstStory = $items->first();
            $userName = $firstStory->user->name ?? 'Usuario Desconocido';
            $userAvatar = $firstStory->user->profile_photo_path ?? null;

            return [
                'user_id' => $userId,
                'user_name' => $userName,
                'user_avatar' => $userAvatar,
                'stories_count' => $items->count(),
                'stories' => $items->values()->map(function($story) {
                    return [
                        'id' => $story->id,
                        'created_at' => $story->created_at->diffForHumans(),
                        'expires_at_timestamp' => $story->expires_at->timestamp,
                        'media' => $story->media->map(function($media) {
                            return [
                                'id' => $media->id,
                                'file_url' => Storage::url($media->file_path),
                                'file_type' => $media->file_type,
                                'caption' => $media->caption,
                                'order' => $media->order,
                            ];
                        })->sortBy('order')->values()->all(),
                    ];
                })->all(),
                'is_current_user' => ($user && $userId == $user->id),
            ];
        })->values()->all();

        if (empty($groupedStories)) {
            return [];
        }

        return $groupedStories;
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('publicaciones.crearPublicaciones');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'visibilidad' => 'required',
            'contenido' => 'required|string|max:255|regex:/[a-zA-Z0-9 ]+/',
            'imagen' => 'nullable|mimes:jpeg,png,jpg,gif,webp,JPEG,PHG,JPG,GIF,WEBP|max:2048',
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('publicaciones', 'public');
        }

        Publicacion::create([
            'id_user' => auth()->id(),
            'visibilidad' => $request->visibilidad,
            'contenido' => $request->contenido,
            'imagen' => $rutaImagen,

        ]);

        return redirect()->route('publicaciones.index')->with('success', 'Publicación de adopción creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $publicacion = Publicacion::with('user')
            ->withCount('likes')
            ->with(['likes' => function ($query) {
                $query->where('user_id', Auth::id());
            }])
            ->findOrFail($id);
        $comentarios = Comentario::with('user')
            ->where('id_publicacion', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('publicaciones.comentarios', ['publicacion'=>$publicacion, 'comentarios'=>$comentarios]);

    }

    public function paneldetalles(string $id)
    {
        $publicacion = Publicacion::findorFail($id);
        $comentarios = Comentario::with('user')
            ->where('id_publicacion', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        $comen = Comentario::where('id_publicacion', $id)->count();
        $reac = Reaccion::where('publicacion_id', $id)->count();
        return view('publicaciones.verPublicacion', ['publicacion'=>$publicacion, 'comentarios'=>$comentarios, 'comen'=>$comen, 'reac'=>$reac ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $publicacion = Publicacion::findOrfail($id);
        return view('publicaciones.crearPublicaciones')->with('publicacion', $publicacion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'visibilidad' => 'required',
            'contenido' => 'required|string|max:255|regex:/[a-zA-Z0-9 ]+/',
            'imagen' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $publicacion = Publicacion::findOrFail($id);

        if (auth()->user()->usertype !== 'admin' && $publicacion->id_user !== auth()->id()) {
            abort(403, 'No tienes permiso para modificar esta publicación.');
        }

        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('publicaciones', 'public');
            $publicacion->imagen = $rutaImagen;
        }

        $publicacion->visibilidad = $request->visibilidad;
        $publicacion->contenido = $request->contenido;

        $publicacion->save();

        return redirect()->route('publicaciones.index')->with('exito', 'Publicación modificada con éxito.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $eliminados = Publicacion::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('publicaciones.index')->with('fracaso', 'La publicacion no se pudo borrar.');
        }else {
            return redirect()->route('publicaciones.index')->with('exito', 'La publicacion se elimino correctamente.');
        }
    }

    public function paneldestroy(string $id)
    {
        $eliminados = Publicacion::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('publicaciones.panel')->with('fracaso', 'La publicacion no se pudo borrar.');
        }else {
            return redirect()->route('publicaciones.panel')->with('exito', 'La publicacion se elimino correctamente.');
        }
    }
}
