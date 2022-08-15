<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tipo_servicio(){
        return $this->belongsTo(TipoServicio::class);
    }

    public function seguimiento(){
        return $this->hasMany(Seguimiento::class);
    }

    public function seguimiento_especializado(){
        return $this->hasMany(SeguimientoEspecializado::class);
    }
}
