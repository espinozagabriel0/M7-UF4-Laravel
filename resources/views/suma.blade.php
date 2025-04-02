<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sumar números con PHP</title>
</head>
<body>
    <h2>Sumar dos números</h2>
    <form action="/suma" method="POST">
        @csrf
        <input type="number" name="num1" placeholder="Número 1">
        <input type="number" name="num2" placeholder="Número 2">
        <button type="submit">Sumar</button>
    </form>


    @if (isset($resultado))
        <h1>Resultado de la suma: {{ $resultado }}</h1>
    @endif
</body>
</html>
