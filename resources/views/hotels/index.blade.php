@extends('layouts.app')

@section('content')
    
    <div class="container">

        @include('partials.alerts')
        <h1>Listado de Hoteles</h1>

        <a href="{{ route('hotels.create') }}" class="btn btn-primary">Crear Hotel</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Estrellas</th>
                    <th>Disponibilidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if ($hotels->count() > 0)
                    @foreach($hotels as $hotel)
                    <tr>
                        <td>{{ $hotel->id }}</td>
                        <td>{{ $hotel->name }}</td>
                        <td>{{ $hotel->address }}</td>
                        <td>{{ $hotel->stars }}</td>
                        <td>{{ $hotel->availability ? 'No disponible' : 'Disponible' }}</td>
                        <td>
                            <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-primary">Ver</a>
                            <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-success">Editar</a>
                            <a href="hotels/destroy/{{$hotel->id}}" title="Eliminar" class="btn btn-danger" onclick="event.preventDefault();
                                if(confirm('¿Estás seguro de que deseas eliminar este hotel?')){
                                    document.getElementById('delete-form-{{ $hotel->id }}').submit();
                                }">Eliminar</a>
                            <form id="delete-form-{{ $hotel->id }}" action="{{ route('hotels.destroy', ['id' => $hotel->id]) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <p>No tienes hoteles asociados.</p>
                @endif
            </tbody>
        </table>

    </div>
@endsection