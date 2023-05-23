@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Hotel</h1>

        <form action="{{ route('hotels.store') }}" method="POST">
            @csrf

            <!-- Nombre  -->
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Dirección  -->
            <div class="mb-3">
                <label for="address" class="form-label">Dirección</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autofocus>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Estrellas  -->
            <div class="mb-3">
                <label for="stars" class="form-label">Estrellas</label>
                <input type="number" class="form-control @error('stars') is-invalid @enderror" name="stars" value="{{ old('stars') }}" autofocus>
                @error('stars')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Disponibilidad  -->
            <div class="form-group">
                <label for="availability" class="form-label">Disponibilidad</label>
                <select class="form-select" aria-label="availability" name="availability" id="availability" autofocus>
                    <option selected disabled>Disponibilidad</option>
                    <option value="0">Disponible</option>
                    <option value="1">No disponible</option>
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
               <a class="btn btn-secondary" href="{{ route ('hotels.index')}}" role="button">Atrás</a>
               <button type="submit" class="btn btn-primary">Crear</button>
           </div>
        </form>


    </div>
@endsection