@extends('layouts.app')

@section('content')
    
    <div class="container">

        @include('partials.alerts')
        <h1>Listado de Apartamentos</h1>

        <a href="{{ route('apartments.create') }}" class="btn btn-primary">Crear Apartamento</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Habitaciones</th>
                    <th>Disponibilidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if ($apartments->count() > 0)
                    @foreach($apartments as $apartment)
                    <tr>
                        <td>{{ $apartment->id }}</td>
                        <td>{{ $apartment->name }}</td>
                        <td>{{ $apartment->address }}</td>
                        <td>{{ $apartment->rooms }}</td>
                        <td>{{ $apartment->availability ? 'No disponible' : 'Disponible' }}</td>
                        <td>
                            <a href="{{ route('apartments.show', $apartment->id) }}" class="btn btn-primary">Ver</a>
                            <a href="{{ route('apartments.edit', $apartment->id) }}" class="btn btn-success">Editar</a>
                            <a href="apartments/destroy/{{$apartment->id}}" title="Eliminar" class="btn btn-danger" onclick="event.preventDefault();
                                if(confirm('¿Estás seguro de que deseas eliminar este apartmento?')){
                                    document.getElementById('delete-form-{{ $apartment->id }}').submit();
                                }">Eliminar</a>
                            <form id="delete-form-{{ $apartment->id }}" action="{{ route('apartments.destroy', ['id' => $apartment->id]) }}" method="POST" style="display: none;">
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