<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Artículos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-info">
    <a class="navbar-brand" href="#">Menú</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Artículos</a>
            </li>
        </ul>
    </div>
</nav>

        <h2>Lista de Artículos</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Precio Coste</th>
                    <th>Precio Venta</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articulos as $articulo)
                <tr>
                    <td>{{ $articulo['id'] }}</td>
                    <td>{{ $articulo['descripcion'] }}</td>
                    <td>{{ $articulo['categoria'] }}</td>
                    <td>{{ $articulo['stock'] }}</td>
                    <td>{{ $articulo['precio_coste'] }}</td>
                    <td>{{ $articulo['precio_venta'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p>Número de registros: {{ count($articulos) }}</p>
    </div>

</body>
</html>
