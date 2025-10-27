<?php

namespace App\Http\Controllers;

use App\Models\mesa;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MesaController extends Controller
{
    
    public function index()
    {
        $datos = mesa::get();       
        
        return view("mesa.index",compact('datos'));
    }


    public function store(Request $request)
    {
        try {
        // 🔹 Validaciones limpias y consistentes
        $validated = $request->validate([
            'numero_mesa'     => 'required|integer|unique:mesas,numero_mesa',
            'capacidad'       => 'required|integer|min:1',
            'disponibilidad'  => 'required|boolean',
        ], [
            'numero_mesa.required' => 'El número de mesa es obligatorio.',
            'numero_mesa.integer'  => 'Debe ingresar un número válido.',
            'numero_mesa.unique'   => 'El número de mesa ya existe.',
            'capacidad.required'   => 'Debe especificar la capacidad.',
            'capacidad.integer'    => 'La capacidad debe ser un número entero.',
            'capacidad.min'        => 'Debe haber al menos una persona por mesa.',
            'disponibilidad.required' => 'Debe seleccionar la disponibilidad.',
            'disponibilidad.boolean'  => 'El valor de disponibilidad no es válido.',
        ]);

        // 🔹 Crear la mesa con estado inicial "libre" (0)
        Mesa::create([
            'numero_mesa'    => $validated['numero_mesa'],
            'capacidad'      => $validated['capacidad'],
            'disponibilidad' => $validated['disponibilidad'],
            'estado'         => 0, // 0 = libre, 1 = ocupada
        ]);

        return redirect()
            ->route('mostrar.mesa')
            ->with('success', 'La mesa fue registrada exitosamente.');

    } catch (ValidationException $e) {
        $mensajes = collect($e->errors())->flatten()->join(' ');
        return back()->with('error', $mensajes);

    } catch (\Exception $e) {
        return back()->with('error', 'Ocurrió un error al registrar la mesa: ' . $e->getMessage());
    }
    }

    public function show(mesa $mesa)
    {
        //
    }

    public function update(Request $request, mesa $mesa)
    {
        try {
            $modificar = $request->validate([
                    'id'    =>  'required',
                    'numero_mesa' => 'required|integer',
                    'capacidad' => 'required|integer|min:1',
                    'disponibilidad' => 'required',            
                ], $this->rules);  

            $dato = mesa::find($request->id);
            
            $dato->update($modificar);
        } 
        catch(ValidationException $e){
            $mensajes = collect($e->errors())->flatten()->join(' ');
            dd($mensajes);
            return back()->with('error', $mensajes);
        }
        catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
        return redirect()->route('mostrar.mesa');
    }

    public function destroy(Request $request)
    {
        $datos= mesa::find($request->inputIdEliminar);
        $datos->delete();
        return redirect()->route('mostrar.mesa');
    }

    private $rules = [
    'numero_mesa.required' => 'El número de mesa es obligatorio.',
    'numero_mesa.integer' => 'Debe ingresar un número válido.',
    'numero_mesa.unique' => 'El número de mesa ya existe.',

    'capacidad.required' => 'Debe especificar la capacidad de ,mesas.',
    'capacidad.integer' => 'La capacidad debe ser un número entero.',
    'capacidad.min' => 'Debe haber al menos una mesa.',

    'disponibilidad.boolean' => 'El valor de disponibilidad no es válido.',
    ];
}
