<?php

namespace App\Http\Controllers;

use App\Models\PedidoDetalle;
use Illuminate\Http\Request;

class PedidoDetalleController extends Controller
{
    /**
     * Mostrar lista de detalles (opcional)
     */
    public function index()
    {
        $detalles = PedidoDetalle::with(['pedido.mesa', 'menu'])->get();
        return view('pedido_detalle.index', compact('detalles'));
    }

    /**
     * Mostrar un detalle específico
     */
    public function show(PedidoDetalle $pedido_detalle)
    {
        $pedido_detalle->load(['pedido.mesa', 'menu']);
        return view('pedido_detalle.show', compact('pedido_detalle'));
    }
}
