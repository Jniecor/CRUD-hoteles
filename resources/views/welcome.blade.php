@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Hoteles disponibles</h1>
        <div class="row">
            @foreach ($hotels as $hotel)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $hotel->name }}</h5>
                            <p class="card-text">Dirección: {{ $hotel->address }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <h1>Apartamentos disponibles</h1>
        <div class="row">
            @foreach ($apartments as $apartment)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $apartment->name }}</h5>
                            <p class="card-text">Dirección: {{ $apartment->address }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
