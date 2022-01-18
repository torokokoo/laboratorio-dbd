<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
</head>
<body id="body">
    <style>
    section{
      padding: 50px;
    }
  </style>
    @include('subviews.navbar')
<section>
    <h1 style="color: var(black); ">{{$game->name}}</h1>
    <h6 style="color: var(black); "> Descripción: {{$game->description}} </h6>
    <h6 style="color: var(black); "> Almacenamiento: {{$game->storage}} MB </h6>
    <h6 style="color: var(black); "> Precio: ${{$game->price}} </h6>
    <img src="{{$game->image}}" class="rounded mx-auto d-block" alt="Imagen de juego">
    <br> <br>
    <div class="d-flex justify-content-center">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/eETQBYFGGZ8"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>
    </div>
    <button type="button"  class="btn btn-primary">Comprar</button>
    <button type="button" class="btn btn-success">Me Gusta</button>
    <button type="button" class="btn btn-danger">No Me Gusta</button>
    <h2> <br> <br> COMENTARIOS</h2>
    <hr />
    </section>
</body>

</html>