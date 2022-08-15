<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\VehiculoResource;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VehiculoResource::collection(Vehiculo::orderBy('id','DESC')->get());
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
            'numero_placa'=>'required'
            
        ]);

        $vehiculo = new Vehiculo();
        $vehiculo->marca_id = $request->marca_id;
        $vehiculo->modelo_id = $request->modelo_id;
        $vehiculo->area_id = $request->area_id;
        $vehiculo->sub_area_id = $request->sub_area_id;
        $vehiculo->user_id = Auth::user()->id;
        $vehiculo->numero_placa = $request->numero_placa;
        $vehiculo->cifra_vin = $request->cifra_vin;

        if($request->foto_placa != ''){
            $photo = time().'.jpg';
            file_put_contents('storage/placas/'.$photo,base64_decode($request->foto_placa));
            $vehiculo->foto_placa = Storage::url('placas/'.$photo);
        }

        $vehiculo->save();

        return response()->json([
            'res'=> true,
            'data'=> $vehiculo
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vehiculo $vehiculo)
    {
        return response()->json([
            'res' => true,
            'data' => $vehiculo
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        $request->validate([
            'marca_id'=>'required',
            'modelo_id'=> 'required',
            'numero_placa'=>'required|unique:vehiculos,numero_placa,' .$vehiculo->id
        ]);

        $vehiculo->update([
            $vehiculo->marca_id = $request->marca_id,
            $vehiculo->modelo_id = $request->modelo_id,
            $vehiculo->area_id = $request->area_id,
            $vehiculo->sub_area_id = $request->sub_area_id,
            $vehiculo->numero_placa = $request->numero_placa,
            $vehiculo->cifra_vin = $request->cifra_vin
        ]);

        return response()->json([
            'res'=>true,
            'data'=> $vehiculo
        ]);
    }

    // public function updateVehiculo(Request $request){

    //     $request->validate([
    //         'marca_id'=>'required',
    //         'modelo_id'=> 'required',
    //         'numero_placa'=>'required|unique:vehiculos,numero_placa,' .$request->id,
    //         'cifra_vin' => 'required|unique:vehiculos,cifra_vin,' .$request->id
    //     ]);

    //     $vehiculo = Vehiculo::find($request->id);

    //     $vehiculo->marca_id = $request->marca_id;
    //     $vehiculo->modelo_id = $request->modelo_id;
    //     $vehiculo->numero_placa = $request->numero_placa;
    //     $vehiculo->cifra_vin = $request->cifra_vin;
        

    //     $vehiculo->update();

    //     return response()->json([
    //         'res'=>true,
    //         'data'=> $vehiculo
    //     ]);
        
    // }

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
