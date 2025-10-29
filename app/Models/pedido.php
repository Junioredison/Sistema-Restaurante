<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'mesa_id',
        'total',
        'estado',
    ];

    // 🔗 Relación: un pedido pertenece a una mesa
    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }

    // 🔗 Relación: un pedido tiene muchos detalles
    public function detalles()
    {
        return $this->hasMany(PedidoDetalle::class);
    }
}
