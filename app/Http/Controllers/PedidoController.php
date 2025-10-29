<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Mesa;
use App\Models\Menu;
use App\Models\PedidoDetalle;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Mostrar la lista de pedidos
     */
    public function index()
    {
        $pedidos = Pedido::with('mesa')->get();
        $mesas = Mesa::all();
        $menus = Menu::where('disponibilidad', 1)->get(); // solo platos disponibles

        return view('pedido.index', compact('pedidos', 'mesas', 'menus'));
    }

    /**
     * Guardar un nuevo pedido
     */
    public function store(Request $request)
    {
        $request->validate([
            'mesa_id' => 'required|exists:mesas,id',
            'menus' => 'required|array',
        ]);

        $total = 0;

        // ✅ Recorremos los menús seleccionados
        foreach ($request->menus as $menuId => $menuData) {
            if (!isset($menuData['id'])) continue;

            $menu = Menu::find($menuData['id']);
            $cantidad = $menuData['cantidad'] ?? 1;
            $total += $menu->precio * $cantidad;
        }

        // ✅ Crear pedido principal
        $pedido = Pedido::create([
            'mesa_id' => $request->mesa_id,
            'total' => $total,
            'estado' => 'Pendiente',
        ]);

        // ✅ Crear los detalles del pedido
        foreach ($request->menus as $menuId => $menuData) {
            if (!isset($menuData['id'])) continue;

            $menu = Menu::find($menuData['id']);
            $cantidad = $menuData['cantidad'] ?? 1;

            PedidoDetalle::create([
                'pedido_id' => $pedido->id,
                'menu_id' => $menu->id,
                'cantidad' => $cantidad,
                'subtotal' => $menu->precio * $cantidad,
            ]);
        }

        return redirect()->route('mostrar.pedido')->with('success', 'Pedido creado correctamente');
    }

    public function destroy(Request $request)
    {
        $pedido = Pedido::find($request->id);
        if (!$pedido) {
            return back()->with('error', 'Pedido no encontrado');
        }

        $pedido->delete();
        return redirect()->route('mostrar.pedido')->with('success', 'Pedido eliminado correctamente');
    }

    public function cambiarEstado(Request $request)
    {
    $request->validate([
        'id' => 'required|exists:pedidos,id',
        'estado' => 'required|string|in:Pendiente,Listo,Entregado'
    ]);

    $pedido = Pedido::findOrFail($request->id);
    $pedido->estado = $request->estado;
    $pedido->save();

    return response()->json(['success' => true]);
    }

    
}
