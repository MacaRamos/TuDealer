<?php

namespace App\Http\Controllers\Venta;

use App\Http\Controllers\Controller;
use App\Models\Compra\Compra;
use App\Models\Compra\EstadoCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        setlocale(LC_ALL, "es_ES@euro", "es_ES", "esp");
        $ventas = Compra::whereHas('publicacion', function ($query) {
            return $query->where('usuario_id', Auth::user()->usuario_id);
        })->with(['estado', 'publicacion', 'publicacion.fotos', 'publicacion.vendedor', 'comprador'])
            ->paginate(10);

        return view('ventas.index', compact('ventas'));
    }

    public function enviar($compra_id){
        $compra = Compra::find($compra_id);
        $compra->estado_compra_id = EstadoCompra::EN_CAMINO;
        $compra->save();

        $notificacion = array(
            'mensaje' => 'Venta marcada como enviada',
            'tipo' => 'success',
            'titulo' => 'Ventas'
        );
        return redirect('/ventas')->with($notificacion);
    }
}
