<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable = [
        'nombre', 'direccion', 'horario', 'user_id', 'lat', 'lon', 'gusto_id'
    ];
    
    
    public function menus()
    {
        return $this->hasMany('App\Menu');
    }
    
    public function toArray()
    {
        $array = parent::toArray();
        $array['menus'] = $this->menus;
        return $array;
    }
    
    
}
