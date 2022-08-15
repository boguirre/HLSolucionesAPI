<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SeguimientoEspeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'ot'=>$this->ot,
            'oc'=>$this->oc,
            'hora_ingreso'=>$this->hora_ingreso,
            'hora_salida'=>$this->hora_salida,
            'vehiculo' => new VehiculoResource($this->vehiculo),
            'servicio' => new ServicioResource($this->servicio),
            'user' => new UserResource($this->user),
            'especialista' => new EspecialistaResource($this->especialista),
            'img_inicial_1'=>$this->img_inicial_1,
            'img_inicial_2'=>$this->img_inicial_2,
            'img_inicial_3'=>$this->img_inicial_3,
            'img_inicial_4'=>$this->img_inicial_4,
            'img_salida_1'=>$this->img_salida_1,
            'img_salida_2'=>$this->img_salida_2,
            'img_salida_3'=>$this->img_salida_3,
            'img_salida_4'=>$this->img_salida_4,
            'status'=>$this->status
        ];
    }
}
