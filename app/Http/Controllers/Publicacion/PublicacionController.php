<?php

namespace App\Http\Controllers\Publicacion;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidacionesPublicacion;
use App\Models\Publicacion\Publicacion;
use App\Models\Publicacion\TipoSemilla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Parametro;
use App\Models\Publicacion\PublicacionFoto;
use App\Models\Publicacion\PublicacionResena;
use DateTime;
use Illuminate\Support\Facades\Storage;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publicaciones = Publicacion::where('usuario_id', Auth::user()->usuario_id)->where('activa', true)->paginate(10);
        return view('publicaciones.index', compact('publicaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = TipoSemilla::get();
        return view('publicaciones.crear', compact('tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionesPublicacion $request)
    {
        $publicacion = new Publicacion();
        $publicacion->usuario_id = Auth::user()->usuario_id;
        $publicacion->titulo = $request->titulo;
        $publicacion->nombre_semilla = $request->nombre_semilla;
        $publicacion->tipo_semilla_id = $request->tipo_semilla_id;
        $publicacion->descripcion = $request->descripcion;
        $publicacion->porcentaje_THC = str_replace(',', '.', $request->porcentaje_THC);
        $publicacion->porcentaje_CBD = str_replace(',', '.', $request->porcentaje_CBD);
        $publicacion->porcentaje_indica = str_replace(',', '.', $request->porcentaje_indica);
        $publicacion->porcentaje_sativa = str_replace(',', '.', $request->porcentaje_sativa);
        $publicacion->porcentaje_ruderalis = str_replace(',', '.', $request->porcentaje_ruderalis);
        $publicacion->tiempo_floracion = str_replace('$ ', '', (str_replace('.', '', $request->tiempo_floracion)));
        $publicacion->produccion_interior = str_replace('$ ', '', (str_replace('.', '', $request->produccion_interior)));
        $publicacion->produccion_exterior = str_replace('$ ', '', (str_replace('.', '', $request->produccion_exterior)));
        $publicacion->altura = str_replace('$ ', '', (str_replace('.', '', $request->altura)));
        $publicacion->semillas_paquete = str_replace('$ ', '', (str_replace('.', '', $request->semillas_paquete)));
        $publicacion->precio = str_replace('$ ', '', (str_replace('.', '', $request->precio)));
        $publicacion->stock = str_replace('$ ', '', (str_replace('.', '', $request->stock)));
        $publicacion->fecha_creacion = new DateTime();
        $publicacion->fecha_actualizacion = null;
        $publicacion->activa = true;

        if ($publicacion->save()) {
            if (count((array) $request->fotos) > 0) {
                foreach ((array) $request->fotos as $key => $f) {
                    if (isset($f)) {
                        $size = Storage::size('public/' . $f);
                        $foto = new PublicacionFoto();
                        $foto->publicacion_id = $publicacion->publicacion_id;
                        $foto->foto = $f;
                        $foto->size = $size;
                        $foto->save();
                    }
                }
            }
        }
        $notificacion = array(
            'mensaje' => 'Publicación creado con éxito',
            'tipo' => 'success',
            'titulo' => 'Publicaciones'
        );
        return redirect('/publicaciones')->with($notificacion);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $publicacion = Publicacion::where('publicacion_id', $id)
        ->with(['fotos', 'tipo', 'resenas', 'resenas.compra', 'resenas.compra.comprador'])
        ->first();
        return view('publicaciones.show', compact('publicacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipos = TipoSemilla::get();
        $publicacion = Publicacion::where('publicacion_id', $id)->with('fotos')->first();
        return view('publicaciones.editar', compact('publicacion', 'tipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionesPublicacion $request, $id)
    {
        $publicacion = Publicacion::find($id);
        $publicacion->usuario_id = Auth::user()->usuario_id;
        $publicacion->titulo = $request->titulo;
        $publicacion->nombre_semilla = $request->nombre_semilla;
        $publicacion->tipo_semilla_id = $request->tipo_semilla_id;
        $publicacion->descripcion = $request->descripcion;
        $publicacion->porcentaje_THC = str_replace(',', '.', $request->porcentaje_THC);
        $publicacion->porcentaje_CBD = str_replace(',', '.', $request->porcentaje_CBD);
        $publicacion->porcentaje_indica = str_replace(',', '.', $request->porcentaje_indica);
        $publicacion->porcentaje_sativa = str_replace(',', '.', $request->porcentaje_sativa);
        $publicacion->porcentaje_ruderalis = str_replace(',', '.', $request->porcentaje_ruderalis);
        $publicacion->tiempo_floracion = str_replace('$ ', '', (str_replace('.', '', $request->tiempo_floracion)));
        $publicacion->produccion_interior = str_replace('$ ', '', (str_replace('.', '', $request->produccion_interior)));
        $publicacion->produccion_exterior = str_replace('$ ', '', (str_replace('.', '', $request->produccion_exterior)));
        $publicacion->altura = str_replace('$ ', '', (str_replace('.', '', $request->altura)));
        $publicacion->semillas_paquete = str_replace('$ ', '', (str_replace('.', '', $request->semillas_paquete)));
        $publicacion->precio = str_replace('$ ', '', (str_replace('.', '', $request->precio)));
        $publicacion->stock = str_replace('$ ', '', (str_replace('.', '', $request->stock)));
        $publicacion->fecha_actualizacion = new DateTime();
        $publicacion->activa = true;
        
        PublicacionFoto::where('publicacion_id', $id)->delete();
        if ($publicacion->save()) {
            if (count((array) $request->fotos) > 0) {
                foreach ((array) $request->fotos as $key => $f) {
                    if (isset($f)) {
                        $size = Storage::size('public/storage' . $f);
                        $foto = new PublicacionFoto();
                        $foto->publicacion_id = $publicacion->publicacion_id;
                        $foto->foto = $f;
                        $foto->size = $size;
                        $foto->save();
                    }
                }
            }
        }
        $notificacion = array(
            'mensaje' => 'Publicación actualizada con éxito',
            'tipo' => 'success',
            'titulo' => 'Publicaciones'
        );
        return redirect('/publicaciones')->with($notificacion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //PublicacionFoto::where('publicacion_id', $id)->delete();
        $publicacion = Publicacion::find($id);
        if ($request->ajax()) {
            if ($publicacion->update(['activa' => false])) {
                return response()->json(['mensaje' => 'La publicacion fue eliminada correctamente', 'tipo' => 'success']);
            } else {
                return response()->json(['mensaje' => 'La publicacion no pudo ser eliminada, hay recursos usándolo', 'tipo' => 'error']);
            }
        } else {
            abort(404);
        }
    }

    public function subirFotos(Request $request)
    {
        $parametro = Parametro::where('nombre', 'Fotos')->first();
        if ($parametro && $parametro->indice >= 0) {
            $nombreArchivo = 'File-' . $parametro->indice . '.' . $request->file('file')->extension();
            $parametro->indice += 1;
            $parametro->save();
        } else {
            $nombreArchivo = 'File-1.' . $request->file('file')->extension();
            $parametro = new Parametro;
            $parametro->nombre = 'Fotos';
            $parametro->indice = 1;
            $parametro->save();
        }
        Storage::disk('public')->put($nombreArchivo,  file_get_contents($request->file('file')));
        return response()->json(['value' => $nombreArchivo, 'size' => $request->file('file')->getSize()]);
    }

    public function eliminarFoto(Request $request, $publicacion = null)
    {
        unlink(storage_path('app/public/' . $request->name));
        if ($publicacion) {
            $publicacion = PublicacionFoto::where('publicacion_id', $publicacion)
                ->where('foto', '=', $request->name)
                ->delete();
        }
        return response()->json('ok');
    }
}
