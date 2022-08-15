<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\IncidenciaResource;
use App\Models\Incidencia;
use App\Models\Servicio;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class IncidenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return IncidenciaResource::collection(Incidencia::all());
    }

    public function servicios(){
        return Servicio::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'marca_id'=>'required',
            'modelo_id'=> 'required',
            'descripcion'=>'required',
            'foto_incidencia_1' => 'required',
            'foto_incidencia_2' => 'required',
            'foto_incidencia_3' => 'required'
        ]);

        $incidente = new Incidencia();
        $incidente->modelo_id = $request->modelo_id;
        $incidente->marca_id = $request->marca_id;
        $incidente->user_id = Auth::user()->id;
        $incidente->fecha_registrada = $request->fecha_registrada;
        $incidente->descripcion = $request->descripcion;

        if($request->foto_incidencia_1 != ''){
            $photo = Str::random(10).".jpg";
            file_put_contents('storage/incidentes/'.$photo,base64_decode($request->foto_incidencia_1));
            $incidente->foto_incidencia_1 = Storage::url('incidentes/'.$photo);
        }

        if($request->foto_incidencia_2 != ''){
            $photo = Str::random(10).".jpg";
            file_put_contents('storage/incidentes/'.$photo,base64_decode($request->foto_incidencia_2));
            $incidente->foto_incidencia_2 = Storage::url('incidentes/'.$photo);
        }

        if($request->foto_incidencia_3 != ''){
            $photo = Str::random(10).".jpg";
            file_put_contents('storage/incidentes/'.$photo,base64_decode($request->foto_incidencia_3));
            $incidente->foto_incidencia_3 = Storage::url('incidentes/'.$photo);
        }


        $incidente->save();

        return response()->json([
            'res'=> true,
            'data'=> $incidente
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Incidencia $incidente)
    {
        return response()->json([
            'res' => true,
            'data' => $incidente
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incidencia $incidente)
    {
        $request->validate([
            'modelo_id'=>'required',
            'marca_id'=> 'required',
            'descripcion'=>'required',
            'img_incidente_1' => 'required',
            'img_incidente_2' => 'required',
            'img_incidente_3' => 'required'
        ]);

        $incidente->update($request->all());

        return response()->json([
            'res'=>true,
            'data'=> $incidente
        ]);
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
}
