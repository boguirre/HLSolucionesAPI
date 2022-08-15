<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function modelo(){
        return $this->hasMany(Modelo::class);
    }

    public function vehiculo(){
        return $this->hasMany(Vehiculo::class);
    }

    public function incidencia(){
        return $this->hasMany(Incidencia::class);
    }
}
