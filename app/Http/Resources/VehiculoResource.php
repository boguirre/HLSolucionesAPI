<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehiculoResource extends JsonResource
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
            'vehiculo_id'=>$this->id,
            'num_placa'=>$this->numero_placa,
            'cifra_vin' =>$this->cifra_vin,
            'foto_placa'=>$this->foto_placa,
            'status'=>$this->status,
            'marca' => new MarcaResource($this->marca),
            'modelo' => new ModeloResource($this->modelo),
            'area'=> new AreaResource($this->area),
            'subArea'=> new SubAreaResource($this->sub_area),
            'user'=> new UserResource($this->user)
        ];
    }
}
