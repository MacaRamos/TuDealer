<?php

namespace App\Http\Controllers\Compra;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidacionesCompra;
use App\Models\Compra\Compra;
use App\Models\Compra\EstadoCompra;
use App\Models\Comuna;
use App\Models\Publicacion\Publicacion;
use App\Models\Publicacion\PublicacionResena;
use App\Models\Region;
use App\Models\Usuario;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        setlocale(LC_ALL, "es_ES@euro", "es_ES", "esp");
        $compras = Compra::where('usuario_id', Auth::user()->usuario_id)->with(['estado', 'publicacion', 'publicacion.fotos', 'publicacion.vendedor'])
        ->paginate(10);
        
        return view('compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($publicacion_id, $unidades = 1)
    {
        $publicacion = Publicacion::where('publicacion_id', $publicacion_id)->with(['fotos', 'tipo'])->first();
        $regiones = Region::get();

        $comunas = Comuna::whereHas('provincia', function ($q) use ($regiones) {
            $q->where('region_id', $regiones[0]->region_id);
        })->get();

        if($unidades > $publicacion->stock){
            $unidades = $publicacion->stock;
        }
        
        if($publicacion->usuario_id != Auth::user()->usuario_id){
            return view('compras.crear', compact('publicacion', 'regiones', 'comunas', 'unidades'));
        }else{
            return redirect()->route('inicio');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionesCompra $request)
    {
        $publicacion = Publicacion::find($request->publicacion_id);
        $compra = new Compra();
        $compra->publicacion_id = $request->publicacion_id;
        $compra->usuario_id = Auth::user()->usuario_id;
        $compra->estado_compra_id = EstadoCompra::EN_PROCESO;
        $compra->nombre_recibe = $request->nombre_recibe;
        $compra->RUT_recibe = $request->RUT_recibe;
        $compra->celular_recibe = $request->celular_recibe;
        $compra->email_recibe = $request->email_recibe;
        $compra->region_id = $request->region_id;
        $compra->comuna_id = $request->comuna_id;
        $compra->calle = $request->calle;
        $compra->numero_direccion = $request->numero_direccion;
        $compra->numero_departamento = $request->numero_departamento ?? null;
        $compra->medio_pago = $request->medio_pago;
        $compra->fecha_compra = new DateTime();
        $compra->unidades = $request->unidades;
        $compra->precio_total = $publicacion->precio * $request->unidades;
        $compra->save();

        $vendedor = Usuario::find($publicacion->usuario_id);

        return view('compras.postVenta', compact('compra', 'publicacion', 'vendedor'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getComunas($region)
    {
        $comunas = Comuna::whereHas('provincia', function ($q) use ($region) {
            $q->where('region_id', $region);
        })->get();

        return response()->json($comunas);
    }

    public function recepcion($compra_id){
        $compra = Compra::find($compra_id);
        $compra->estado_compra_id = EstadoCompra::ENTREGADA;
        $compra->save();

        $notificacion = array(
            'mensaje' => 'Compra marcada como entregada',
            'tipo' => 'success',
            'titulo' => 'Compras'
        );
        return redirect('/compras')->with($notificacion);
    }

    public function resena(Request $request, $compra_id){
        $compra = Compra::find($compra_id);

        $resena = new PublicacionResena();
        $resena->compra_id = $compra_id;
        $resena->publicacion_id = $compra->publicacion_id;
        $resena->puntaje = $request->puntaje ?? 0;
        $resena->resena = $request->resena ?? null;
        $resena->save();

        $compra->estado_compra_id = EstadoCompra::EVALUADA;

        $notificacion = array(
            'mensaje' => 'Evaluación realizada correctamente',
            'tipo' => 'success',
            'titulo' => 'Compras'
        );
        return redirect('/compras')->with($notificacion);
    }
}
