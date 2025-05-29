@extends('layouts.videogameapp')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-6">Edita Videojuego</h1>
        <form action="{{ route('videogames.update', $videogame, true) }}" method="POST">
            @csrf
            @method('PUT')
            @include('videogames.form')
            <button type="submit"
                class="mt-4 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition cursor-pointer">Actualiza</button>
        </form>
    </div>
@endsection
