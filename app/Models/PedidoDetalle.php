<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'menu_id',
        'cantidad',
        'subtotal',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

}
