<?php

namespace App\Http\Controllers;

use App\Models\Publicacion\Publicacion;
use App\Models\Publicacion\TipoSemilla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $tipos = TipoSemilla::get();

        $publicaciones = Publicacion::where('usuario_id', '!=', Auth::user()->usuario_id ?? '')->where('activa', true)->where(function ($query) use ($request) {
            if($request->busqueda){
                $query->where('titulo', 'like', "%$request->busqueda%");
            }
            if(isset($request->tipos)){
                $query->whereIn('tipo_semilla_id', (array)$request->tipos);
            }
        })->get();

        
        if($request->ajax()){
            return view('publicaciones', compact('publicaciones', 'tipos'));
        }else{
            return view('inicio', compact('publicaciones', 'tipos'));
        }
    }
}
