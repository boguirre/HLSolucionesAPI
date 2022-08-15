<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
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
}
