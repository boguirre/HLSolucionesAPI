<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialista extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function seguimiento_especializado(){
        return $this->hasMany(SeguimientoEspecializado::class);
    }
}
