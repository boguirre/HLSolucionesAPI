<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IncidenciaResource extends JsonResource
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
            'marca' => new MarcaResource($this->marca),
            'modelo' => new ModeloResource($this->modelo),
            'user' => new UserResource($this->user),
            'fecha'=> $this->fecha_registrada,
            'descripcion'=>$this->descripcion,
            'img_incidente_1'=>$this->foto_incidencia_1,
            'img_incidente_2'=>$this->foto_incidencia_2,
            'img_incidente_3'=>$this->foto_incidencia_3
        ];
    }
}
