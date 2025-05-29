<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestor de Videojuegos</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 text-gray-900 min-h-screen">

    <nav class="bg-slate-100 shadow mb-6">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a class="text-2xl font-bold text-black hover:text-slate-800 transition"
                href="{{ route('videogames.index') }}">
                Videojuegos
            </a>
            <a class="inline-block bg-black text-white px-4 py-2 rounded hover:bg-slate-800 transition"
                href="{{ route('videogames.create') }}">
                Añadir Videojuego
            </a>
        </div>
    </nav>

    <div class="container mx-auto px-4">
        @yield('content')
    </div>

</body>


</html>
