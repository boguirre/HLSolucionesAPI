<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeguimientoEspecializado extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class);
    }

    public function servicio(){
        return $this->belongsTo(Servicio::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function especialista(){
        return $this->belongsTo(Especialista::class);
    }
}
