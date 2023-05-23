@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Apartamento</h1>

        <form action="{{ route('apartments.update', $apartment->id) }}" method="POST">
            @csrf
            @method('PUT')
                <!-- Nombre  -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$apartment->name}}" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

            <!-- Dirección  -->
            <div class="mb-3">
                <label for="address" class="form-label">Dirección</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{$apartment->address}}" autofocus>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Habitaciones  -->
            <div class="mb-3">
                <label for="rooms" class="form-label">Habitaciones</label>
                <input type="number" class="form-control @error('rooms') is-invalid @enderror" name="rooms" value="{{$apartment->rooms}}" autofocus>
                @error('rooms')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Disponibilidad  -->
            <div class="form-group">
                <label for="availability" class="form-label">Disponibilidad</label>
                <select class="form-select" aria-label="availability" name="availability" id="availability" autofocus>
                    <option disabled>Disponibilidad</option>
                    <option value="0" @if ($apartment->availability == 0) selected @endif >Disponible</option>
                    <option value="1" @if ($apartment->availability == 1) selected @endif>No disponible</option>
                </select>
                @error('availability')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <br>
            <div class="card-footer text-muted">
                <!-- Botones de acción --------------------------------------------------->
               <a class="btn btn-secondary" href="{{ route ('apartments.index')}}" role="button">Atrás</a>
               <button type="reset" class="btn btn-danger">Borrar</button>
               <button type="submit" class="btn btn-primary">Editar</button>
           </div>
        </form>



    </div>
@endsection