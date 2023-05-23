<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtén el usuario actualmente autenticado
        $user = Auth::user();
        // Obtén los hoteles asociados al usuario actual
        $apartments = $user->apartments ?? collect();
        return view('apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('apartments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validación del formulario
        $validateData = $request->validate(
            [
                'name' => ['required', 'string', 'max:25'],
                'address' => ['required', 'string', 'max:70'],
                'rooms' => ['required', 'string', 'max:2'],
                'availability' => ['required', 'boolean']
            ]
        );

        // Obtén el usuario actualmente autenticado
        $user = Auth::user();

        // Crea un nuevo apartamento y asócialo al usuario
        $apartment = new Apartment([
            'name' => $request['name'],
            'address' => $request['address'],
            'rooms' => $request['rooms'],
            'availability' => $request['availability']
        ]);
        $apartment->user()->associate($user);

        // Guarda el apartamento en la base de datos
        $apartment->save();

        // Redirecciona o realiza alguna otra acción después del almacenamiento exitoso del apartamento

        return redirect()->route('apartments.index')->with('success', 'Apartamento creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $apartment = Apartment::findOrFail($id);
        // Verificar si el usuario autenticado es el propietario del apartmento
        if (!Auth::user()->apartments->contains($apartment)) {
            abort(403); // El usuario no está autorizado para mostrar este apartmento
        }
        return view('apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $apartment = Apartment::findOrFail($id);
        // Verificar si el usuario autenticado es el propietario del apartmento
        if (!Auth::user()->apartments->contains($apartment)) {
            abort(403); // El usuario no está autorizado para editar este apartmento
        }
        return view('apartments.edit', compact('apartment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $apartment = Apartment::findOrFail($id);
        // Verificar si el usuario autenticado es el propietario del apartmento
        if (!Auth::user()->apartments->contains($apartment)) {
            abort(403); // El usuario no está autorizado para actualizar este apartmento
        }
        $apartment->update($request->all());
        return redirect()->route('apartments.index')->with('success', 'Apartmento actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $apartment = Apartment::findOrFail($id);
        // Verificar si el usuario autenticado es el propietario del apartmento
        if (!Auth::user()->apartments->contains($apartment)) {
            abort(403); // El usuario no está autorizado para eliminar este apartmento
        }
        $apartment->delete();
        return redirect()->route('apartments.index')->with('success', 'Apartmento eliminado con éxito');
    }
}
