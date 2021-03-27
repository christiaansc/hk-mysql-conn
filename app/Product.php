<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [     
        'nombre',
        'codigo',
        'stock',
        'image',
        'descripcion',
        'precio',
        'stado',
        'categoria_id',
        'provider_id',
        ];
}