<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gusto extends Model
{
        protected $fillable = [
            'nombre', 'icono',
        ];
}
