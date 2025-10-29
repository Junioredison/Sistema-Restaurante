<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mesa extends Model
{
    use HasFactory;

    protected $table = 'mesas';

    // Habilitar timestamps porque la migración los tiene
    public $timestamps = true;

    protected $fillable = [
        'numero_mesa',
        'disponibilidad',
        'capacidad',
        'estado'
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

}
