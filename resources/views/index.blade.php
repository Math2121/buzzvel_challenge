<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Buzzvel Challenge</title>
</head>

<body>
    <h2 class="text-center">Pesquise o Hotel mais próximo!</h2>

    <div class="container mx-auto">
        <form action="" class="px-4 py-4">
            @csrf
            <div class="input-group flex flex-col w-100">
                <input type="text" name="latitude" placeholder="Latidude" required>
                <input type="text" name="longitude" placeholder="Longitude" required>
                <input type="text" name="orderBy" placeholder="Preço por noite">
            </div>

            <button type="submit">Enviar</button>
        </form>
    </div>

</body>

</html>
