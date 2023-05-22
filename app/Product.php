<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [     
        'nombre',
        'stock',
        'image',
        'descripcion',
        'precio',
        'stado',
        'categoria_id',
        'provider_id',
        ];

      
            
        public function categoria()
        {
            return $this->belongsTo(Categoria::class);
        }
}
