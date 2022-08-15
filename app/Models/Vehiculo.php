<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function marca(){
        return $this->belongsTo(Marca::class);
    }

    public function modelo(){
        return $this->belongsTo(Modelo::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function sub_area(){
        return $this->belongsTo(SubArea::class);
    }

    public function seguimiento(){
        return $this->hasMany(Seguimiento::class);
    }

    public function seguimiento_especializado(){
        return $this->hasMany(SeguimientoEspecializado::class);
    }

    
}
