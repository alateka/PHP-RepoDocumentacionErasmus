<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listados</title>

    <style>
        body{
            font-family: Helvetica, sans-serif;
        }
    </style>
</head>
<body>

    <p style="font-size: 2em" class="text-center mb-5">Listados <?=$year?> Grado <?=$grado?></p>

            <table class="table mt-5">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Ciclo</th>
                        <th scope="col">Baremo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th scope="row"><?= $user->name ?></th>
                        <td><?= $user->last_name ?></td>
                        <td><?= $user->nombre ?></td>
                        v<td><?= $user->baremo ?></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>   
        
</body>
</html>