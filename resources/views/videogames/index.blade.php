@extends('layouts.videogameapp')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Listado de videojuegos</h1>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2 font-semibold">Título</th>
                    <th class="px-4 py-2 font-semibold">Género</th>
                    <th class="px-4 py-2 font-semibold">Desarrollador</th>
                    <th class="px-4 py-2 font-semibold">Descripción</th>
                    <th class="px-4 py-2 font-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($videogames as $videogame)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $videogame->title }}</td>
                        <td class="px-4 py-2">{{ $videogame->genre }}</td>
                        <td class="px-4 py-2">{{ $videogame->developer }}</td>
                        <td class="px-4 py-2">{{ $videogame->description }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <a class="inline-block bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 transition" href="{{ route('videogames.edit', $videogame, true) }}"
                                class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('videogames.destroy', $videogame, true) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="inline-block bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
