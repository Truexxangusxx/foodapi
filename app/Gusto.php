<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gusto extends Model
{
        protected $fillable = [
            'nombre', 'icono',
        ];

    protected $appends = ['status'];
    public $status =false; 
    function getStatusAttribute()
    {
        return $this->status;
    }
    
}
