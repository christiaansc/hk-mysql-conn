<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $fillable = [     
        'nombre',
        'descripcion',
        'stock',
        'precioCompra',
        'estado',
        ];
}
