<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Controller vista</title>
</head>
<body>
    <p>Hola mundo Blade Laravel</p>
    


    <caption>Listado Clientes</caption>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td>{{$cliente['id']}}</td>
                <td>{{$cliente['nombre']}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @forelse ($usuarios as $usuario)
        {{print_r($usuario)}}
    @empty
        <p><b>Sin usuarios</b></p>
    @endforelse
</body>
</html>