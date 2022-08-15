<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SeguimientoEspeResource;
use App\Models\SeguimientoEspecializado;
use Illuminate\Support\Str;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SeguimientoEspController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SeguimientoEspeResource::collection(SeguimientoEspecializado::orderBy('id','DESC')->get());
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
            'ot'=> 'required|unique:seguimiento_especializados,ot',
            'oc' => 'required|unique:seguimiento_especializados,oc',
            'vehiculo_id'=>'required',
            'servicio_id'=>'required',
            'hora_ingreso' => 'required',
            'img_inicial_1' => 'required',
            'img_inicial_2' => 'required',
            'img_inicial_3' => 'required',
            'img_inicial_4' => 'required'
        ]);

        $seguimientoEsp = new SeguimientoEspecializado();
        $seguimientoEsp->ot = $request->ot;
        $seguimientoEsp->oc = $request->oc;
        $seguimientoEsp->vehiculo_id = $request->vehiculo_id;
        $seguimientoEsp->especialista_id = $request->especialista_id;
        $seguimientoEsp->servicio_id = $request->servicio_id;
        $seguimientoEsp->user_id = Auth::user()->id;
        $seguimientoEsp->hora_ingreso = $request->hora_ingreso;

        if($request->img_inicial_1 != ''){
            $photo = Str::random(10).".jpg";
            file_put_contents('storage/seguimientosesp/'.$photo,base64_decode($request->img_inicial_1));
            $seguimientoEsp->img_inicial_1 = Storage::url('seguimientosesp/'.$photo);
        }

        if($request->img_inicial_2 != ''){
            $photo = Str::random(10).".jpg";
            file_put_contents('storage/seguimientosesp/'.$photo,base64_decode($request->img_inicial_2));
            $seguimientoEsp->img_inicial_2 = Storage::url('seguimientosesp/'.$photo);
        }

        if($request->img_inicial_3 != ''){
            $photo = Str::random(10).".jpg";
            file_put_contents('storage/seguimientosesp/'.$photo,base64_decode($request->img_inicial_3));
            $seguimientoEsp->img_inicial_3 = Storage::url('seguimientosesp/'.$photo);
        }

        if($request->img_inicial_4 != ''){
            $photo = Str::random(10).".jpg";
            file_put_contents('storage/seguimientosesp/'.$photo,base64_decode($request->img_inicial_4));
            $seguimientoEsp->img_inicial_4 = Storage::url('seguimientosesp/'.$photo);
        }

        $vehiculo = Vehiculo::find($request->vehiculo_id);

        $vehiculo->status = "3";

        $vehiculo->update();

        $seguimientoEsp->save();

        return response()->json([
            'res'=> true,
            'data'=> $seguimientoEsp
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SeguimientoEspecializado $especializado)
    {
        return response()->json([
            'res' => true,
            'data' => $especializado
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SeguimientoEspecializado $especializado)
    {
        $request->validate([
            'hora_salida' => 'required',
            'img_salida_1' => 'required',
            'img_salida_2' => 'required',
            'img_salida_3' => 'required',
            'img_salida_4' => 'required',
            'status' => 'required'
        ]);

        if($request->img_salida_1 != ''){
            $photo = Str::random(10).".jpg";
            file_put_contents('storage/controlcalidadesp/'.$photo,base64_decode($request->img_salida_1));
            $img_salida_1= Storage::url('controlcalidadesp/'.$photo);
        }

        if($request->img_salida_2 != ''){
            $photo = Str::random(10).".jpg";
            file_put_contents('storage/controlcalidadesp/'.$photo,base64_decode($request->img_salida_2));
            $img_salida_2= Storage::url('controlcalidadesp/'.$photo);
        }

        if($request->img_salida_3 != ''){
            $photo = Str::random(10).".jpg";
            file_put_contents('storage/controlcalidadesp/'.$photo,base64_decode($request->img_salida_3));
            $img_salida_3 = Storage::url('controlcalidadesp/'.$photo);
        }

        if($request->img_salida_4 != ''){
            $photo = Str::random(10).".jpg";
            file_put_contents('storage/controlcalidadesp/'.$photo,base64_decode($request->img_salida_4));
            $img_salida_4 = Storage::url('controlcalidadesp/'.$photo);
        }

        $vehiculo = Vehiculo::find($request->vehiculo_id);

        $vehiculo->status = "4";

        $vehiculo->update();

        $especializado->update([
            $especializado->hora_salida = $request->hora_salida,
            $especializado->servicio_id = $request->servicio_id,
            $especializado->img_salida_1 = $img_salida_1,
            $especializado->img_salida_2 = $img_salida_2,
            $especializado->img_salida_3 = $img_salida_3,
            $especializado->img_salida_4= $img_salida_4,
            $especializado->status = $request->status
        ]);

        return response()->json([
            'res'=>true,
            'data'=> $especializado
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
