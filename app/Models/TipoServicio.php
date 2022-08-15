<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoServicio extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function servicio(){
        return $this->hasMany(Servicio::class);
    }
}
