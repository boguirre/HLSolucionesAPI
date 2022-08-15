<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SeguimientoResource;
use App\Models\Seguimiento;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SeguimientoResource::collection(Seguimiento::orderBy('id','DESC')->get());
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
            'ot'=> 'required',
            'vehiculo_id'=>'required',
            'servicio_id'=>'required',
            'hora_ingreso' => 'required',
            'img_inicial_1' => 'required',
            'img_inicial_2' => 'required'
        ]);

        $seguimiento = new Seguimiento();
        $seguimiento->ot = $request->ot;
        $seguimiento->vehiculo_id = $request->vehiculo_id;
        $seguimiento->user_id = Auth::user()->id;
        $seguimiento->servicio_id = $request->servicio_id;
        $seguimiento->hora_ingreso = $request->hora_ingreso;

        if($request->img_inicial_1 != ''){
            $photo = Str::random(10).".jpg";
            file_put_contents('storage/seguimientos/'.$photo,base64_decode($request->img_inicial_1));
            $seguimiento->img_inicial_1 = Storage::url('seguimientos/'.$photo);
        }

        if($request->img_inicial_2 != ''){
            $photo = Str::random(10).".jpg";
            file_put_contents('storage/seguimientos/'.$photo,base64_decode($request->img_inicial_2));
            $seguimiento->img_inicial_2 = Storage::url('seguimientos/'.$photo);
        }

        $vehiculo = Vehiculo::find($request->vehiculo_id);

        $vehiculo->status = "2";

        $vehiculo->update();

        $seguimiento->save();

        return response()->json([
            'res'=> true,
            'data'=> $seguimiento
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Seguimiento $seguimiento)
    {
        return response()->json([
            'res' => true,
            'data' => $seguimiento
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seguimiento $seguimiento)
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
            file_put_contents('storage/controlcalidad/'.$photo,base64_decode($request->img_salida_1));
            $img_salida_1= Storage::url('controlcalidad/'.$photo);
        }

        if($request->img_salida_2 != ''){
            $photo = Str::random(10).".jpg";
            file_put_contents('storage/controlcalidad/'.$photo,base64_decode($request->img_salida_2));
            $img_salida_2= Storage::url('controlcalidad/'.$photo);
        }

        if($request->img_salida_3 != ''){
            $photo = Str::random(10).".jpg";
            file_put_contents('storage/controlcalidad/'.$photo,base64_decode($request->img_salida_3));
            $img_salida_3 = Storage::url('controlcalidad/'.$photo);
        }

        if($request->img_salida_4 != ''){
            $photo = Str::random(10).".jpg";
            file_put_contents('storage/controlcalidad/'.$photo,base64_decode($request->img_salida_4));
            $img_salida_4 = Storage::url('controlcalidad/'.$photo);
        }

        $vehiculo = Vehiculo::find($request->vehiculo_id);

        $vehiculo->status = "4";

        $vehiculo->update();

        $seguimiento->update([
            $seguimiento->hora_salida = $request->hora_salida,
            $seguimiento->img_salida_1 = $img_salida_1,
            $seguimiento->img_salida_2 = $img_salida_2,
            $seguimiento->img_salida_3 = $img_salida_3,
            $seguimiento->img_salida_4= $img_salida_4,
            $seguimiento->status = $request->status

        ]);

        return response()->json([
            'res'=>true,
            'data'=> $seguimiento
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
