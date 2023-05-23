<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Hotel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtén el usuario actualmente autenticado
        $user = Auth::user();
        // Obtén los hoteles asociados al usuario actual
        $hotels = $user->hotels ?? collect();
        return view('hotels.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hotels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación del formulario
        $validateData = $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'address' => ['required', 'string', 'max:70'],
            'stars' => ['required', 'string', 'max:1'],
            'availability' => ['required', 'boolean']
        ]);

        // Obtén el usuario actualmente autenticado
        $user = Auth::user();

        // Crea un nuevo hotel y asócialo al usuario
        $hotel = new Hotel([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'stars' => $request->input('stars'),
            'availability' => $request->input('availability')
        ]);
        $hotel->user()->associate($user);

        // Guarda el hotel en la base de datos
        $hotel->save();

        // Redirecciona o realiza alguna otra acción después del almacenamiento exitoso del hotel

        return redirect()->route('hotels.index')->with('success', 'Hotel creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hotel = Hotel::findOrFail($id);
        // Verificar si el usuario autenticado es el propietario del hotel
        if (!Auth::user()->hotels->contains($hotel)) {
            abort(403); // El usuario no está autorizado para ver este hotel
        }
        return view('hotels.show', compact('hotel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hotel = Hotel::findOrFail($id);
        // Verificar si el usuario autenticado es el propietario del hotel
        if (!Auth::user()->hotels->contains($hotel)) {
            abort(403); // El usuario no está autorizado para editar este hotel
        }
        return view('hotels.edit', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        // Verificar si el usuario autenticado es el propietario del hotel
        if (!Auth::user()->hotels->contains($hotel)) {
            abort(403); // El usuario no está autorizado para actualizar este hotel
        }
        $hotel->update($request->all());
        return redirect()->route('hotels.index')->with('success', 'Hotel actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        // Verificar si el usuario autenticado es el propietario del hotel
        if (!Auth::user()->hotels->contains($hotel)) {
            abort(403); // El usuario no está autorizado para eliminar este hotel
        }
        $hotel->delete();
        return redirect()->route('hotels.index')->with('success', 'Hotel eliminado con éxito');
    }
}
