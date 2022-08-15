<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function vehiculo(){
        return $this->hasMany(Vehiculo::class);
    }

    public function incidencia(){
        return $this->hasMany(Incidencia::class);
    }
}
