<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class MenuController extends Controller
{
    /**
     * Mostrar lista de menús
     */
    public function index()
    {
        $menus = Menu::all();
        return view('menu.index', compact('menus'));
    }

    /**
     * Formulario de creación
     */
    public function create()
    {
        return view('menu.crear');
    }

    /**
     * Guardar nuevo menú
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:100',
                'descripcion' => 'required|string',
                'precio' => 'required|numeric|min:0',
                'disponibilidad' => 'required|boolean',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $rutaFoto = null;

            if ($request->hasFile('foto')) {
                $nombre = time() . '_' . $request->nombre . '.' . $request->file('foto')->getClientOriginalExtension();
                $ruta = $request->file('foto')->storeAs('fotoMenu', $nombre, 'public');
                $rutaFoto = 'storage/' . $ruta;
            }

            Menu::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'disponibilidad' => $request->disponibilidad,
                'foto' => $rutaFoto,
            ]);

            return redirect()->route('mostrar.menu')->with('success', 'Menú creado correctamente.');
        } catch (ValidationException $e) {
            $mensajes = collect($e->errors())->flatten()->join(' ');
            return back()->with('error', $mensajes);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Mostrar un menú
     */
    public function show(Menu $menu)
    {
        return view('menu.mostrar', compact('menu'));
    }

    /**
     * Formulario de edición
     */
    public function edit(Menu $menu)
    {
        return view('menu.editar', compact('menu'));
    }

    /**
     * Actualizar menú
     */
    public function update(Request $request, Menu $menu)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:100',
                'descripcion' => 'required|string',
                'precio' => 'required|numeric|min:0',
                'disponibilidad' => 'required|boolean',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            if ($request->hasFile('foto')) {
                if ($menu->foto && file_exists(public_path($menu->foto))) {
                    unlink(public_path($menu->foto));
                }

                $nombre = time() . '_' . $request->nombre . '.' . $request->file('foto')->getClientOriginalExtension();
                $ruta = $request->file('foto')->storeAs('fotoMenu', $nombre, 'public');
                $menu->foto = 'storage/' . $ruta;
            }

            $menu->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'disponibilidad' => $request->disponibilidad,
                'foto' => $menu->foto,
            ]);

            return redirect()->route('mostrar.menu')->with('success', 'Menú actualizado correctamente.');
        } catch (ValidationException $e) {
            $mensajes = collect($e->errors())->flatten()->join(' ');
            return back()->with('error', $mensajes);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Eliminar menú
     */
    public function destroy(Request $request)
{
    try {
        $menu = Menu::findOrFail($request->id);

        if ($menu->foto && file_exists(public_path($menu->foto))) {
            unlink(public_path($menu->foto));
        }

        $menu->delete();

        return redirect()->route('mostrar.menu')->with('success', 'Menú eliminado correctamente.');
    } catch (\Exception $e) {
        return back()->with('error', 'Error al eliminar el menú: ' . $e->getMessage());
    }
}

}
