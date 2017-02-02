<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable = [
        'nombre', 'direccion', 'horario', 'user_id', 'lat', 'lon'
    ];
}
