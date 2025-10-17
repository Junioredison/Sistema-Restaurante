<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $fillable = [ //todos los atributos usados para crear 
        'name',
    ];
    protected $hidden = [ // todos los atributos que trae el get y que no quiero que se muestren
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function Toshow(): array
    {
        return [
            'name' => $this->name,
        ];
    }


}
