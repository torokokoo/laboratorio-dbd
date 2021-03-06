<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Mist</title>
</head>

<body>
    <style>
        .ranking {
            margin: 50px;
        }
    </style>
    @include('subviews.navbar')
    <section class="mt-5">
        <div class="container ">
            <p> Si desea filtrar por nombre, escriba el nombre del juego (Ej: Mortal Kombat) </p>
            <form class="d-flex">
                <input name="buscarpor" class="form-control mr-sm-2" type="search"
                    placeholder="Ingrese un nombre de juego" aria-label="Search">
                <button class="btn btn-primary" type="submit">Filtrar</button>
            </form>
            <br>
            <p> Si desea filtrar por precio, ingrese el minimo y maximo para filtrar con ese rango (EJ: 100 200)</p>
            <form class="d-flex">
                <input name="buscarporminp" class="form-control mr-sm-2" type="search" placeholder="Ingrese precio minimo" aria-label="Search">
                <input name="buscarpormaxp" class="form-control mr-sm-2" type="search" placeholder="Ingrese precio maximo" aria-label="Search">
                <div class="pull-left" style="margin-right:5px">
                <button class="btn btn-info" type="submit">Filtrar</button>
                </div>
            </form>
            <br>
            <h4 class="mb-5">Elige un juego</h4>
            @if(isset($_COOKIE['role']))
            @if(($_COOKIE['role']=='Developer') or ($_COOKIE['role']=='Admin'))
            <div class="col-4 d-flex justify-content-center my-3">
                <div class="card" style="width: 7rem;">
                    <img src="https://icons-for-free.com/iconfiles/png/512/circle+more+plus+icon-1320183136549593898.png"
                        class="card-img-top" alt="Imagen de juego">
                    <h6 class="card-title">Crear Juego</h6>
                    <a href="/game/create" class="btn btn-primary">Crear juego</a>
                </div>
            </div>
            @endif
            @endif
            <div class="row text-center mb-4">
                @foreach ($games as $game)
                <div class="col-4 d-flex justify-content-center my-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{$game->image}}" class="card-img-top" alt="Imagen de juego">
                        <div class="card-body">
                            <h5 class="card-title">{{$game->name}}</h5>
                            <p class="card-text">${{$game->price}}</p>
                            <a href="/game/{{ $game->id }}" class="btn btn-primary">Ver juego</a>
                            @if(isset($_COOKIE['role']))
                            @if($_COOKIE['role']=='Admin')
                            <a href="/game/{{ $game->id }}/edit" class="btn btn-primary">Editar juego</a>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    <p class="mt-5 mb-3 text-muted">&copy; DEBEDE 2021-2022</p>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>