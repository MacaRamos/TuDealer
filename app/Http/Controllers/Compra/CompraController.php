<?php

namespace App\Http\Controllers\Compra;

use App\Http\Controllers\Controller;
use App\Models\Comuna;
use App\Models\Publicacion\Publicacion;
use App\Models\Region;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($publicacion_id)
    {
        // dd($publicacion_id);
        $publicacion = Publicacion::find($publicacion_id);
        $regiones = Region::get();

        $comunas = Comuna::whereHas('provincia', function ($q) use ($regiones) {
            $q->where('region_id', $regiones[0]->region_id);
        })->get();
        
        return view('compras.crear', compact('publicacion', 'regiones', 'comunas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
