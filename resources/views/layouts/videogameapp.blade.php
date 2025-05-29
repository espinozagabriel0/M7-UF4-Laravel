<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestor de Videojuegos</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 text-gray-900 min-h-screen">

    <nav class="bg-white shadow mb-6">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a class="text-2xl font-bold text-blue-600 hover:text-blue-800 transition" href="{{ route('videogames.index') }}">
                Videojuegos
            </a>
            <a class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition" href="{{ route('videogames.create') }}">
                Añadir Videojuego
            </a>
        </div>
    </nav>

    <div class="container mx-auto px-4">
        @yield('content')
    </div>

</body>


</html>
